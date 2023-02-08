<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrxSocialEvent;
use Helper;

class SocialEventController extends Controller {

    public function process(Request $request) {
        $validated = $request->validate([
            'event_at'     => 'required',
            'user_id'      => 'required',
            'rank_id'      => 'required',
            'description'  => 'required|min:8',
            'file_path'    => 'required',
        ]);

        $process = TrxSocialEvent::create([
            'submitted_at'  => date('Y-m-d H:i:s'),
            'event_at'      => date('Y-m-d H:i:s', strtotime($request->event_at)),
            'user_id'       => $request->user_id,
            'rank_id'       => $request->rank_id,
            'description'   => nl2br($request->description),
            'file_path'     => $request->file_path,
            'status'        => '0',
        ]);

        return response()->json([
            'success' => ($process ? true : false),
            'message' => ($process ? 'Your social event has been successfully submit' : 'Error processing data, please try again.')
        ]);

    }

    public function processAdmin(Request $request) {
        $socialEvent = TrxSocialEvent::whereId($request->id)->first();
        $process     = TrxSocialEvent::whereId($request->id)->update([
            'status'       => $request->status,
            'responsed_by' => $request->user_id,
            'responsed_at' => date('Y-m-d H:i:s')
        ]);

        if ($request->status == '1') {
            // notif
            $process = Helper::sendNotif([
                'type'          => "social_event",
                'message'       => "Your social event request has been rejected",
                'from_user_id'  => "2",
                'to_user_id'    => $socialEvent->user_id
            ]);
        }else {
            // notif
            $process = Helper::sendNotif([
                'type'          => "social_event",
                'message'       => "Your social event request has been rejected",
                'from_user_id'  => "2",
                'to_user_id'    => $socialEvent->user_id
            ]);
        }

        return response()->json([
            'success' => ($process ? true : false),
            'message' => ($process ? 'Social event has been successfully process' : 'Error processing data, please try again.')
        ]);
    }

    public function uploadImage(Request $request) {
        $filename = time() . '.' . $request->file->extension();
        $process  = $request->file->move(public_path('uploads/socialEvent'), $filename);

        return response()->json([
            'success' => ($process ? true : false),
            'data'    => $filename,
            'message' => ($process ? 'Image uploaded' : 'Failed to upload image, please try again'),
        ]);
    }

}
