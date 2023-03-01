<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\SuggestionTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    use SuggestionTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
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
        // ];
        // $data = (collect($data));
            $data = $this->suggestions();
            // $data = suggestions();
        return view('home',compact('data'));
    }
}
