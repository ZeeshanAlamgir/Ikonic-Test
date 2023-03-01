<?php

namespace App\Http\Controllers\Web\SuggestionController;

use App\Http\Controllers\Controller;
use App\Models\SendRequest;
use App\Models\Suggestion;
use App\Models\User;
use App\Models\UserRequest;
use App\Traits\SuggestionTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuggestionController extends Controller
{
    use SuggestionTrait;
    public function index(Request $request)
    {
        if($request->ajax())
        {
            // $user = auth()->user();
            // $suggestionUsers = (new User())->where('id','!=',Auth::user()->id);
            // $receiver_ids = $user->sendRequests->pluck('receiver_id')->toArray();
            // $suggestionUsers = $suggestionUsers->whereNotIn('id',$receiver_ids);
            // $sender_ids = $user->receivedRequests->pluck('sender_id')->toArray();
            // $suggestionUsers = $suggestionUsers->whereNotIn('id',$sender_ids);
            // $connections_ids = $user->connections->pluck('connection_id')->toArray();
            // $suggestionUsers = $suggestionUsers->whereNotIn('id',$connections_ids)->get();
            // $data = 
            // [
            //     'suggestionsUsers'      => $suggestionUsers,
            //     'suggestionsUsersCount' => $suggestionUsers->count(),
            //     'user_id'               => auth()->user()->id,
            // ];
            // $data = (collect($data));
            $data = $this->suggestions();
            return successResponse($data);
        }
    }

    public function store($senderId, $receiverId)
    {
        // dd($senderId, $receiverId);
        $userRequest = (new UserRequest());
        $userRequest->sender_id = (int)$senderId; 
        $userRequest->receiver_id = $receiverId; 
        $userRequest->save();
    }
}
