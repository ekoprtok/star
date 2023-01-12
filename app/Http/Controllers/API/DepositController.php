<?php

namespace App\Http\Controllers\API;

use Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\User;
use App\Models\PaymentMethod;

class DepositController extends Controller {

    public function index(Request $request) {
        $draw       = $request->get('draw');
        $search     = $request->get('search')['value'];
        $offset     = $request->get('start') -1;
        $limit      = $request->get('length');

        $data       = Deposit::where(function($query) use ($search) {
            $query->where('invoice_number', 'LIKE', '%'.$search.'%')
                  ->orWhere('payment_method', 'LIKE', '%'.$search.'%')
                  ->orWhere('amount', 'LIKE', '%'.$search.'%');
        })->offset($offset)->limit($limit)->orderByDesc('created_at')->get();

        if ($data) {
            foreach ($data as $key => $value) {
                $this->setAttribute($value);
            }
        }

        $dataCount  = Deposit::where(function($query) use ($search) {
            $query->where('invoice_number', 'LIKE', '%'.$search.'%')
                    ->orWhere('payment_method', 'LIKE', '%'.$search.'%')
                    ->orWhere('amount', 'LIKE', '%'.$search.'%');
        })->orderByDesc('created_at')->count();

        return response()->json([
            'draw'            => $draw,
            'recordsTotal'    => $dataCount,
            'recordsFiltered' => $dataCount,
            'data'            => $data,
            'success'         => true
        ]);
    }

    public function uploadImage(Request $request) {
        $filename = time() . '.' . $request->file->extension();
        $request->file->move(public_path('uploads/confirm'), $filename);

        $update = Deposit::where('id', $request->invoice)->update([
            'status'        => '1',
            'confirm_file'  => $filename
        ]);

        return response()->json([
            'success' => ($update ? true : false),
            'message' => ($update ? 'Confirmation has been submited' : 'Confirmation failed to submit, please try again'),
        ]);
    }

    public function createDeposit(Request $request) {
        $validated = $request->validate([
            'amount'            => 'required|numeric',
            'payment_method'    => 'required'
        ]);

        $data = $request->all();
        unset($data['_token']);
        $data['invoice_number']   = random_int(1000000, 9999999);
        $data['rate']             = 0;
        $data['expired']          = date("Y/m/d H:i:s", strtotime("+30 minutes"));
        $create = Deposit::create($data);

        return response()->json([
            'success' => ($create ? true : false),
            'message' => ($create ? 'Your deposit has been successfully created.' : 'Error processing data, please try again.')
        ]);
    }

    public function detail(Request $request) {
        $data = Deposit::find($request->id);
        if ($data) {
            $this->setAttribute($data);
        }
        return response()->json([
            'data' => $data
        ]);
    }

    public function setAttribute($value) {
        $payment                = PaymentMethod::where('name', $value->payment_method)->first();
        $user                   = User::find($value->created_by);
        $value->invoice_number  = '<a href="javascript:void(0)" onclick="detail(\''.route('deposit.detail', ['id' => $value->id]).'\')" class="fw-bold">#'.$value->invoice_number.'</a>';
        $value->amount          = Helper::format_harga($value->amount);
        $value->status_f        = '<span class="badge badge-dot bg-'.Helper::invoiceStatusClass($value->status).'">'.Helper::invoiceStatus($value->status).'</span>';
        $value->created_at_f    = Helper::format_date($value->create_at);
        $value->address         = ($payment) ? $payment->address : '-';
        $value->icon_f          = ($payment) ? '<em class="icon '.$payment->icon.'"></em>' : '-';
        $value->expired_at      = $value->expired;
        $value->name            = ($user) ? $user->name : '-';
        $value->act             = '
            <div class="drodown">
                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                <div class="dropdown-menu dropdown-menu-end">
                    <ul class="link-list-opt no-bdr">
                        <li>
                            <a href="javascript:void(0)" onclick="detail(\''.route('deposit.detail', ['id' => $value->id]).'\')">
                                <span>View</span>
                            </a>
                        </li>
                        '.
                        (
                            $value->status == '0' ?
                            '<li>
                                <a href="javascript:void(0)" onclick="confirma(\''.$value->id.'\')">
                                    <span>Confirm</span>
                                </a>
                            </li>' : ''
                        )
                        .'
                    </ul>
                </div>
            </div>
        ';
    }

    public function getNeeds() {
        $data = [
            'payment_method' => PaymentMethod::where('status', '1')->get()
        ];

        return response()->json($data);
    }

}
