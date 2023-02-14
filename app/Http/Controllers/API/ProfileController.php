<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserWallet;
use Hash;

class ProfileController extends Controller {

    public function changePassword(Request $request) {
        $validated = $request->validate([
            'old_password'  => 'required',
            'new_password'  => 'required|confirmed'
        ]);

        $user = User::find($request->user_id);
        if(!Hash::check($request->old_password, $user->password)){
            return response()->json([
                'success' => false,
                'message' => 'Old Password Doesn\'t match!'
            ], 206);
        }

        $process = User::whereId($request->user_id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json([
            'success' => ($process) ? true : false,
            'message' => ($process) ? 'Your password has been updated' : 'Error processing data, please try again.'
        ]);
    }

    public function walletAddressForm(Request $request) {
        $validated = $request->validate([
            'address'   => 'required',
            'user_id'   => 'required'
        ]);

        $process = UserWallet::where(['user_id' => $request->user_id])->update([
            'wallet_address' => $request->address
        ]);

        return response()->json([
            'success' => ($process) ? true : false,
            'message' => ($process) ? 'Your wallet address has been updated' : 'Error processing data, please try again.'
        ]);
    }

    public function walletAddressGet(Request $request) {
        $data = UserWallet::where(['user_id' => $request->user_id])->first();
        return response()->json(($data) ? $data->wallet_address : '');
    }

    public function authenticatorRequest(Request $request) {
        $google2fa  = app('pragmarx.google2fa');
        $secret     = $google2fa->generateSecretKey();
        $qrImage    = $google2fa->getQRCodeInline(
            config('app.name'),
            $request->email,
            $secret
        );

        $updateCode = User::where('email', $request->email)->update(['google_secret' => $secret]);

        return response()->json([
            'qrimage' => view('dashboard.profile.2fa', compact('qrImage'))->render(),
            'secret'  => $secret
        ]);
    }

    public function authenticatorCheck(Request $request) {
        $validated = $request->validate([
            'authenticator_code' => 'required|min:6|max:6'
        ]);
        $user       = User::where('email', $request->email)->first();
        $google2fa  = app('pragmarx.google2fa');
        $valid      = $google2fa->verifyKey($user->google_secret, $request->authenticator_code);
        if ($valid) {
            $updateCode = User::where('email', $request->email)->update(['is_active_2fa' => '1', 'have_input_2fa' => '1']);
        }

        return response()->json([
            'success' => $valid,
            'message' => ($valid) ? 'Authenticator successfully activated' : 'Wrong authenticator code'
        ]);
    }

    public function authenticatorUnactive(Request $request) {
        $process = User::where('email', $request->email)->update(['is_active_2fa' => '0', 'google_secret' => null, 'have_input_2fa' => '0']);
        return response()->json([
            'success' => $process,
            'message' => ($process) ? 'Authenticator successfully deactivate' : 'Error processing data, please try again.'
        ]);
    }
}
