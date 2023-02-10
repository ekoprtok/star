<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rank;
use App\Models\User;

use Helper;

class RankController extends Controller {

    public function index(Request $request) {
        $draw   = $request->get('draw');
        $search = $request->get('search')['value'];
        $offset = $request->get('start') - 1;
        $limit  = $request->get('length');

        $data = Rank::where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%')->orWhere('level', 'LIKE', '%' . $search . '%');
        })->where('is_contributor', '0')->offset($offset)
            ->limit($limit)
            ->orderByDesc('created_at')
            ->get();

        if ($data) {
            foreach ($data as $key => $value) {
                $value->total_team_donator   = Helper::format_harga($value->total_team_donator, '', 0);
                $value->rrank_donation_total = Helper::format_harga($value->rrank_donation_total);
                $value->rreward              = Helper::format_harga($value->rreward);
                $value->rsocial_event        = Helper::format_harga($value->rsocial_event);

                $value->action     =
                '
                    <a class="text-danger" href="javascript:void(0)" onclick="deleting(\'' .$value->id.'\')" title="delete">
                        <i class="fs-16px bi bi-trash text-muted"></i>
                    </a>
                        &nbsp;&nbsp;
                    <a class="text-primary" href="' .route('admin.rank.form', ['id' => $value->id]) .'" title="edit">
                        <i class="fs-16px bi bi-pencil-square text-muted"></i>
                    </a>
                ';
            }
        }

        $dataCount = Rank::where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%')->orWhere('level', 'LIKE', '%' . $search . '%');
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

    public function rankDelete(Request $request) {
        $checkRank   = RankTransaction::where('rank_id', $request->id)->count();

        if ($checkRank > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Rank already used',
            ]);
        }

        $process        = Rank::where('id', $request->id)->delete();
        return response()->json([
            'success' => $process ? true : false,
            'message' => $process ? 'Rank has been delete' : 'Error processing data, please try again.',
        ]);
    }

    public function rankProcess(Request $request) {
        $id        = $request->id;
        $validated = $request->validate([
            'level'                  => 'required',
            'name'                   => 'required|min:4|max:255',
            'direct_donator'         => 'required',
            'must_have_dwline'       => 'required',
            'total_team_donator'     => 'required',
            'rrank_donation_total'   => 'required',
            'rreward'                => 'required',
            'rsocial_event'          => 'required'
        ]);

        if (!$id) {
            $checkLevel = Rank::where('level', $request->level)->count();
            if ($checkLevel > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Level already used',
                ]);
            }

            $checkName = Rank::where('name', $request->name)->count();
            if ($checkName > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Name already used',
                ]);
            }
        }else {
            $checkName = Rank::where('name', $request->name)->where('id', '!=', $id)->count();
            if ($checkName > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Name already used',
                ]);
            }

            $checkLevel = Rank::where('level', $request->level)->where('id', '!=', $id)->count();
            if ($checkLevel > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Level already used',
                ]);
            }
        }

        if ($id) {
            $process = Rank::where('id', $id)->update([
                'level'                  => $request->level,
                'name'                   => $request->name,
                'direct_donator'         => $request->direct_donator,
                'must_have_dwline'       => $request->must_have_dwline,
                'total_team_donator'     => $request->total_team_donator,
                'rrank_donation_total'   => $request->rrank_donation_total,
                'rreward'                => $request->rreward,
                'rsocial_event'          => $request->rsocial_event,
                'is_contributor'         => '0'
            ]);
        }else {
            $process = Rank::create([
                'level'                  => $request->level,
                'name'                   => $request->name,
                'direct_donator'         => $request->direct_donator,
                'must_have_dwline'       => $request->must_have_dwline,
                'total_team_donator'     => $request->total_team_donator,
                'rrank_donation_total'   => $request->rrank_donation_total,
                'rreward'                => $request->rreward,
                'rsocial_event'          => $request->rsocial_event,
                'is_contributor'         => '0'
            ]);
        }

        return response()->json([
            'success' => $process ? true : false,
            'message' => $process ? 'Rank has been procesed' : 'Error processing data, please try again.',
        ]);
    }

    public function rankEdit(Request $request) {
        return Rank::find($request->id);
    }

}
