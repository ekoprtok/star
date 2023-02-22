<?php

namespace App\Http\Controllers\API;

use Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrxIntTransfer;
use App\Models\User;
use App\Models\UserWallet;
use App\Models\TrxWithdrawal;

class InternalTransferController extends Controller {

    public function process(Request $request) {
        $validated = $request->validate([
            'amount'       => 'required|numeric',
            'email'        => 'required',
            'user_id'      => 'required',
        ]);

        $user_id  = $request->user_id;
        $wallet   = UserWallet::where('user_id', $user_id)->first();
        $checkTrx = TrxIntTransfer::selectRaw('SUM(amount) as pending')->where(['user_wallet_id' => $wallet->id, 'status' => '0'])->first();
        $trxWd    = TrxWithdrawal::selectRaw('SUM(amount) as pending')->where(['user_wallet_id' => $wallet->id, 'status' => '0'])->first();
        $amount   = ($wallet->rbalance_amount - $checkTrx->pending - $trxWd->pending);

        if ($request->amount <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Internal transfer request amount must greater than 0'
            ]);
        }

        if ($amount < $request->amount) {
            return response()->json([
                'success' => false,
                'message' => 'Your balance is not enough'
            ]);
        }

        $emailTo  = User::where('email', $request->email)->first();
        if (!$emailTo) {
            return response()->json([
                'success' => false,
                'message' => 'Email not registered'
            ]);
        }

        $user    = User::whereId($emailTo->id)->first();
        if ($user->id == $user_id) {
            return response()->json([
                'success' => false,
                'message' => 'You cant doing internal transfer to your self'
            ]);
        }


        $walletTo  = UserWallet::where('user_id', $emailTo->id)->first();

        $create  = TrxIntTransfer::create([
            'submitted_at'      => date('Y-m-d H:i:s'),
            'user_wallet_id'    => $wallet->id,
            'to_wallet_id'      => $walletTo->id,
            'amount'            => $request->amount,
            'file_path'         => 'kosong',
            'status'            => '1',
            'responsed_by'      => $wallet->user_id,
            'responsed_at'      => date('Y-m-d H:i:s'),
        ]);

        // patching

        $oldWallet      = UserWallet::whereId($walletTo->id)->first();
        $oldWalletFrom  = UserWallet::whereId($wallet->id)->first();
        $userTo         = User::find($oldWallet->user_id);
        $userFrom       = User::find($oldWalletFrom->user_id);
        $amount         = Helper::format_harga($request->amount);

        // to, add balance
        // wallet user
        $process = Helper::createdWalletHistory([
            'trx_id'  => $create->id,
            'type'    => '3',
            'user_id' => $oldWallet->user_id,
            'amount'  => $request->amount,
            'status'  => 'in'
        ]);

        // from, reduce balance
        // wallet user from
        $process = Helper::createdWalletHistory([
            'trx_id'  => $create->id,
            'type'    => '3',
            'user_id' => $oldWalletFrom->user_id,
            'amount'  => $request->amount,
            'status'  => 'out'
        ]);

        // notif to user to
        $process = Helper::sendNotif([
            'type'          => "internal_transfer",
            'message'       => "You get a transfer from an {$userFrom->email} of {$amount}",
            'from_user_id'  => "2",
            'to_user_id'    => $oldWallet->user_id
        ]);

        // notif to user from
        $process = Helper::sendNotif([
            'type'          => "internal_transfer",
            'message'       => "Your transfer of {$amount} to {$userTo->email} was successfully sent",
            'from_user_id'  => "2",
            'to_user_id'    => $oldWalletFrom->user_id
        ]);

        return response()->json([
            'success' => ($process ? true : false),
            'message' => ($process ? 'Your deposit has been successfully created.' : 'Error processing data, please try again.')
        ]);
    }

    public function adminProcess(Request $request) {
        $internal    = TrxIntTransfer::find($request->id);
        $processTrx  = TrxIntTransfer::where('id', $request->id)->update([
            'responsed_by' => $request->user_id,
            'responsed_at' => date('Y-m-d H:i:s'),
            'status'       => $request->status
        ]);

        $oldWallet      = UserWallet::where('user_id', $request->to_id)->first();
        $oldWalletFrom  = UserWallet::where('user_id', $request->from_id)->first();
        $userTo         = User::find($oldWallet->user_id);
        $userFrom       = User::find($oldWalletFrom->user_id);
        $amount         = Helper::format_harga($internal->amount);

        if ($request->status == '1') {
            // to, add balance
            // wallet user
            $process = Helper::createdWalletHistory([
                'trx_id'  => $request->id,
                'type'    => '3',
                'user_id' => $oldWallet->user_id,
                'amount'  => $internal->amount,
                'status'  => 'in'
            ]);

            // from, reduce balance
            // wallet user from
            $process = Helper::createdWalletHistory([
                'trx_id'  => $request->id,
                'type'    => '3',
                'user_id' => $oldWalletFrom->user_id,
                'amount'  => $internal->amount,
                'status'  => 'out'
            ]);

            // notif to user to
            $process = Helper::sendNotif([
                'type'          => "internal_transfer",
                'message'       => "You get a transfer from an {$userFrom->email} of {$amount}",
                'from_user_id'  => "2",
                'to_user_id'    => $request->to_id
            ]);

            // notif to user from
            $process = Helper::sendNotif([
                'type'          => "internal_transfer",
                'message'       => "Your transfer of {$amount} to {$userTo->email} was successfully sent",
                'from_user_id'  => "2",
                'to_user_id'    => $request->from_id
            ]);
        }else {
            // notif to user from
            $process = Helper::sendNotif([
                'type'          => "internal_transfer",
                'message'       => "Your transfer of {$amount} to {$userTo->email} was rejected",
                'from_user_id'  => "2",
                'to_user_id'    => $request->from_id
            ]);
        }

        return response()->json([
            'success' => ($process ? true : false),
            'message' => ($process ? 'Internal Transfer has been successfully updated.' : 'Error processing data, please try again.')
        ]);
    }
}
