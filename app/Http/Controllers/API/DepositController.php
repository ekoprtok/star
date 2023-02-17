<?php

namespace App\Http\Controllers\API;

use Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrxDeposit;
use App\Models\User;
use App\Models\UserWallet;

class DepositController extends Controller {

    public function uploadImage(Request $request) {
        if ($request->file->extension() == 'heic' || $request->file->extension() == 'heif') {
            $filename = time() . '.' . $request->file->extension();
            Maestroerror\HeicToJpg::convert("image1.heic")->saveAs("image1.jpg");
        }else {
            $filename = time() . '.' . $request->file->extension();
            $process  = $request->file->move(public_path('uploads/deposit'), $filename);
        }


        return response()->json([
            'success' => ($process ? true : false),
            'data'    => $filename,
            'message' => ($process ? 'Image uploaded' : 'Failed to upload image, please try again'),
        ]);
    }

    public function process(Request $request) {
        $validated = $request->validate([
            'amount'       => 'required|numeric',
            'file_path'    => 'required',
            'user_id'      => 'required',
        ]);

        $min_deposit = Helper::config('minimum_deposit');
        if ($request->amount < $min_deposit) {
            return response()->json([
                'success' => false,
                'message' => 'Deposit request amount must greater than '.$min_deposit
            ]);
        }

        $user_id = $request->user_id;
        $wallet  = UserWallet::where('user_id', $user_id)->first();
        $create  = TrxDeposit::create([
            'submitted_at'      => date('Y-m-d H:i:s'),
            'user_wallet_id'    => $wallet->id,
            'amount'            => $request->amount,
            'file_path'         => $request->file_path,
            'status'            => '0'
        ]);

        return response()->json([
            'success' => ($create ? true : false),
            'message' => ($create ? 'Your deposit has been successfully created' : 'Error processing data, please try again.')
        ]);
    }

    public function adminProcess(Request $request) {
        if ($request->received_amount <= 0 && $request->status == '1') {
            return response()->json([
                'success' => false,
                'message' => 'Received amount must be greater than 0'
            ]);
        }

        $depo    = TrxDeposit::find($request->id);
        $process = TrxDeposit::where('id', $request->id)->update([
            'responsed_by'    => $request->user_id,
            'received_amount' => ($request->status == '1' ? $request->received_amount : 0),
            'notes'           => $request->notes,
            'responsed_at'    => date('Y-m-d H:i:s'),
            'status'          => $request->status
        ]);

        $amount     = Helper::format_harga($request->received_amount);
        $oldWallet  = UserWallet::find($request->user_wallet_id);
        if ($request->status == '1') {

            // wallet user
            $process    = Helper::createdWalletHistory([
                'trx_id'  => $request->id,
                'type'    => '1',
                'user_id' => $oldWallet->user_id,
                'amount'  => $request->received_amount,
                'status'  => 'in'
            ]);

            // notif to user
            Helper::sendNotif([
                'type'          => "deposit",
                'message'       => "Your deposit of {$amount} was successfully".($request->notes ? ', with notes : '.$request->notes : ''),
                'from_user_id'  => "2",
                'to_user_id'    => $oldWallet->user_id
            ]);

            // wallet owner
            $process = Helper::createdOwnerWalletHistory([
                'user_id'   => $oldWallet->user_id,
                'amount'    => $request->received_amount,
                'type'      => '1',
                'status'    => 'in',
                'trx_id'    => $request->id,
                'insertTo'  => 'real'
            ]);
        }else {
            // notif to user
            Helper::sendNotif([
                'type'          => "deposit",
                'message'       => "Your deposit of {$amount} was rejected".($request->notes ? ', with notes : '.$request->notes : ''),
                'from_user_id'  => "2",
                'to_user_id'    => $oldWallet->user_id
            ]);
        }

        return response()->json([
            'success' => ($process ? true : false),
            'message' => ($process ? 'Deposit has been successfully updated.' : 'Error processing data, please try again.')
        ]);
    }
}
