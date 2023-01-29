<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DailyChallenge;
use App\Helpers\Helper;

class DailyController extends Controller {

    public function index(Request $request) {
        $draw = $request->get('draw');
        $search = $request->get('search')['value'];
        $offset = $request->get('start') - 1;
        $limit = $request->get('length');

        $data = DailyChallenge::where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%')->orWhere('percentage', 'LIKE', '%' . $search . '%');
        })->offset($offset)
            ->limit($limit)
            ->orderByDesc('created_at')
            ->get();

        if ($data) {
            foreach ($data as $key => $value) {
                $this->setAttrDaily($value, $key);
            }
        }

        $dataCount = DailyChallenge::where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%')->orWhere('percentage', 'LIKE', '%' . $search . '%');
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

    public function getEdit(Request $request) {
        $data = DailyChallenge::find(Helper::decrypt($request->id));
        if ($data) {
            $data->idx = Helper::encrypt($request->id);
        }
        return $data;
    }

    public function formCrud(Request $request) {
        $id = $request->id ? Helper::decrypt($request->id) : '';
        $validated = $request->validate([
            'name'       => 'required|min:8',
            'percentage' => 'required|between:0.1,100',
        ]);

        if ($id) {
            $process = DailyChallenge::where('id', $id)->update([
                'name'       => $request->name,
                'percentage' => $request->percentage,
            ]);
        } else {
            $process = DailyChallenge::create([
                'name'       => $request->name,
                'percentage' => $request->percentage,
            ]);
        }

        return response()->json([
            'success' => $process ? true : false,
            'message' => 'Daily challenge has been procesed',
        ]);
    }

    public function dailyDelete(Request $request) {
        $id = Helper::decrypt($request->id);
        $process = DailyChallenge::where('id', $id)->delete();
        return response()->json([
            'success' => $process ? true : false,
            'message' => 'Daily challenge has been deleted',
        ]);
    }

    public function setAttrDaily($value, $key) {
        $value->no = $key + 1;
        $value->percentage = $value->percentage . '%';
        $value->action =
            '
            <a class="text-danger" href="javascript:void(0)" onclick="deleting(\'' .Helper::encrypt($value->id) .'\')" title="delete">
                <i class="fs-16px bi bi-trash text-muted"></i>
            </a>
                &nbsp;&nbsp;
            <a class="text-primary" href="' .route('admin.daily.form', ['id' => Helper::encrypt($value->id)]) .'" title="edit">
                <i class="fs-16px bi bi-pencil-square text-muted"></i>
            </a>
        ';
    }
}
