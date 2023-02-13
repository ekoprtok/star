<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use App\Models\Account;
use App\Models\Notification;
use App\Models\UserWallet;
use App\Models\User;
use App\Models\Member;
use App\Models\UserWalletHistory;
use App\Models\UserPackage;
use App\Models\HisKindMeter;
use App\Models\Rank;
use App\Models\RankTransaction;
use App\Models\Config;
use App\Models\AllQueue;
use App\Models\OwnerWallet;
use App\Models\OwnerWalletHistory;
use App\Models\OwnerWalletRealHistory;
use App\Models\TrxPackage;

use Tarikh\PhpMeta\MetaTraderClient;

class Helper {

    public static function encrypt($string) {
        return Crypt::encryptString($string);
    }

    public static function decrypt($string) {
        return Crypt::decryptString($string);
    }

    public static function kindnesMeterDownline($userPackageId) {
        $userPackage = UserPackage::where(['id' => $userPackageId])->get();
        foreach ($userPackage as $key => $value) {
            //loop find parent
            $dataTrx    = TrxPackage::where(['user_id' => $value->user_id, 'package_id' => $value->package_id])->first();
            $parents    = [];
            $sparentid  = '';
            $suserid    = $value->user_id;
            do {
                $data = Member::where(['user_id' => $suserid])->first();
                if ($data && $data->parent_id != null) {
                    $parents[] = $data->parent_id;
                }
                $sparentid = ($data) ? $data->parent_id : null;
                $suserid   = $sparentid;
            } while ($sparentid != null);

            //loop parent find package
            foreach ($parents as $kp => $vp) {
                $myIndex = ($kp+1);
                $user    = User::find($value->user_id);
                if ($myIndex <= $user->deep) {
                    $userParent = User::find($vp);
                    if ($userParent) {
                        // config percent
                        $configPercent      = self::config('gen_'.$myIndex);
                        // find same package
                        $checkParentPackage    = UserPackage::where(['status' => '1', 'user_id' => $userParent->id, 'package_id' => $value->package_id])->first();
                        $checkParentTrxPackage = TrxPackage::where(['user_id' => $userParent->id, 'package_id' => $value->package_id])->first();
                        if ($checkParentPackage) {
                            // add kind meter
                            $process = self::createdHisKindMeter([
                                'user_id'    => $userParent->id,
                                'package_id' => $value->package_id,
                                'percentage' => $configPercent,
                                'type'       => '1'
                            ]);

                            sleep(0.5);

                            // end of kind
                            if ($process) {
                                $process = self::createdEndOfDonation($checkParentTrxPackage->id);
                            }
                        }
                    }
                }
            }
        }

        return true;
    }

    public static function functionUserDeep($user_id) {
        $userPackage = UserPackage::select('user_packages.*', 'packages.level', 'packages.gen_deep')->where(['user_packages.user_id' => $user_id, 'user_packages.status' => '1'])
                                ->leftJoin('packages', 'packages.id', '=', 'user_packages.package_id')
                                ->orderByDesc('packages.level')
                                ->first();
        $deep        = ($userPackage) ? $userPackage->gen_deep : 0;
        $updateUser  = User::whereId($user_id)->update([
            'deep' => $deep
        ]);

        return ($updateUser) ? true : false;
    }

