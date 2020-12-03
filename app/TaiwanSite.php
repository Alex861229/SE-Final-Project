<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaiwanSite extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'taiwan_site';

    // 可以取得該景點的所有message。
    public function messages(){

        return $this->hasMany('App\TaiwanMessage');
    }
}
