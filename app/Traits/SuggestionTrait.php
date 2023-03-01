<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait SuggestionTrait
{
    public function suggestions()
    {
        $user = auth()->user();
        $suggestionUsers = (new User())->where('id','!=',Auth::user()->id);
        $receiver_ids = $user->sendRequests->pluck('receiver_id')->toArray();
        $suggestionUsers = $suggestionUsers->whereNotIn('id',$receiver_ids);
        $sender_ids = $user->receivedRequests->pluck('sender_id')->toArray();
        $suggestionUsers = $suggestionUsers->whereNotIn('id',$sender_ids);
        $connections_ids = $user->connections->pluck('connection_id')->toArray();
        $suggestionUsers = $suggestionUsers->whereNotIn('id',$connections_ids)->paginate(10);
        $data = 
        [
            'suggestionsUsers'      => $suggestionUsers,
            'suggestionsUsersCount' => $suggestionUsers->count(),
            'userId'                => $user->id,
            'count'                 => (new User())->count()-1
        ];
        $data = (collect($data));
        return $data;
    }
}