    public static function createdEndOfDonation($trx_id) {
        $dataTrx        = TrxPackage::whereId($trx_id)->first();
        $dataPackage    = UserPackage::where(['package_id' => $dataTrx->package_id, 'user_id' => $dataTrx->user_id])->first();
        $dataHisKind    = HisKindMeter::selectRaw('SUM(percentage) as percentage')->where(['package_id' => $dataTrx->package_id, 'user_id' => $dataTrx->user_id, 'status' => '0'])->first();
        $dataUserWallet = UserWallet::where('user_id', $dataTrx->user_id)->first();

        $percentage     = ($dataHisKind) ? $dataHisKind->percentage : 0;
        if ($percentage >= 100) {
            $percentIsBuy   = self::config('kindness_percentage');
            $percentIsFree  = self::config('kindness_gift_percentage');
            $amount         = 0;
            if ($dataPackage->package_type == '1') { // buy
                $amount = ($percentIsBuy / 100) * $dataPackage->rvalue;
            }elseif ($dataPackage->package_type == '0') {
                $amount = ($percentIsFree / 100) * $dataPackage->rvalue;
            }

            // wallet user
            $processWalletUser = self::createdWalletHistory([
                'trx_id'    => $trx_id,
                'type'      => '10',
                'user_id'   => $dataTrx->user_id,
                'amount'    => $amount,
                'status'    => 'in',
            ]);

            // update package
            $processUpdatePackageUser = UserPackage::whereId([
                'package_id' => $dataTrx->package_id,
                'user_id' => $dataTrx->user_id
            ])->update([
                'status' => '0'
            ]);

            // set deep user
            $process = self::functionUserDeep($dataTrx->user_id);

            // update kind
            $processUpdateKind = HisKindMeter::where([
                'package_id' => $dataTrx->package_id,
                'user_id' => $dataTrx->user_id
            ])->update([
                'status' => '1'
            ]);

            // wallet owner
            $processWalletOwner = self::createdOwnerWalletHistory([
                'user_id'   => $dataTrx->user_id,
                'amount'    => $amount,
                'type'      => '6',
                'status'    => 'out',
                'trx_id'    => $trx_id,
                'insertTo'  => 'sys'
            ]);

        }

        return true;
    }

    public static function createdOwnerWalletHistory($data) {
        $userId  = $data['user_id'];
        $ownerId = User::where('role', '9')->first()->id;
        $amount  = $data['amount'];
        $type    = $data['type'];
        $status  = $data['status'];
        $trx_id  = $data['trx_id'];
        $inserTo = $data['insertTo'];

        $walletOwner = OwnerWallet::where('user_id', $ownerId)->first();
        $amount_sys  = $walletOwner->rbalance_amount;
        $amount_real = $walletOwner->rbalance_amount_real;

        $newAmount   = 0;
        $updateWallet= false;
        if ($inserTo == 'real') {
            // insert to real
            if ($status == 'in') {
                $newAmount = $amount_real + $amount;
            }else {
                $newAmount = $amount_real - $amount;
            }

            // update wallet owner
            $updateWallet        = OwnerWallet::whereId($walletOwner->id)->update(['rbalance_amount_real' => $newAmount]);

            // add history
            $updateWalletHistory = OwnerWalletRealHistory::create([
                'trx_at'            => date('Y-m-d H:i:s'),
                'trx_id'            => $trx_id,
                'trx_user_id'       => $userId,
                'type'              => $type,
                'owner_wallet_id'   => $walletOwner->id,
                'amount'            => $amount,
                'status'            => $status
            ]);
        }else { //sys
            // insert to wallet
            if ($status == 'in') {
                $newAmount = $amount_sys + $amount;
            }else {
                $newAmount = $amount_sys - $amount;
            }

            // update wallet owner
            $updateWallet = OwnerWallet::whereId($walletOwner->id)->update(['rbalance_amount' => $newAmount]);

            // add history
            $updateWalletHistory = OwnerWalletHistory::create([
                'trx_at'            => date('Y-m-d H:i:s'),
                'trx_id'            => $trx_id,
                'trx_user_id'       => $userId,
                'type'              => $type,
                'owner_wallet_id'   => $walletOwner->id,
                'amount'            => $amount,
                'status'            => $status
            ]);
        }

        return ($updateWallet) ? true : false;
    }

