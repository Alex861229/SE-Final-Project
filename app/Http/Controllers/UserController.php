<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\User;
use Log;
use Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
    	$this->middleware('guest');
        Log::info('register',$request -> input());

        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string'],
            'account' => ['required', 'string', 'unique:users,account'],
            'password' => ['required', 'string', 'min:6'],
            'email' => ['required', 'email'],
            'avatar' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);

        } else {

            $user = User::create([
                'name' => $request['name'],
                'account' => $request['account'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'isAdmin' => User::ROLE_USER, // 預設為一般使用者
            ]);
            
            if ($request->hasFile('avatar')) {
            	$avatar_file = $request->file('avatar');
                $folder_name = 'members';
                $path = public_path($folder_name);
                $name = 'avatar_'.$user->id.'.'.$avatar_file->getClientOriginalExtension();
                $avatar_file->move($path, $name);
                $user->avatar = $path;
            }
            $user->save();

            return view('test_login');
        }
    }

    public function login(Request $request)
    {
    	// $this->middleware('guest');

        $validator = Validator::make($request->all(),[
            'account' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);

        } else {

            if (\Auth::attempt([
                'account' => $request->account,
                'password' => $request->password
            ])){

                return redirect('/');
            
            } else {

                return redirect('/login');
            }
        }
    }

    public function logout(Request $request) {

		Auth::logout();

		return redirect('/');

	}

    // public function update(Request $request, $user_id)
    // {
    // 	$this->middleware('auth');
    //     $this->validate($request, [
    //         'name' => ['required', 'string'],
    //         'birthday' => ['required', 'date_format:Y-m-d'],
    //         'email' => ['required', 'email'],
    //         'city_id' => ['required'],
    //         'district_id' => ['required'],
    //         //'avatar' => ['image', 'max:1024'],
    //         'status' => ['in:0,1'],
    //     ]);
    //     $avatar_file = $request->file('avatar');
    //     $user = User
    //         ::where('id', $user_id)
    //         ->first();
    //     if (!$user) {
    //         return response()->json(null, 404);
    //     }
    //     $result = $user->update($request->only([
    //         'name',
    //         'birthday',
    //         'email',
    //         'city_id',
    //         'district_id',
    //         'status',
    //     ]));
    //     if ($avatar_file) {
    //         $folder_name = 'members';
    //         $path = public_path($folder_name);
    //         $name = 'avatar_'.$user->id.'.'.$avatar_file->getClientOriginalExtension();
    //         $avatar_file->move($path, $name);
    //         $user->avatar = '/'.$folder_name.'/'.$name;
    //         $user->save();
    //     }

    //     return response()->json($user);
    // }

    // public function deleteByAccount(Request $request, $account)
    // {   
    //     $user = User
    //         ::where('account', $account)
    //         ->first();
    //     $deleted = false;
    //     if ($user) {
    //         $deleted = $user->forceDelete();
    //     }
    //     if ($deleted) {
    //         return response()->json([
    //             'deleted' => true,
    //         ]);
    //     }
    //     return response()->json(null, 400);
    // }

    // public function ResetPassword(Request $request, $user_id)
    // {
    //     $this->validate($request, [
    //         'new_password' => ['required', 'string'],
    //         'check_new_password' => ['required', 'string'],
    //     ]);

    //     $user = User::where('id', $user_id)
    //             ->first();

    //     if ($user) {
    //         $user->password = $request->input('new_password');
    //         $user->save();
    //         return response()->json('OK',200);
    //     } else {
    //         return '此帳號尚未註冊';
    //     }
    // }

    // public function ModifyPassword(Request $request, $user_id)
    // {
    //     $this->validate($request, [
    //         'old_password' => ['required', 'string'],
    //         'new_password' => ['required', 'string'],
    //     ]);

    //     $user = User::where('id', $user_id)
    //             ->first();

    //     if ($user && password_verify($request->input('old_password'), $user->password)) {
    //         $user->password = $request->input('new_password');
    //         $user->save();
    //         return response()->json('OK',200);
    //     } else {
    //         return 'failed';
    //     }
    // }
}
