<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\TrxPackage;
use App\Models\UserPackage;
use App\Models\UserWallet;
use App\Models\HisKindMeter;
use App\Models\TrxPackageRedeem;
use App\Models\User;
use Helper;

class PackageController extends Controller {

    public function index(Request $request) {
        $id   = $request->id;
        $data = ($id) ? UserPackage::select('user_packages.*','packages.name')->where('user_id', $id)->leftJoin('packages', 'packages.id', '=', 'user_packages.package_id')->get() : Package::all();
        if ($data) {
            foreach ($data as $key => $value) {
                $this->setAttr($value, $key);
            }
        }

        $master = Package::all();
        if ($master) {
            foreach ($master as $key => $value) {
                $value->color  = Helper::colorPackage($value->name);
                $value->amount = Helper::format_harga($value->rdaily_blessing);
            }
        }

        return response()->json([
            'data'      => $data,
            'master'    => $master
        ]);
    }

    public function redeemProcess(Request $request) {
        $data = UserPackage::select('user_packages.*','packages.name', 'packages.rdonation')->where('user_packages.id', $request->id)->leftJoin('packages', 'packages.id', '=', 'user_packages.package_id')->first();
        if ($data) {
            $this->setPercentageInfo($data);
        }

        $checkTrx = TrxPackageRedeem::where([
            'user_id'    => $request->userId,
            'package_id' => $data->package_id
        ])->where('status', '0')->first();

        if ($checkTrx) {
            return response()->json([
                'success' => false,
                'message' => "You have redeem this package"
            ]);
        }

        $process = TrxPackageRedeem::create([
            'submitted_at'      => date('Y-m-d H:i:s'),
            'user_id'           => $request->userId,
            'package_id'        => $data->package_id,
            'package_type'      => '0',
            'kindeness_percen'  => $data->percentage,
            'rdonation'         => $data->rdonation_real,
            'redeem_rate'       => $data->package_redeem_rate,
            'ramount'           => $data->estimated_real,
            'status'            => '0',
        ]);

        return response()->json([
            'success' => ($process) ? true : false,
            'message' => ($process) ? 'Redeem gift has been successfully requested' : 'Error processing data, please try again.'
        ]);
    }

    public function redeemInfo(Request $request) {
        $data = UserPackage::select('user_packages.*','packages.name', 'packages.rdonation')->where('user_packages.id', $request->id)->leftJoin('packages', 'packages.id', '=', 'user_packages.package_id')->first();
        if ($data) {
            $this->setPercentageInfo($data);
        }
        return response()->json($data);
    }

    public function adminProcessRedeem(Request $request) {
        $dataTrxPackageRedeem = TrxPackageRedeem::whereId($request->id)->first();
        $amountFormat         = Helper::format_harga($dataTrxPackageRedeem->ramount);
        $walletUser           = UserWallet::where('user_id', $request->user_id)->first();
        $updateTrx            = TrxPackageRedeem::whereId($request->id)->update([
            'status'       => $request->status,
            'responsed_by' => $request->user_id,
            'responsed_at' => date('Y-m-d H:i:s')
        ]);

        if ($request->status == '1') {
            // update kind meter
            $updateKindMeter = HisKindMeter::where([
                'user_id'     => $dataTrxPackageRedeem->user_id,
                'package_id'  => $dataTrxPackageRedeem->package_id
            ])->update(['status' => '1']);

            // wallet user
            $process = Helper::createdWalletHistory([
                'trx_id'  => $dataTrxPackageRedeem->id,
                'type'    => '9',
                'user_id' => $dataTrxPackageRedeem->user_id,
                'amount'  => $dataTrxPackageRedeem->ramount,
                'status'  => 'in'
            ]);

            // notif
            $process = Helper::sendNotif([
                'type'          => "package_redeem",
                'message'       => "Your request claim redeem of {$amountFormat} has been rejected",
                'from_user_id'  => "2",
                'to_user_id'    => $dataTrxPackageRedeem->user_id
            ]);

            // wallet owner
            $process = Helper::createdOwnerWalletHistory([
                'user_id'   => $dataTrxPackageRedeem->user_id,
                'amount'    => $dataTrxPackageRedeem->ramount,
                'type'      => '5',
                'status'    => 'out',
                'trx_id'    => $dataTrxPackageRedeem->id,
                'insertTo'  => 'sys'
            ]);
        }else {
            // notif
            $process = Helper::sendNotif([
                'type'          => "package_redeem",
                'message'       => "Your request claim redeem of {$amountFormat} has been approved",
                'from_user_id'  => "2",
                'to_user_id'    => $dataTrxPackageRedeem->user_id
            ]);
        }

        return response()->json([
            'success' => ($process) ? true : false,
            'message' => ($process) ? 'Redeem gift has been successfully process' : 'Error processing data, please try again.'
        ]);
    }

