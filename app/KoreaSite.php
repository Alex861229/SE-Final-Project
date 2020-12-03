<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KoreaSite extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'korea_site';

    // 可以取得該景點的所有message。
    public function messages(){

        return $this->hasMany('App\KoreaMessage');
    }
}
