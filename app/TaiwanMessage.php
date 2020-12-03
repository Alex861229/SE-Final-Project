<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class TaiwanMessage extends Model
{
    protected $table = 'taiwan_messages';
    protected $fillable = [
        'user_id', 'site_id', 'title', 'content', 'rating'
    ];

    // 取得此篇message撰寫之user
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
