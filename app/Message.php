<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = [
        'user_id', 'title', 'content', 'rating'
    ];

    // 取得此篇message撰寫之user
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
