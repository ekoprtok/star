<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackageDetail;
use App\Models\TrxPackage;
use App\Models\UserPackage;
use App\Models\UserWallet;
use Helper;

class PackageController extends Controller {

    public function index(Request $request) {
        $id   = ($request->id) ? Helper::decrypt($request->id) : '';
        $data = ($id) ? UserPackage::where('user_id', $id)->leftJoin('packages', 'packages.id', '=', 'user_packages.package_id')->get() : Package::all();
        if ($data) {
            foreach ($data as $key => $value) {
                $this->setAttr($value, $key);
            }
        }
        return response()->json([
            'data'      => $data,
            'master'    => Package::all()
        ]);
    }

    public function packageBuy(Request $request) {
        $id             = Helper::decrypt($request->id);
        $user_id        = $request->user_id;
        $trxPackage     = TrxPackage::where(['user_id' => $user_id, 'package_id' => $id])->count();
        $checkPackage   = Package::find($id);
        $checkWallet    = UserWallet::where('user_id', $user_id)->first();

        // check balance user
        $price          = $checkPackage->rdonation + $checkPackage->rjoin_fee;
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
        $process = TrxPackage::create([
            'submitted_at' => date('Y-m-d H:i:s'),
            'user_id'      => $user_id,
            'package_id'   => $id
        ]);

        // create user package
        $process = UserPackage::create([
            'user_id'      => $user_id,
            'package_id'   => $id
        ]);

        // update balance
        $newBalance = $checkWallet->rbalance_amount - $price;
        $process    = UserWallet::where('user_id', $user_id)->update([
            'rbalance_amount' => (float)$newBalance
        ]);

        return response()->json([
            'success' => $process ? true : false,
            'message' => $process ? 'Package is already yours' : 'there was a problem buying the package, please try again in a moment',
        ]);
    }

    public function formCrud(Request $request) {
        $id = $request->id ? Helper::decrypt($request->id) : '';
        $validated = $request->validate([
            'name'            => 'required|min:4',
            'rvalue'          => 'required',
            'level'           => 'required',
            'rdonation'       => 'required',
            'rjoin_fee'       => 'required',
            'rdaily_blessing' => 'required',
            'created_by'      => 'required',
        ]);

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
            'message' => $process ? 'Package has been procesed' : '',
        ]);
    }

    public function percentageProcess(Request $request) {
        $id         = $request->idx ? Helper::decrypt($request->idx) : '';
        $package_id = $request->package_id ? Helper::decrypt($request->package_id) : '';
        $validated = $request->validate([
            'gen'        => 'required',
            'percentage' => 'required',
            'package_id' => 'required'
        ]);

        if ($id) {
            $process = PackageDetail::where('id', $id)->update([
                'gen'        => $request->gen,
                'percentage' => $request->percentage,
                'package_id' => $package_id,
            ]);
        } else {
            $process = PackageDetail::create([
                'gen'        => $request->gen,
                'percentage' => $request->percentage,
                'package_id' => $package_id,
            ]);
        }

        return response()->json([
            'success' => $process ? true : false,
            'message' => $process ? 'Package percentage has been procesed' : '',
        ]);
    }

    public function getEdit(Request $request) {
        $data = Package::find(Helper::decrypt($request->id));
        if ($data) {
            $data->idx = Helper::encrypt($request->id);
        }
        return $data;
    }

    public function getPercentage(Request $request) {
        $draw = $request->get('draw');
        $search = $request->get('search')['value'];
        $offset = $request->get('start') - 1;
        $limit = $request->get('length');

        $data = PackageDetail::where(function ($query) use ($search) {
            $query->where('percentage', 'LIKE', '%' . $search . '%');
        })->offset($offset)
            ->limit($limit)
            ->orderByDesc('created_at')
            ->get();

        if ($data) {
            foreach ($data as $key => $value) {
                $this->setAttrPercentage($value, $key);
            }
        }

        $dataCount = PackageDetail::where(function ($query) use ($search) {
            $query->where('percentage', 'LIKE', '%' . $search . '%');
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

    public function packageList(Request $request) {
        $draw = $request->get('draw');
        $search = $request->get('search')['value'];
        $offset = $request->get('start') - 1;
        $limit = $request->get('length');

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
        $process = Package::where('id', Helper::decrypt($request->id))->delete();
        $process = PackageDetail::where('package_id', Helper::decrypt($request->id))->delete();
        return response()->json([
            'success' => $process ? true : false,
            'message' => $process ? 'Package has been delete' : '',
        ]);
    }

    public function percentageDelete(Request $request) {
        $process = PackageDetail::where('id', Helper::decrypt($request->id))->delete();
        return response()->json([
            'success' => $process ? true : false,
            'message' => $process ? 'Package percentage has been delete' : '',
        ]);
    }

    public function percentageEdit(Request $request) {
        $data = PackageDetail::find(Helper::decrypt($request->id));
        if ($data) {
            $data->idx        = Helper::encrypt($data->id);
            $data->package_id = Helper::encrypt($data->package_id);
        }
        return response()->json($data);
    }

    public function setAttrPercentage($value, $key) {
        $encrypt_id        = Helper::encrypt($value->id);
        $value->percentage = $value->percentage.'%';
        $value->action     =
            '
            <a class="text-danger" href="javascript:void(0)" onclick="deleting(\''.$encrypt_id.'\')" title="delete">
                <i class="fs-16px bi bi-trash text-muted"></i>
            </a>
                &nbsp;&nbsp;
            <a class="text-primary" href="javascript:void(0)" onclick="editing(\''.$encrypt_id.'\')" title="edit">
                <i class="fs-16px bi bi-pencil-square text-muted"></i>
            </a>
        ';
    }

    public function setAttr($value, $key) {
        $value->idx             = Helper::encrypt($value->id);
        $value->rvalue          = Helper::format_harga($value->rvalue);
        $value->rdonation       = Helper::format_harga($value->rdonation);
        $value->rjoin_fee       = Helper::format_harga($value->rjoin_fee);
        $value->rdaily_blessing = Helper::format_harga($value->rdaily_blessing);
        $value->action =
            '
            <a class="text-danger" href="javascript:void(0)" onclick="deleting(\''.Helper::encrypt($value->id).'\')" title="delete">
                <i class="fs-16px bi bi-trash text-muted"></i>
            </a>
                &nbsp;&nbsp;
            <a class="text-primary" href="'.route('admin.package.form', ['id' => Helper::encrypt($value->id)]).'" title="edit">
                <i class="fs-16px bi bi-pencil-square text-muted"></i>
            </a>
                &nbsp;&nbsp;
            <a class="btn btn-xs btn-outline-primary" href="'.route('admin.package.percentage.form', ['id' => Helper::encrypt($value->id)]).'" title="add percentage">
                Add Percentage
            </a>
        ';
    }
}
