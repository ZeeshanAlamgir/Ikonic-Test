<?php

namespace App\Http\Controllers\Web\RequestController;

use App\Http\Controllers\Controller;
use App\Models\Connection;
use App\Models\User;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    public function store($userId, $requestId)
    {
        $conn = (new Connection());
        $conn->user_id = $userId;
        $conn->connection_id = $requestId;
        $conn->save();
        (new UserRequest())->where('sender_id',$requestId)->delete();
        return self::recieverUsers($userId);
    }  

    public function show(Request $request)
    {
        $userId = auth()->user()->id;
        if($request->mode=='sent_reqs')
        {
            return self::senderUsers($userId);
        }
        else if($request->mode == 'received_reqs')
        {
            return self::recieverUsers($userId);
        }
    }

    public function delete($userId, $requestId)
    {
        (new UserRequest())->where('receiver_id',$requestId)->delete();
        return self::senderUsers($userId);
    }
    
    public function recieverUsers($userId)
    {
        $receiverArr = [];
        $count = 0;
        $receiverUserRequests = (new User())->with(['receivedRequests'=>function($q) use($userId){
            $q->where('receiver_id',$userId);
        }])
        ->whereHas('receivedRequests',function($q) use($userId){
            $q->where('receiver_id',$userId);
            
        })->get();
        foreach($receiverUserRequests as $receiverUserRequest)
        {
            foreach($receiverUserRequest->receivedRequests as $key=>$sendRequest)
            {
                $key=1;
                $count+=$key;
                $users = (new User())->where('id',$sendRequest->sender_id)->first();
                array_push($receiverArr,$users);
            }
        }
        if(isset($receiverArr) && count($receiverArr)>0)
        {
            $data = [
                'userId'        => $userId,
                'receiverRequest'  => $receiverArr,
                'count'         => $count,
                'mode'          => 'received'
            ];
            return successResponse($data);
        }
        else
        {
            return errorResponse();
        }
    }

    public function senderUsers($userId)
    {
        $senderArr = [];
        $count = 0;
        $sendUserRequests = (new User())->with(['sendRequests'=>function($q) use($userId){
            $q->where('sender_id',$userId);
        }])
        ->whereHas('sendRequests',function($q) use($userId){
            $q->where('sender_id',$userId);
        })->get();
        // dd($sendUserRequests);
        foreach($sendUserRequests as $sendUserRequest)
        {
            foreach($sendUserRequest->sendRequests as $key=>$sendRequest)
            {
                $key=1;
                $count+=$key;
                $users = (new User())->where('id',$sendRequest->receiver_id)->first();
                array_push($senderArr,$users);
            }
        }
        if(isset($senderArr) && count($senderArr)>0 && $senderArr!=[])
        {
            $data = [
                'userId'        => $userId,
                'sendRequests'  => $senderArr,
                'count'         => $count,
                'mode'          => 'sent'
            ];
            return successResponse($data);
        }
        else
        {
            return errorResponse();
        }
    }
}