    public function setPercentageInfo($data) {
        $percentage = HisKindMeter::where([
            'user_id'       => $data->user_id,
            'package_id'    => $data->package_id,
            'status'        => '0'
        ])->sum('percentage');
        $data->percentage          = ($percentage) ? ($percentage > 100 ? 100 : $percentage) : 0;
        $data->package_redeem_rate = Helper::config('package_redeem_rate');
        $data->estimated           = round((((float)$data->percentage/100) * (float)$data->rdonation) * ((float)$data->package_redeem_rate/100), 2);
        $data->estimated_real      = $data->estimated;
        $data->estimated           = Helper::format_harga($data->estimated);
        $data->rdonation_real      = $data->rdonation;
        $data->rdonation           = Helper::format_harga($data->rdonation);
    }

    public function packageBuy(Request $request) {
        $id             = $request->id;
        $user_id        = $request->user_id;
        $trxPackage     = UserPackage::where(['user_id' => $user_id, 'package_id' => $id, 'status' => '1'])->count();
        $checkPackage   = Package::find($id);
        $checkWallet    = UserWallet::where('user_id', $user_id)->first();

        // check balance user
        $price          = Helper::ratePackage($checkPackage->rdonation, $checkPackage->rjoin_fee);
        if ($checkWallet->rbalance_amount < $price) {
            return response()->json([
                'success' => false,
                'message' => "Sorry, your balance isn't enough"
            ]);
        }

        // check if user have same package
        if ($trxPackage) {
            return response()->json([
                'success' => false,
                'message' => 'You have buy the same package before'
            ]);
        }

        // create history buy
        $processTrx = TrxPackage::create([
            'submitted_at' => date('Y-m-d H:i:s'),
            'user_id'      => $user_id,
            'package_id'   => $id
        ]);

        // create user package
        $processPac = UserPackage::create([
            'user_id'      => $user_id,
            'rvalue'       => $checkPackage->rvalue,
            'package_id'   => $id
        ]);

        // wallet user
        $process = Helper::createdWalletHistory([
            'trx_id'  => $processTrx->id,
            'type'    => '4',
            'user_id' => $checkWallet->user_id,
            'amount'  => $price,
            'status'  => 'out'
        ]);

        // wallet owner
        $process = Helper::createdOwnerWalletHistory([
            'user_id'   => $checkWallet->user_id,
            'amount'    => $price,
            'type'      => '1',
            'status'    => 'in',
            'trx_id'    => $processTrx->id,
            'insertTo'  => 'sys'
        ]);

        // set deep user
        $process = Helper::functionUserDeep($checkWallet->user_id);

        // kindnes from downline
        $process = Helper::kindnesMeterDownline($processPac->id);

        return response()->json([
            'success' => $process ? true : false,
            'message' => $process ? 'Package is already yours' : 'there was a problem buying the package, please try again in a moment',
        ]);
    }

    public function formGift(Request $request) {
        $validated = $request->validate([
            'package_id'     => 'required',
            'user'           => 'required'
        ]);

        $checkUser = User::where(function ($query) use ($request) {
            $query->where('username', $request->user)->orWhere('email', $request->user);
        })->where('role', '0')->first();

        $checkPackage = Package::find($request->package_id);

        if (!$checkUser) {
            return response()->json([
                'success' => false,
                'message' => 'User not registered',
            ]);
        }

        if (!$checkPackage) {
            return response()->json([
                'success' => false,
                'message' => 'Package not found',
            ]);
        }

        // check if user have same package
        $checkTrx = Package::where([
            'user_id'    => $checkUser->id,
            'package_id' => $checkPackage->id,
            'status'     => '1'
        ])->count();

        if ($checkTrx > 0) {
            return response()->json([
                'success' => false,
                'message' => 'User already have this package',
            ]);
        }

        // add trx package
        $process = TrxPackage::create([
            'submitted_at' => date('Y-m-d H:i:s'),
            'user_id'      => $checkUser->id,
            'package_id'   => $checkPackage->id,
            'package_type' => '0'
        ]);

        // add package user
        $process = UserPackage::create([
            'user_id'      => $checkUser->id,
            'rvalue'       => $checkPackage->rvalue,
            'package_id'   => $checkPackage->id,
            'package_type' => '0'
        ]);

        // set deep user
        $process = Helper::functionUserDeep($checkUser->id);

        return response()->json([
            'success' => $process ? true : false,
            'message' => $process ? 'Package successfully sent' : 'Error processing data, please try again.',
        ]);
    }

