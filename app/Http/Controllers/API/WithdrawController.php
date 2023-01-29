<?php

namespace App\Http\Controllers\API;

use Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrxWithdrawal;
use App\Models\User;
use App\Models\UserWallet;

class WithdrawController extends Controller {

    public function process(Request $request) {
        $validated = $request->validate([
            'amount'       => 'required|numeric',
            'user_id'      => 'required',
        ]);

        $user_id = Helper::decrypt($request->user_id);
        $wallet  = UserWallet::where('user_id', $user_id)->first();
        if ($wallet->rbalance_amount < $request->amount) {
            return response()->json([
                'success' => false,
                'message' => 'Your balance is not enought'
            ]);
        }

        $create  = TrxWithdrawal::create([
            'submitted_at'      => date('Y-m-d H:i:s'),
            'user_wallet_id'    => $wallet->id,
            'amount'            => $request->amount,
            'status'            => '0'
        ]);


        return response()->json([
            'success' => ($create ? true : false),
            'message' => ($create ? 'Your withdrawal has been successfully created.' : 'Error processing data, please try again.')
        ]);
    }

    public function adminProcess(Request $request) {
        $depo    = TrxWithdrawal::find($request->id);
        $process = TrxWithdrawal::where('id', $request->id)->update([
            'responsed_by' => $request->user_id,
            'responsed_at' => date('Y-m-d H:i:s'),
            'status'       => $request->status
        ]);

        if ($request->status == '1') {
            $oldWallet  = UserWallet::find($request->user_wallet_id);
            $newBalance = ($oldWallet) ? ($oldWallet->rbalance_amount - $depo->amount) : $request->amount;
            UserWallet::where('id', $request->user_wallet_id)->update([
                'rbalance_amount' => (float)$newBalance
            ]);
        }

        return response()->json([
            'success' => ($process ? true : false),
            'message' => ($process ? 'Withdrawal has been successfully updated.' : 'Error processing data, please try again.')
        ]);
    }

}