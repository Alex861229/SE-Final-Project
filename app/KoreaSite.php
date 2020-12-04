<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\KoreaMessage;

class KoreaSite extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'korea_site';
    protected $guarded = 'id';

    // 可以取得該景點的所有message。
    public function messages(){

        return $this->hasMany('App\KoreaMessage');
    }
}
