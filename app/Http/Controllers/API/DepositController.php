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
        $filename = time() . '.' . $request->file->extension();
        $process  = $request->file->move(public_path('uploads/deposit'), $filename);

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
            'message' => ($create ? 'Your deposit has been successfully created.' : 'Error processing data, please try again.')
        ]);
    }

    public function adminProcess(Request $request) {
        $depo    = TrxDeposit::find($request->id);
        $process = TrxDeposit::where('id', $request->id)->update([
            'responsed_by' => $request->user_id,
            'responsed_at' => date('Y-m-d H:i:s'),
            'status'       => $request->status
        ]);

        $amount     = Helper::format_harga($depo->amount);
        $oldWallet  = UserWallet::find($request->user_wallet_id);
        if ($request->status == '1') {
            $newBalance = ($oldWallet) ? ($oldWallet->rbalance_amount + $depo->amount) : $request->amount;
            UserWallet::where('id', $request->user_wallet_id)->update([
                'rbalance_amount' => (float)$newBalance
            ]);

            // notif to user
            Helper::sendNotif([
                'type'          => "deposit",
                'message'       => "Your deposit of {$amount} was successfully",
                'from_user_id'  => "2",
                'to_user_id'    => $oldWallet->user_id
            ]);
        }else {
            // notif to user
            Helper::sendNotif([
                'type'          => "deposit",
                'message'       => "Your deposit of {$amount} was rejected",
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
