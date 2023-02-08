<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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
}
