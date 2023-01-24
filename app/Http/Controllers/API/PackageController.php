<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use Helper;

class PackageController extends Controller {

    public function index() {
        $data = Package::all();
        if ($data) {
            foreach ($data as $key => $value) {
                $this->setAttr($value, $key);
            }
        }
        return response()->json([
            'data' => $data
        ]);
    }

    public function formCrud(Request $request) {
        $id = $request->id ? Helper::decrypt($request->id) : '';
        $validated = $request->validate([
            'name'            => 'required|min:4',
            'rvalue'          => 'required',
            'level'           => 'required',
            'rdonation'       => 'required',
            'rjoin_fee'       => 'required',
            'rdaily_blessing' => 'required',
            'created_by'      => 'required',
        ]);

        if ($id) {
            $process = Package::where('id', $id)->update([
                'name'            => $request->name,
                'rvalue'          => $request->rvalue,
                'level'           => $request->level,
                'rdonation'       => $request->rdonation,
                'rjoin_fee'       => $request->rjoin_fee,
                'rdaily_blessing' => $request->rdaily_blessing,
                'created_by'      => $request->created_by,
                'img_url'         => null,
            ]);
        } else {
            $process = Package::create([
                'name'            => $request->name,
                'rvalue'          => $request->rvalue,
                'level'           => $request->level,
                'rdonation'       => $request->rdonation,
                'rjoin_fee'       => $request->rjoin_fee,
                'rdaily_blessing' => $request->rdaily_blessing,
                'created_by'      => $request->created_by,
                'img_url'         => null,
            ]);
        }

        return response()->json([
            'success' => $process ? true : false,
            'message' => 'Package has been procesed',
        ]);
    }

    public function getEdit(Request $request) {
        $data = Package::find(Helper::decrypt($request->id));
        if ($data) {
            $data->idx = Helper::encrypt($request->id);
        }
        return $data;
    }

    public function packageList(Request $request) {
        $draw = $request->get('draw');
        $search = $request->get('search')['value'];
        $offset = $request->get('start') - 1;
        $limit = $request->get('length');

        $data = Package::where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->offset($offset)
            ->limit($limit)
            ->orderByDesc('created_at')
            ->get();

        if ($data) {
            foreach ($data as $key => $value) {
                $this->setAttr($value, $key);
            }
        }

        $dataCount = Package::where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
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

    public function setAttr($value, $key) {
        $value->rvalue          = Helper::format_harga($value->rvalue);
        $value->rdonation       = Helper::format_harga($value->rdonation);
        $value->rjoin_fee       = Helper::format_harga($value->rjoin_fee);
        $value->rdaily_blessing = Helper::format_harga($value->rdaily_blessing);
        $value->action =
            '
            <a class="text-danger" href="javascript:void(0)" onclick="deleting(\'' .Helper::encrypt($value->id) .'\')" title="delete">
                <i class="fs-16px bi bi-trash text-muted"></i>
            </a>
                &nbsp;&nbsp;
            <a class="text-primary" href="' .route('admin.package.form', ['id' => Helper::encrypt($value->id)]) .'" title="edit">
                <i class="fs-16px bi bi-pencil-square text-muted"></i>
            </a>
        ';
    }
}
