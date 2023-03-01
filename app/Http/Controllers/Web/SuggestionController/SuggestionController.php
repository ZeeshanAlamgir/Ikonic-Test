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
            $data = $this->suggestions();
            return successResponse($data);
        }
    }

    public function store($senderId, $receiverId)
    {
        $userRequest = (new UserRequest());
        $userRequest->sender_id = (int)$senderId; 
        $userRequest->receiver_id = $receiverId; 
        $userRequest->save();
    }
}
