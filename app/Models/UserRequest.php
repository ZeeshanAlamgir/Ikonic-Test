<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRequest extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'user_requests';
    protected $fillable = ['sender_id', 'receiver_id'];

    public function userSendRequests()
    {
        return $this->belongsToMany(User::class,'user_requests','receiver_id','id')->withPivot('name','email');
    }

    public function userReceiverRequests()
    {
        return $this->belongsToMany(User::class,'user_requests','sender_id','id')->withPivot('name','email');
    }

}
