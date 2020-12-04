<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\KoreaMessage;
use App\TaiwanMessage;
use App\User;

class MsgController extends Controller
{
    // 登入後才能看到留言
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    // 顯示所有留言
    // public function index()
    // {
    //     $messages = Message::with('user')->get();
    //     return view('msg_test')->with('messages',$messages);
    // }
    // 新增留言
    public function store(Request $request, $country, $site_id) 
    {
        $validator = Validator::make($request->all(),[
            'content' => 'nullable|string|max:191',
            'rating' => 'required|integer',
        ]);
        
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);

        } else {

        	if ($country == 'tw') {
            
                // laravel為relationship提供create方法,會接收一個陣列並自動設置foreign key, 使用$request->user()得到目前的使用者,會被create自動填入user_id
                $request->user()->messages()->create([
                    'site_id' => $site_id->site_id,
                    'title' => $request->title,
                    'content' => $request->content,
                    'rating' => $request->rating,
                ]);
        
                return redirect('/search/{country}/{site_id}/message');

        	} else {

                // laravel為relationship提供create方法,會接收一個陣列並自動設置foreign key, 使用$request->user()得到目前的使用者,會被create自動填入user_id
                // $request->user()->messages()->create([
                //     'site_id' => $site_id->site_id,
                //     'title' => $request->title,
                //     'content' => $request->content,
                //     'rating' => $request->rating,
                // ]);
        
                // return redirect('/search/{country}/{site_id}/message');
        	}
        }
    }
    // // 刪除留言
    // public function destroy(Request $request, Message $msg_id)
    // {
    //     //authorize method的第一個參數是呼叫的policymethod名,第二個參數是model
    //     $this->authorize('destroy', $msg_id);
    //     $msg_id->delete();
    //     return redirect('/message'); 
    // }
    // // 編輯留言
    // public function edit(Request $request, Message $msg_id)
    // {
    //     //authorize method的第一個參數是呼叫的policymethod名,第二個參數是model
    //     $this->authorize('edit', $msg_id);
    //     return view('msg_edit',[
    //         'message' => $msg_id,
    //     ]);
    // }
    // public function update(Request $request, Message $msg_id) 
    // {
    //     $msg_id->update([
    //         'title' => $request->title,
    //         'content' => $request->content,
    //         'rating' => $request->rating,
    //     ]);
    //     return redirect('/message');
    // }
}