    public function formCrud(Request $request) {
        $id = $request->id;
        $validated = $request->validate([
            'name'            => 'required|min:4|max:255',
            'rvalue'          => 'required',
            'level'           => 'required',
            'rdonation'       => 'required',
            'rjoin_fee'       => 'required',
            'rdaily_blessing' => 'required',
            'created_by'      => 'required',
        ]);

        $dataPackage = Package::where('level', $request->level)->count();
        if ($dataPackage > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Level has been used',
            ]);
        }

        if ($id) {
            $process = Package::where('id', $id)->update([
                'name'            => $request->name,
                'rvalue'          => $request->rvalue,
                'level'           => $request->level,
                'rdonation'       => $request->rdonation,
                'rjoin_fee'       => $request->rjoin_fee,
                'rdaily_blessing' => $request->rdaily_blessing,
                'created_by'      => $request->created_by,
                'img_url'         => null,
            ]);
        } else {
            $process = Package::create([
                'name'            => $request->name,
                'rvalue'          => $request->rvalue,
                'level'           => $request->level,
                'rdonation'       => $request->rdonation,
                'rjoin_fee'       => $request->rjoin_fee,
                'rdaily_blessing' => $request->rdaily_blessing,
                'created_by'      => $request->created_by,
                'img_url'         => null,
            ]);
        }

        return response()->json([
            'success' => $process ? true : false,
            'message' => $process ? 'Package has been procesed' : 'Error processing data, please try again.',
        ]);
    }

    public function getEdit(Request $request) {
        $data = Package::find($request->id);
        if ($data) {

        }
        return $data;
    }

    public function packageList(Request $request) {
        $draw   = $request->get('draw');
        $search = $request->get('search')['value'];
        $offset = $request->get('start') - 1;
        $limit  = $request->get('length');

        $data = Package::where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->offset($offset)
            ->limit($limit)
            ->orderByDesc('created_at')
            ->get();

        if ($data) {
            foreach ($data as $key => $value) {
                $this->setAttr($value, $key);
            }
        }

        $dataCount = Package::where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->orderByDesc('created_at')
            ->count();

        return response()->json([
            'draw'            => $draw,
            'recordsTotal'    => $dataCount,
            'recordsFiltered' => $dataCount,
            'data'            => $data,
            'success'         => true,
        ]);
    }

    public function packageDelete(Request $request) {
        $checkPackage   = TrxPackage::where('package_id', $request->id)->count();

        if ($checkPackage > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Package already used in Transaction',
            ]);
        }

        $process = Package::where('id', $request->id)->delete();
        return response()->json([
            'success' => $process ? true : false,
            'message' => $process ? 'Package has been delete' : 'Error processing data, please try again.',
        ]);
    }

    public function setAttrPercentage($value, $key) {
        $value->percentage = $value->percentage.'%';
        $value->action     =
            '
            <a class="text-danger" href="javascript:void(0)" onclick="deleting(\''.$value->id.'\')" title="delete">
                <i class="fs-16px bi bi-trash text-muted"></i>
            </a>
                &nbsp;&nbsp;
            <a class="text-primary" href="javascript:void(0)" onclick="editing(\''.$value->id.'\')" title="edit">
                <i class="fs-16px bi bi-pencil-square text-muted"></i>
            </a>
        ';
    }

    public function setAttr($value, $key) {
        $percentage             = HisKindMeter::where([
            'user_id'       => $value->user_id,
            'package_id'    => $value->package_id,
            'status'        => '0'
        ])->sum('percentage');

        $totalPrice             = Helper::ratePackage($value->rdonation, $value->rjoin_fee);
        $value->rvalue          = Helper::format_harga($totalPrice);
        $value->rdonation       = Helper::format_harga($value->rdonation);
        $value->rjoin_fee       = Helper::format_harga($value->rjoin_fee);
        $value->rdaily_blessing = Helper::format_harga($value->rdaily_blessing);
        $value->percentage      = ($percentage) ? $percentage : 0;
        $value->gift            = '
            <a class="btn btn-xs btn-outline-primary" onclick="sendGift(\''.$value->id.'\', \''.$value->name.'\')" href="javascript:void(0)" title="Send Package">
                Send
            </a>
        ';
        $value->action          =
            '
                <a class="text-danger" href="javascript:void(0)" onclick="deleting(\''.$value->id.'\')" title="delete">
                    <i class="fs-16px bi bi-trash text-muted"></i>
                </a>
                    &nbsp;&nbsp;
                <a class="text-primary" href="'.route('admin.package.form', ['id' => $value->id]).'" title="edit">
                    <i class="fs-16px bi bi-pencil-square text-muted"></i>
                </a>
            ';
    }
}
