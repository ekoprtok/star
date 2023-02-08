<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AllQueue;
use App\Models\RankTransaction;
use App\Models\Member;
use App\Models\User;
use App\Models\TrxPackage;
use Helper;

class CronJobController extends Controller {

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
