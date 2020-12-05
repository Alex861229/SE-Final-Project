<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\KoreaMessage;
use App\TaiwanMessage;
use App\User;
use Auth;

class MsgController extends Controller
{
    // 登入後才能看到留言
    public function __construct()
    {
        $this->middleware('auth');
    }
    // 顯示所有留言
    public function index()
    {
        $id = Auth::id();
        $TwMessages = TaiwanMessage::where('user_id', $id)->with('user')->with('site')->get();
        $KrMessages = KoreaMessage::where('user_id', $id)->with('user')->with('site')->get();;
        return view('msg_test', compact('TwMessages','KrMessages')); //,'sites','country'
    }
    // 新增留言
    public function store(Request $request, $country, $site_id) 
    {
        $validator = Validator::make($request->all(),[
            'content' => 'nullable|string|max:191',
            'rating' => 'required|integer',
        ]);

        $id = Auth::id();
        
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);

        } else {

        	if ($country == 'tw') {
       
                $TwMessages = DB::table('taiwan_messages')->insert([
                    'user_id' => $id,
                    'site_id' => $site_id,
                    'content' => $request->content,
                    'rating' => $request->rating,
                ]);

        	} else {

                $KrMessages = DB::table('korea_messages')->insert([
                    'user_id' => $id,
                    'site_id' => $site_id,
                    'content' => $request->content,
                    'rating' => $request->rating,
                ]);
            }
            return view('test_search_result_message', compact('country','site_id'));
        }
    }
    // 刪除留言
    public function destroy(Request $request, $country, $msg_id)
    {
        if ($country == 'tw') {
            $TwMessages = TaiwanMessage::findOrFail($msg_id);
            $TwMessages->delete();
        
        } else {
            $KrMessages = KoreaMessage::findOrFail($msg_id);
            $KrMessages->delete();

        }
        return redirect()->back(); 
    }
    // 編輯留言
    public function edit(Request $request, $country, $msg_id)
    {
        //authorize method的第一個參數是呼叫的policymethod名,第二個參數是model
        //$this->authorize('edit', $msg_id);
        if ($country == 'tw') {
            $TwMessages = TaiwanMessage::findOrFail($msg_id);
            return view('msg_edit',[
                'TwMessages' => $TwMessages,
            ]);        
        } else {
            $KrMessages = KoreaMessage::findOrFail($msg_id);
            return view('msg_edit',[
                'KrMessages' => $KrMessages,
            ]);      
        }
    }
    public function update(Request $request, $country, $msg_id) 
    {
        $validator = Validator::make($request->all(), [
            'content' => 'nullable|string',
            'rating' => 'nullable|integer',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);

        } else {

	        $input = array_filter(request()->except(['_token','_method']));

            if ($country == 'tw') {
                
                $updateTwMessages = TaiwanMessage::find($msg_id);
                $updateTwMessages->update($input);
                 
            } else {
                
                $updateKrMessages = KoreaMessage::find($msg_id);
                $updateKrMessages->update($input);

            }
            return view('messages.edit',[
                'message' => $message,
            ]);
        }

    }
}
