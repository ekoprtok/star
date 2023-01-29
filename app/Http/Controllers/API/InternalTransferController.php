<?php

namespace App\Http\Controllers\API;

use Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrxIntTransfer;
use App\Models\User;
use App\Models\UserWallet;

class InternalTransferController extends Controller {

    public function process(Request $request) {
        $validated = $request->validate([
            'amount'       => 'required|numeric',
            'email'        => 'required',
            'user_id'      => 'required',
        ]);

        $user_id = Helper::decrypt($request->user_id);
        $wallet  = UserWallet::where('user_id', $user_id)->first();

        $wallet  = UserWallet::where('user_id', $user_id)->first();
        if ($wallet->rbalance_amount < $request->amount) {
            return response()->json([
                'success' => false,
                'message' => 'Your balance is not enought'
            ]);
        }

        $emailTo  = User::where('email', $request->email)->first();
        if (!$emailTo) {
            return response()->json([
                'success' => false,
                'message' => 'Email not registered'
            ]);
        }

        $walletTo  = UserWallet::where('user_id', $emailTo->id)->first();

        $create  = TrxIntTransfer::create([
            'submitted_at'      => date('Y-m-d H:i:s'),
            'user_wallet_id'    => $wallet->id,
            'to_wallet_id'      => $walletTo->id,
            'amount'            => $request->amount,
            'file_path'         => 'kosong',
            'status'            => '0'
        ]);

        return response()->json([
            'success' => ($create ? true : false),
            'message' => ($create ? 'Your deposit has been successfully created.' : 'Error processing data, please try again.')
        ]);
    }

    public function adminProcess(Request $request) {
        $internal = TrxIntTransfer::find($request->id);
        $process  = TrxIntTransfer::where('id', $request->id)->update([
            'responsed_by' => $request->user_id,
            'responsed_at' => date('Y-m-d H:i:s'),
            'status'       => $request->status
        ]);

        if ($request->status == '1') {
            $oldWallet  = UserWallet::find($request->to_id);
            $newBalance = ($oldWallet) ? ($oldWallet->rbalance_amount + $internal->amount) : $request->amount;
            UserWallet::where('id', $request->to_id)->update([
                'rbalance_amount' => (float)$newBalance
            ]);

            // from
            $oldWalletFrom  = UserWallet::find($request->from_id);
            $newBalanceFrom = ($oldWalletFrom) ? ($oldWalletFrom->rbalance_amount - $internal->amount) : $request->amount;
            UserWallet::where('id', $request->from_id)->update([
                'rbalance_amount' => (float)$newBalance
            ]);
        }

        return response()->json([
            'success' => ($process ? true : false),
            'message' => ($process ? 'Internal Transfer has been successfully updated.' : 'Error processing data, please try again.')
        ]);
    }
}
