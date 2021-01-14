<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TaiwanMessage;

class TaiwanSite extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'taiwan_site';
    protected $guarded = 'id';

    // 可以取得該景點的所有message。
    public function messages(){

        return $this->hasMany('App\TaiwanMessage');
    }

    public static function getSites() {

    	return TaiwanSite::select('name', 'description', 'address', 'parkinginfo', 'ticketinfo')->get();
    }
}
