<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Message extends Model
{
    protected $table = 'messages';
    protected $guarded = [''];
    
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
