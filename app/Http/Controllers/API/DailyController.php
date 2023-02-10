<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DailyChallenge;
use App\Models\TrxDailyBlessing;
use App\Models\TrxDailyChallenge;
use App\Models\TrxPackage;
use App\Models\Package;
use App\Models\UserWallet;
use Helper;

class DailyController extends Controller {

    public function index(Request $request) {
        $draw = $request->get('draw');
        $search = $request->get('search')['value'];
        $offset = $request->get('start') - 1;
        $limit = $request->get('length');

        $data = DailyChallenge::where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%')->orWhere('point', 'LIKE', '%' . $search . '%');
        })->offset($offset)
            ->limit($limit)
            ->orderByDesc('created_at')
            ->get();

        if ($data) {
            foreach ($data as $key => $value) {
                $this->setAttrDaily($value, $key);
            }
        }

        $dataCount = DailyChallenge::where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%')->orWhere('point', 'LIKE', '%' . $search . '%');
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

    public function dailyChallenge() {
        $data = DailyChallenge::orderByDesc('created_at')->get();
        return response()->json([
            'success' => true,
            'data'    => $data
        ]);
    }

    public function getEdit(Request $request) {
        $data = DailyChallenge::find($request->id);
        if ($data) {

        }
        return $data;
    }

    public function formCrud(Request $request) {
        $id        = $request->id;
        $validated = $request->validate([
            'name'       => 'required|min:8|max:255'.($id ? '' : '|unique:daily_challenges'),
            'point'      => 'required|between:0.1,100',
            'isText'     => 'required'
        ]);

        if ($id) {
            $process = DailyChallenge::where('id', $id)->update([
                'name'       => $request->name,
                'point'      => $request->point,
                'isText'     => $request->isText
            ]);
        } else {
            $process = DailyChallenge::create([
                'name'       => $request->name,
                'point'      => $request->point,
                'isText'     => $request->isText
            ]);
        }

        return response()->json([
            'success' => $process ? true : false,
            'message' => ($process) ? 'Daily challenge has been procesed' : 'Error processing data, please try again.',
        ], ($process) ? 200 : 500);
    }

    public function dailyDelete(Request $request) {
        $id         = $request->id;
        $checkDaily = TrxDailyChallenge::where('dialy_challenge_id', $id)->first();
        if ($checkDaily) {
            return response()->json([
                'success' => false,
                'message' => $checkDaily->name.' already used in Transaction',
            ], 206);
        }

        $process    = DailyChallenge::where('id', $id)->delete();
        return response()->json([
            'success' => $process ? true : false,
            'message' => ($process) ? 'Daily challenge has been deleted' : 'Error processing data, please try again.',
        ], ($process ? 200 : 500));
    }

    public function setAttrDaily($value, $key) {
        $value->no         = $key + 1;
        $value->isText     = ($value->isText == '1') ? 'Text' : 'File';
        $value->action     =
            '
                <a class="text-danger" href="javascript:void(0)" onclick="deleting(\'' .$value->id.'\')" title="delete">
                    <i class="fs-16px bi bi-trash text-muted"></i>
                </a>
                    &nbsp;&nbsp;
                <a class="text-primary" href="' .route('admin.daily.form', ['id' => $value->id]) .'" title="edit">
                    <i class="fs-16px bi bi-pencil-square text-muted"></i>
                </a>
            ';
    }

    public function dailyBlessing(Request $request) {
        $package_id      = $request->id;
        $user_id         = $request->user_id;
        $package         = Package::find($package_id);

        $checkExistClaim = TrxDailyBlessing::where([
          'package_id'      => $package_id,
          'user_id'         => $user_id
        ])->whereDate('submitted_at', '=', date('Y-m-d'))->count();

        if ($checkExistClaim > 0) {
            return response()->json([
                'success' => false,
                'message' => 'You have claimed daily blessing today',
            ], 206);
        }

        // add trx daily blessing
        $amount         = $package->rdaily_blessing;
        $amountFormat   = Helper::format_harga($amount);
        $processTrx     = TrxDailyBlessing::create([
            'submitted_at' => date('Y-m-d H:i:s'),
            'user_id'      => $user_id,
            'package_id'   => $package_id,
            'amount'       => $amount
        ]);

        // wallet user
        $process    = Helper::createdWalletHistory([
            'trx_id'  => $processTrx->id,
            'type'    => '5',
            'user_id' => $user_id,
            'amount'  => $amount,
            'status'  => 'in'
        ]);

        // wallet owner
        $process = Helper::createdOwnerWalletHistory([
            'user_id'   => $user_id,
            'amount'    => $amount,
            'type'      => '4',
            'status'    => 'out',
            'trx_id'    => $processTrx->id,
            'insertTo'  => 'sys'
        ]);

        // notif
        $process = Helper::sendNotif([
            'type'          => "daily_blessing",
            'message'       => "Your got balance of {$amountFormat} from daily blessing",
            'from_user_id'  => "2",
            'to_user_id'    => $user_id
        ]);

        return response()->json([
            'success' => ($process) ? true : false,
            'message' => ($process) ? 'Claim daily blessing successfully' : 'Error processing data, please try again.',
        ]);
    }

    public function dailyChClaim(Request $request) {
        $dataDaily = DailyChallenge::find($request->dialy_challenge_id);
        $validated = $request->validate([
            'package_id'  => 'required',
            'user_id'     => 'required',
            'text_review' => ($dataDaily->isText == '1' ? 'required|min:8' : ''),
            'file_path'   => ($dataDaily->isText == '1' ? '' : 'required|image'),
        ]);

        $checkBefore = TrxDailyChallenge::where([
            'dialy_challenge_id' => $request->dialy_challenge_id,
            'package_id'         => $request->package_id,
            'user_id'            => $request->user_id,
            'status'             => '0'
        ])->count();

        if ($checkBefore > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Your previous request daily challenge still under review',
            ], 206);
        }

        $filename  = '';

        if ($dataDaily->isText == '0') {
            $filename = time() . '.' . $request->file_path->extension();
            $process  = $request->file_path->move(public_path('uploads/dailyChallenge'), $filename);
        }

        $data      = [
            'submitted_at'          => date('Y-m-d H:i:s'),
            'user_id'               => $request->user_id,
            'package_id'            => $request->package_id,
            'dialy_challenge_id'    => $request->dialy_challenge_id,
            'file_path'             => ($dataDaily->isText == '1') ? $request->text_review : $filename,
            'status'                => '0'
        ];

        $process = TrxDailyChallenge::create($data);

        return response()->json([
            'success' => ($process) ? true : false,
            'message' => ($process) ? 'Request daily challenge successfully' : 'Error processing data, please try again.',
        ]);
    }

    public function adminProcess(Request $request) {
        $data       = TrxDailyChallenge::find($request->id);
        $challenge  = DailyChallenge::find($data->dialy_challenge_id);
        $package    = Package::find($data->package_id);
        $process    = TrxDailyChallenge::where('id', $request->id)->update([
            'responsed_by'  => $request->user_id,
            'responsed_at'  => date('Y-m-d H:i:s'),
            'status'        => $request->status
        ]);

        if ($request->status == '1') {

            // kind meter
            $process = Helper::createdHisKindMeter([
                'user_id'      => $data->user_id,
                'package_id'   => $data->package_id,
                'percentage'   => Helper::kindMeterCal($challenge->point, $package->rdonation),
                'type'         => '2',
                'status'       => '0'
            ]);

            // add knes meter
            $dataTrxPackage = TrxPackage::where(['user_id' => $data->user_id, 'package_id' => $data->package_id])->first();
            $process        = Helper::createdEndOfDonation($dataTrxPackage->id);

            // notif to user
            Helper::sendNotif([
                'type'          => "daily_challenge",
                'message'       => "Your request daily challenge of {$data->name} was approved",
                'from_user_id'  => "2",
                'to_user_id'    => $data->user_id
            ]);
        }else {
            // notif to user
            Helper::sendNotif([
                'type'          => "daily_challenge",
                'message'       => "Your request daily challenge of {$data->name} was rejected",
                'from_user_id'  => "2",
                'to_user_id'    => $data->user_id
            ]);
        }

        return response()->json([
            'success' => ($process) ? true : false,
            'message' => ($process ? 'Request daily challenge has been successfully updated.' : 'Error processing data, please try again.')
        ]);
    }
}
