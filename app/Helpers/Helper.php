<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use App\Models\Account;
use App\Models\Notification;

use Tarikh\PhpMeta\MetaTraderClient;

class Helper {

    public static function encrypt($string) {
        return Crypt::encryptString($string);
    }

    public static function decrypt($string) {
        return Crypt::decryptString($string);
    }

    public static function sendNotif($data) {
        /*
            Notification type
            - deposit
            - withdraw
            - internal_transfer
        */

        return Notification::create([
            'type'          => isset($data['type']) ? $data['type'] : '',
            'message'       => isset($data['message']) ? $data['message'] : '',
            'from_user_id'  => isset($data['from_user_id']) ? $data['from_user_id'] : '',
            'to_user_id'    => isset($data['to_user_id']) ? $data['to_user_id'] : '',
            'is_read'       => isset($data['is_read']) ? $data['is_read'] : '0',
        ]);
    }

    public static function format_harga($angka, $prefix = '$'){
        $hasil_rupiah = $prefix.number_format($angka,2,',','.');
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

}
