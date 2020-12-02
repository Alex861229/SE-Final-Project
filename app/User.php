<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Message;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'id';
    const ROLE_ADMIN = '1';
    const ROLE_USER = '0';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account','name', 'email', 'password','isAdmin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function isAdmin(){

        if(Auth::user()){

            $rs = User::where('id', Auth::user()->id)->value('isAdmin');
            return $rs == '1' ? true : false;
        }
    }

    public static function getAllMemberInfo () {

        return User::select('id','name','account','email')->get();
    }

    public static function getOneMemberInfo ($user_id) {

        return User::find($user_id);
    }
    
    // 可以取得該User的所有message。
    public function messages(){

        return $this->hasMany('App\Message');
    }
}
