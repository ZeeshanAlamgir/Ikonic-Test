<?php

// namespace App\Utils\Helpers;

// class FileUtils

use App\Models\User;
use Illuminate\Support\Facades\Auth;

{
    if(!function_exists('successResponse'))
    {
        function successResponse($data = null, $message = 'data found', $key = 'success')
        {
            return response()->json(
                [
                    'status' => true,
                    'message' => $message,
                    'data' => $data,
                    'stauts_code' => '200'
                ]
            );
        }
    }

    if (!function_exists('errorResponse')) {
        function errorResponse($message = 'data not found', $key = 'error')
        {
            return response()->json(
                [
                    'status' => false,
                    'message' => $message,
                    'data' => null,
                    'stauts_code' => '200'
                ]
            );
        }

        if(!function_exists('suggestions'))
        {
            function suggestions()
            {
                $user = auth()->user();
                $suggestionUsers = (new User())->where('id','!=',Auth::user()->id);
                $receiver_ids = $user->sendRequests->pluck('receiver_id')->toArray();
                $suggestionUsers = $suggestionUsers->whereNotIn('id',$receiver_ids);
                $sender_ids = $user->receivedRequests->pluck('sender_id')->toArray();
                $suggestionUsers = $suggestionUsers->whereNotIn('id',$sender_ids);
                $connections_ids = $user->connections->pluck('connection_id')->toArray();
                $suggestionUsers = $suggestionUsers->whereNotIn('id',$connections_ids)->get();
                $data = 
                [
                    'suggestionsUsers'      => $suggestionUsers,
                    'suggestionsUsersCount' => $suggestionUsers->count(),
                ];
                $data = (collect($data));
                return $data;
            }
        }
    }
}