    public static function initDataUser($userId = 0, $referral = '') {
        // referal member
        $parent  = User::where('referral_code', $referral)->first();
        $process = Member::create([
            'parent_id' => ($parent) ? $parent->id : null,
            'user_id'   => $userId
        ]);

        // if ($referral) {
            // init rank transaction
            // contributor
            $contributor       = Rank::where('level', '0')->first();
            $dataRankTrxContri = [
                'user_id'                   => $userId,
                'parent_id'                 => ($parent) ? $parent->id : null,
                'rank_id'                   => $contributor->id,
                'direct_donator'            => $contributor->direct_donator,
                'must_have_dwline'          => $contributor->must_have_dwline,
                'total_team_donator'        => $contributor->total_team_donator,
                'rrank_donation_total'      => $contributor->rrank_donation_total,
                'rreward'                   => $contributor->rreward,
                'rsocial_event'             => $contributor->rsocial_event,
                'res_direct_donator'        => 0,
                'res_must_have_dwline'      => 0,
                'res_total_team_donator'    => 0,
                'res_rrank_donation_total'  => 0,
                'res_rreward'               => 0,
                'res_rsocial_event'         => 0,
                'status'                    => '1',
            ];

            $processContri = RankTransaction::create($dataRankTrxContri);

            // donator
            $donator          = Rank::where('level', '1')->first();
            $dataRankTrxDonat = [
                'user_id'                   => $userId,
                'parent_id'                 => ($parent) ? $parent->id : null,
                'rank_id'                   => $donator->id,
                'direct_donator'            => $donator->direct_donator,
                'must_have_dwline'          => $donator->must_have_dwline,
                'total_team_donator'        => $donator->total_team_donator,
                'rrank_donation_total'      => $donator->rrank_donation_total,
                'rreward'                   => $donator->rreward,
                'rsocial_event'             => $donator->rsocial_event,
                'res_direct_donator'        => 0,
                'res_must_have_dwline'      => 0,
                'res_total_team_donator'    => 0,
                'res_rrank_donation_total'  => 0,
                'res_rreward'               => 0,
                'res_rsocial_event'         => 0,
                'status'                    => '0',
            ];

            $processDonat = RankTransaction::create($dataRankTrxDonat);
            // queue cron job
            AllQueue::create([
                'reference_id' => $processDonat->id,
                'type'         => 'rank_register',
                'is_process'   => '0'
            ]);
        // }

        // wallet
        $process = UserWallet::create([
            'rbalance_amount' => 0,
            'user_id'         => $userId
        ]);

        $user     = User::find($userId);
        $token    = $user->createToken('web_token')->plainTextToken;
        $initRank = Rank::where('level', '0')->first();
        User::where(['id' => $userId])->update(['web_token' => $token, 'ref_temp' => null, 'rank_id' => $initRank->id]);
    }

    public static function referralCode() {
        return rand(0000000000, 9999999999);
    }

    public static function config($type = '') {
        $dataConfig = [];
        if ($type) {
            $data       = Config::where('key', $type)->first();
            if ($data) {
                $dataConfig = $data->value;
            }
        }else {
            $data       = Config::all();
            foreach ($data as $key => $value) {
                $dataConfig[$value->key] = $value->value;
            }
        }

        return ($type) ? $dataConfig : (object) $dataConfig;
    }

    public static function kindMeterCal($point = 0, $donation = 0) {
        $calculation = ($point/$donation) * 100;
        return $calculation;
    }

    public static function createdHisKindMeter($data) {
        return HisKindMeter::create($data);
    }

