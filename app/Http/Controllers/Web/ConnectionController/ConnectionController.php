<?php

namespace App\Http\Controllers\Web\ConnectionController;

use App\Http\Controllers\Controller;
use App\Models\Connection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConnectionController extends Controller
{
    public function index()
    {   
        $connectionIds = (new Connection())->where('user_id',auth()->user()->id)->pluck('connection_id')->toArray();
        // dump($connectionIds);
        $mutualFriendIds = (new Connection())->whereIn('id',$connectionIds)->pluck('connection_id')->toArray();
        // dd($mutualFriendIds);
        $mutualFreinds = (new User())->whereIn('id',$mutualFriendIds)->get();
        $users = (new User())->whereIn('id',$connectionIds)->get();
        if(isset($users))
        {
            $data = [
                'userId'        => auth()->user()->id,
                'my_connections'  => [
                    'users'=>$users,
                    'mutual_friends'    => $mutualFreinds,
                    'mutual_friends_count'   => count($mutualFreinds),
                ] ,
                'count'         => count($users),
            ];
            // dd($data);
            return successResponse($data);
        }
        else 
        {
            return errorResponse();
        }
    }  

    public function delete($userId, $connectionId)
    {
        (new Connection())->where('connection_id',$connectionId)->delete();
        return self::index();
    }
}
