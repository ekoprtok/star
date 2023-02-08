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

        $user_id = $request->user_id;
        $wallet  = UserWallet::where('user_id', $user_id)->first();
        $fee     = Helper::config('withdrawal_fee');
        $amount  = $request->amount - $fee;

        if ($amount <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Withdrawal request amount must greater than 0'
            ]);
        }

        if ($wallet->rbalance_amount <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Your balance is not enough'
            ]);
        }

        if ($wallet->rbalance_amount < $amount) {
            return response()->json([
                'success' => false,
                'message' => 'Your balance is not enough'
            ]);
        }

        $create  = TrxWithdrawal::create([
            'submitted_at'      => date('Y-m-d H:i:s'),
            'user_wallet_id'    => $wallet->id,
            'amount'            => $amount,
            'status'            => '0'
        ]);


        return response()->json([
            'success' => ($create ? true : false),
            'message' => ($create ? 'Your withdrawal has been successfully created.' : 'Error processing data, please try again.')
        ]);
    }

    public function adminProcess(Request $request) {
        $withdraw = TrxWithdrawal::find($request->id);
        $process  = TrxWithdrawal::where('id', $request->id)->update([
            'responsed_by' => $request->user_id,
            'responsed_at' => date('Y-m-d H:i:s'),
            'status'       => $request->status
        ]);

        $amount     = Helper::format_harga($withdraw->amount);
        $oldWallet  = UserWallet::find($request->user_wallet_id);
        // approve reduce balance user
        if ($request->status == '1') {
            // wallet user
            $process = Helper::createdWalletHistory([
                'trx_id'  => $request->id,
                'type'    => '2',
                'user_id' => $oldWallet->user_id,
                'amount'  => $withdraw->amount,
                'status'  => 'out'
            ]);

            // notif to user
            Helper::sendNotif([
                'type'          => "withdraw",
                'message'       => "Your withdrawal of {$amount} was successfully sent",
                'from_user_id'  => "2",
                'to_user_id'    => $oldWallet->user_id
            ]);

            // wallet owner
            $process = Helper::createdOwnerWalletHistory([
                'user_id'   => $oldWallet->user_id,
                'amount'    => $withdraw->amount,
                'type'      => '2',
                'status'    => 'out',
                'trx_id'    => $request->id,
                'insertTo'  => 'real'
            ]);
        }else {
            // notif to user
            Helper::sendNotif([
                'type'          => "withdraw",
                'message'       => "Your withdrawal of {$amount} was rejected",
                'from_user_id'  => "2",
                'to_user_id'    => $oldWallet->user_id
            ]);
        }

        return response()->json([
            'success' => ($process ? true : false),
            'message' => ($process ? 'Withdrawal has been successfully updated.' : 'Error processing data, please try again.')
        ]);
    }

}
