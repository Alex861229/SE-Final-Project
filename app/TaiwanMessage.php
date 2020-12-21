<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\TaiwanSite;

class TaiwanMessage extends Model
{
    protected $table = 'taiwan_messages';
    protected $fillable = [
        'user_id', 'site_id', 'content', 'rating', 'created_at', 'updated_at'
    ];

    // 取得此篇message撰寫之user
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    
    // 取得此篇message所評論的Site_id
    public function site()
    {
        return $this->belongsTo('App\TaiwanSite','site_id');
    }
}
