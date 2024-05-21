<?php

namespace App\Http\Controllers\Api;

use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionLogController extends Controller
{
    //create action log
    public function createAction(Request $request){

        $data = [
            'user_id' => $request->user_id,
            'post_id' => $request->post_id
        ];

        ActionLog::create($data);
        $result = ActionLog::where('post_id',$request->post_id)->get();

        return response()->json([
            'result' => $result
        ]);
    }
}
