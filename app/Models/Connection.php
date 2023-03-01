<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Connection extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'user_connections';
    protected $fillable = ['user_id','connection_id'];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
