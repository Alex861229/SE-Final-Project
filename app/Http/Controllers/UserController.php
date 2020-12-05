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
	public function welcome()
	{
		if (Auth::check()) {

			$user = Auth::user(); 

			return view('welcome', compact('user'));
		
		}

		return view('welcome');
	}
    public function user()
    {
        if (Auth::check()) {

            $user = Auth::user(); 

            return view('user', compact('user'));
        
        }

        return view('welcome');
    }


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
                $user->avatar = '/'.$folder_name.'/'.$name;
            }
            $user->save();

            return view('welcome');
        }
    }

    public function login(Request $request)
    {
    	$this->middleware('guest');

        $validator = Validator::make($request->all(),[
            'account' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);

        } else {

            if (Auth::attempt([
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

	public function showInfo($user_id) {

		// 判斷User是否存在
		$user = User::find($user_id);

		if ($user) {
			// 判斷是否為Admin

			if (User::isAdmin()) {
				$users = User::getAllMemberInfo();
			
			} else {
				$users = User::getOneMemberInfo($user_id);
			} 

			return view('admin', compact('users'));
		
		} else {

			return redirect()->back();
		}
	}

    public function show($class)
    {
        return redirect()->back();
    }

    public function updateInfo(Request $request, $user_id)
    {        
    	$this->middleware('auth');
        Log::info('updateInfo',$request -> input());

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);

        } else {

	        $input = array_filter(request()->except(['_token','_method']));

            $user = User::find($user_id);

            $user->update($input);
            
            if ($request->hasFile('avatar')) {

            	\File::delete(public_path($user->avatar));

            	$avatar_file = $request->file('avatar');
                $folder_name = 'members';
                $path = public_path($folder_name);
                $name = 'avatar_'.$user_id.'_'.$avatar_file->getClientOriginalName();
                $avatar_file->move($path, $name);
                $user->avatar = '/'.$folder_name.'/'.$name;
                $user->save();
            }
            
        }

        return redirect()->back();
    }

    public function deleteAccount($user_id)
    {   
        $user = User::findOrFail($user_id);

    	$user->delete();

        return redirect()->back();
    }

    public function resetPassword(Request $request, $user_id)
    {
        $validator = Validator::make($request->all(),[
            'new_password' => ['required', 'string', 'min:6'],
            'check_new_password' => ['required', 'same:new_password', 'string', 'min:6'],
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);

        } else {

            $user = User::find($user_id);
            
            $user->update([
                'password'=> $request->new_password
            ]);

            $user->save();

            return redirect('test');
        }
    }

    public function updatePassword(Request $request, $user_id)
    {
        $this->validate($request, [
            'old_password' => ['required', 'string'],
            'new_password' => ['required', 'string'],
            'check_new_password' => ['required', 'same:new_password', 'string', 'min:6'],
        ]);

        $user = User::where('id', $user_id)
                ->first();

        if ($user && password_verify($request->input('old_password'), $user->password)) {
            $user->password = Hash::make($request->input('new_password'));
            $user->save();
            return redirect()->back();
        } else {
            return 'failed';
        }
    }
}
