<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AllQueue;
use App\Models\RankTransaction;
use App\Models\Member;
use App\Models\User;
use App\Models\TrxPackage;
use App\Models\UserPackage;
use App\Models\Package;
use App\Models\Rank;
use App\Models\ProqueDifferenceRate;
use App\Models\ProqueDifferenceRateDetail;
use Helper;

class CronJobController extends Controller {

    public function rateDiff() {
        $data = AllQueue::where(['type' => 'difference_rate', 'is_process' => '0'])->get();
        if ($data) {
            foreach ($data as $key => $value) {
                $configMaxRate = Helper::config('diff_rate_max');
                $proqueDiff    = ProqueDifferenceRate::create([
                    'queue_id'          => $value->id,
                    'trx_packages_id'   => $value->reference_id,
                    'diff_rate_max'     => $configMaxRate,
                    'is_process'        => '0',
                ]);

                $dataTrxPackage = TrxPackage::whereId($value->reference_id)->first();
                if ($dataTrxPackage) {
                    $dataPackage = Package::whereId($dataTrxPackage->package_id)->first();
                    $rDonation   = ($dataPackage) ? $dataPackage->rdonation : 0;
                    $parents     = [];
                    $sparentid   = '';
                    $suserid     = $dataTrxPackage->user_id;
                    do {
                        $data = Member::where(['user_id' => $suserid])->first();
                        if ($data && $data->parent_id != null) {
                            $parents[] = $data->parent_id;
                        }
                        $sparentid = ($data) ? $data->parent_id : null;
                        $suserid   = $sparentid;
                    } while ($sparentid != null);

                    $dataInsert    = [];
                    $acumRate      = 0;
                    $acumRateMax   = 0;
                    // fisrt parent
                    $firstParentId = isset($parents[0]) ? $parents[0] : 0;
                    if ($firstParentId) {
                        $user          = User::find($firstParentId);
                        $dataRank      = Rank::find($user->rank_id);
                        $myRank        = ($dataRank) ? $dataRank->level : 0;
                        $myRankId      = ($dataRank) ? $dataRank->id : 0;
                        $acumRate     += $dataRank->diff_rate;
                        $acumRateMax  += $dataRank->diff_rate;
                        $dataInsert[]  = [
                            'proque_id' => $proqueDiff->id,
                            'user_id'   => $firstParentId,
                            'rank_id'   => $myRankId,
                            'rate'      => $acumRate,
                            'rdonation' => $rDonation,
                            'ramount'   => ($acumRate * $rDonation),
                            'isMore'    => $acumRateMax.' => low'
                        ];

                        foreach ($parents as $kp => $vp) {
                            // stop if max rate
                            // if ($acumRateMax >= $configMaxRate) {
                                $next = ($kp == 0) ? 1 : ($kp+1);
                                if (isset($parents[$next])) {
                                    $userParent     = User::find($parents[$next]);
                                    $dataRankParent = Rank::find($userParent->rank_id);
                                    $myRankParent   = ($dataRankParent) ? $dataRankParent->level : 0;
                                    $myRankParentId = ($dataRankParent) ? $dataRankParent->id : 0;
                                    // rank next more than rank before parent
                                    if ($myRankParent > $myRank) {
                                        $rate         = ($dataRankParent->diff_rate - $acumRate);
                                        $dataInsert[] = [
                                            'proque_id' => $proqueDiff->id,
                                            'user_id'   => $parents[$next],
                                            'rank_id'   => $myRankParentId,
                                            'rate'      => $rate,
                                            'rdonation' => $rDonation,
                                            'ramount'   => ($rate * $rDonation),
                                            'isMore'    => $acumRateMax.' => '.($acumRateMax >= $configMaxRate ? 'more' : 'low')
                                        ];
                                        $acumRate    += $rate;
                                        $acumRateMax += $acumRate;
                                    }
                                }
                            // }
                        }

                        $remainderBalance = Helper::config('diff_rate_max') * $rDonation;
                        if ($dataInsert) {
                            foreach ($dataInsert as $kd => $vd) {
                                if ($vd['rate'] > 0) {
                                    unset($vd['isMore']);
                                    $processDetail = ProqueDifferenceRateDetail::create($vd);
                                    $updateProque  = ProqueDifferenceRate::whereId($proqueDiff->id)->update(['is_process' => '1']);
                                    $updateQueue   = AllQueue::whereId($value->id)->update(['is_process' => '1']);

                                    // add wallet user
                                    $addWalletUser = Helper::createdWalletHistory([
                                        'trx_id'    => $dataTrxPackage->id,
                                        'type'      => '8',
                                        'user_id'   => $vd['user_id'],
                                        'amount'    => $vd['ramount'],
                                        'status'    => 'in'
                                    ]);

                                    // reduce wallet owner
                                    $reduceWalletOwner = Helper::createdOwnerWalletHistory([
                                        'user_id'  => $vd['user_id'],
                                        'amount'   => $vd['ramount'],
                                        'type'     => '3',
                                        'status'   => 'out',
                                        'trx_id'   => $dataTrxPackage->id,
                                        'insertTo' => 'sys'
                                    ]);

                                    $remainderBalance -= $vd['ramount'];
                                }
                            }

                            // add wallet owner
                            $addWalletOwner = Helper::createdOwnerWalletHistory([
                                'user_id'  => $dataTrxPackage->user_id,
                                'amount'   => $remainderBalance,
                                'type'     => '2',
                                'status'   => 'in',
                                'trx_id'   => $dataTrxPackage->id,
                                'insertTo' => 'sys'
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function kindnesMeterDownline() {
        $process = Helper::kindnesMeterDownline();
    }

    public function endOfDonation() {
        $data = TrxPackage::all();
        if ($data) {
            foreach ($data as $key => $value) {
                $process = Helper::createdEndOfDonation($value->id);
            }
        }
    }

    public function loopTrxRank() {
        // Update data of the Opened Parent
        $data = AllQueue::where(['is_process' => '0', 'type' => 'rank_register'])->get();
        if ($data) {
            foreach ($data as $key => $value) {
                $rankTrx = RankTransaction::find($value->reference_id);
                $result  = $this->findParent($rankTrx->user_id);
                foreach ($result as $k => $v) {
                    $oldTrxData = RankTransaction::where(['user_id' => $v, 'status' => '0'])->first();
                    if ($oldTrxData) {
                        $updateTrxRank = RankTransaction::whereId($oldTrxData->id)->update([
                            'res_direct_donator'     => ($oldTrxData->res_direct_donator + 1),
                            'res_total_team_donator' => ($oldTrxData->res_total_team_donator + 1)
                        ]);
                    }
                }
                $queueProcessed = AllQueue::whereId($value->id)->update(['is_process' => '1']);
            }
        }
    }

    public function must_have() {

    }

    public function findParent($userId) {
        $parents    = [];
        $sparentid  = '';
        $suserid    = $userId;
        do {
            $data = RankTransaction::where(['user_id' => $suserid, 'status' => '0'])->first();
            if ($data && $data->parent_id != null) {
                $parents[] = $data->parent_id;
            }
            $sparentid = ($data) ? $data->parent_id : null;
            $suserid   = $sparentid;
        } while ($sparentid != null);

        return $parents;
    }

    public function findChild($parentId) {
        $childs     = [];
        $schildid   = '';
        $suserid    = $parentId;
        do {
            $data = RankTransaction::where(['parent_id' => $suserid, 'status' => '0'])->first();
            if ($data && $data->parent_id != null) {
                $childs[] = $data->user_id;
            }
            $schildid = ($data) ? $data->user_id : null;
            $suserid   = $schildid;
        } while ($schildid != null);

        return $childs;
    }
}