    public static function createdWalletHistory($data) {
        $trx_id     = $data['trx_id'];
        $type       = $data['type'];
        $user_id    = $data['user_id'];
        $amount     = $data['amount'];
        $status     = $data['status'];
        $userWallet = UserWallet::where('user_id', $user_id)->first();
        $newBalance = 0;

        if ($status == 'in') {
            $newBalance = $userWallet->rbalance_amount + $amount;
        }else {
            $newBalance = $userWallet->rbalance_amount - $amount;
        }

        // add user wallet
        $process = UserWallet::where('id', $userWallet->id)->update(['rbalance_amount' => (float)$newBalance]);

        // history
        $process = UserWalletHistory::create([
            'trx_at'          => date('Y-m-d H:i:s'),
            'trx_id'          => $trx_id,
            'type'            => $type,
            'user_id'         => $user_id,
            'user_wallet_id'  => $userWallet->id,
            'amount'          => $amount,
            'status'          => $status
        ]);

        return ($process) ? true : false;
    }



    public static function sendNotif($data) {
        /*
            Notification type
            - deposit
            - withdraw
            - internal_transfer
            - daily_challenge
        */

        return Notification::create([
            'type'          => isset($data['type']) ? $data['type'] : '',
            'message'       => isset($data['message']) ? $data['message'] : '',
            'from_user_id'  => isset($data['from_user_id']) ? $data['from_user_id'] : '',
            'to_user_id'    => isset($data['to_user_id']) ? $data['to_user_id'] : '',
            'is_read'       => isset($data['is_read']) ? $data['is_read'] : '0',
        ]);
    }

    public static function format_harga($angka, $prefix = '$', $decimal = 2){
        $hasil_rupiah = $prefix.number_format($angka,$decimal,',','.');
        return $hasil_rupiah;
    }

    public static function format_date($date, $format = 'D, d M Y H:i') {
        $newDate = Carbon::parse($date)->format($format);
        return $newDate;
    }

    public static function statusUser($id = '-') {
        $id = (string)$id;
        $data = [
            '0' => 'Unverified',
            '1' => 'Verified',
        ];

        return ($id != '-') ? $data[$id] : $data;
    }

    public static function statusUserClass($id = '-') {
        $id = (string)$id;
        $data = [
            '0' => 'danger',
            '1' => 'success',
        ];

        return ($id != '-') ? $data[$id] : $data;
    }

    public static function statusApproval($id = '-') {
        $id = (string)$id;
        $data = [
            '0' => 'Waiting For Review',
            '1' => 'Approved',
            '2' => 'Rejected',
        ];

        return ($id != '-') ? $data[$id] : $data;
    }

    public static function invoiceStatusClass($id = '-') {
        $id = (string)$id;
        $data = [
            '0' => 'warning',
            '1' => 'success',
            '2' => 'danger',
        ];

        return ($id != '-') ? $data[$id] : $data;
    }

    public static function role($id = '-') {
        $id = (string)$id;
        $data = [
            '0' => 'Member',
            '8' => 'Owner PT',
            '9' => 'Admin',
        ];

        return ($id != '-') ? $data[$id] : $data;
    }

    public static function packageType($id) {
        $id = (string)$id;
        $data = [
            '0' => 'Compliment',
            '1' => 'Donate',
        ];

        return ($id != '-') ? $data[$id] : $data;
    }

    public static function colorPackage($id) {
        $data = [
           'Regular'   => '#66B7E2',
           'Advance'   => '#439243',
           'Premium'   => '#E0E266',
           'Solitaire' => '#C84C4C'
        ];

        return ($id != '-') ? (isset($data[$id]) ? $data[$id] : $data[0]) : $data;
    }

    public static function ratePackage($amount, $fee) {
        $configRate = self::config('donation_rate');
        return ($amount * $configRate) + $fee;
    }

    public static function typeTrx($id) {
        $data = [
            '1'  => 'Deposit',
            '2'  => 'Withdrawal',
            '3'  => 'Transfer',
            '4'  => 'Donation Package',
            '5'  => 'Daily Blessing',
            '6'  => 'Reward',
            '7'  => 'Social Event',
            '8'  => 'Different Rate',
            '9'  => 'Package Redeem',
            '10' => 'End Of Donation',
        ];

        return ($id != '-') ? (isset($data[$id]) ? $data[$id] : $data[0]) : $data;
    }
}
