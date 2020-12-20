<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\TaiwanSite;
use App\KoreaSite;
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
       
                $messages = DB::table('taiwan_messages')->insert([
                    'user_id' => $id,
                    'site_id' => $site_id,
                    'content' => $request->content,
                    'rating' => $request->rating,
                ]);

        	} else {

                $messages = DB::table('korea_messages')->insert([
                    'user_id' => $id,
                    'site_id' => $site_id,
                    'content' => $request->content,
                    'rating' => $request->rating,
                ]);
            }
            
            // 更新留言的平均評分和評分個數
            $this->updateRating($request, $country, $site_id); 
            
            return redirect()->back();
        }
    }
    // 顯示該名User的所有留言、個人資訊
    public function index()
    {
        $id = Auth::id();
        $messages = TaiwanMessage::where('user_id', $id)
                        ->with('user')
                        ->with('site')
                        ->get();

        $messages = KoreaMessage::where('user_id', $id)
                        ->with('user')
                        ->with('site')
                        ->get();

        return view('message', compact('messages')); 
    }
    // 刪除留言
    public function destroy(Request $request, $country, $msg_id)
    {
        if ($country == 'tw') {
            $messages = TaiwanMessage::findOrFail($msg_id);
        
        } else {
            $messages = KoreaMessage::findOrFail($msg_id);

        }
        $messages->delete();
        $site_id = $messages->site_id;
        
        // 更新留言的平均評分和評分個數
        $this->updateRating($request, $country, $site_id); 
        
        return redirect()->back(); 
    }
    // 編輯留言
    public function edit($country, $msg_id)
    {
        if ($country == 'tw') {

            $messages = TaiwanMessage::where('id', $msg_id)->with('site')->first();

        } else {

            $messages = KoreaMessage::where('id', $msg_id)->with('site')->first(); 

        }
        return view('user', compact('messages','country', 'msg_id', 'site'));
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
            if ($country == 'tw') {
                $messages_table = 'taiwan_messages';
                    
            } else { 
                $messages_table = 'korea_messages';

            }
            // 更新Message
            $messages = DB::table($messages_table)
                ->where('id', $msg_id)
                ->update([
                    'content' => $request->content,
                    'rating' => $request->rating,
                ]); 
            
            // 更新留言的平均評分和評分個數
            $messages = DB::table($messages_table)->where('id', $msg_id)->first();
            $site_id = $messages->site_id;
            $this->updateRating($request, $country, $site_id); 
            
            return redirect('/user');
        }      
    }
    // 更新留言的平均評分和評分個數
    public function updateRating(Request $request, $country, $site_id) 
    {
        if ($country == 'tw') {
            $site_table = 'taiwan_site';
            $messages_table = 'taiwan_messages';

        } else {  
            $site_table = 'korea_site';
            $messages_table = 'korea_messages';

        }
        $new_avg_rating = DB::table($messages_table)
                ->where('site_id', $site_id)
                ->avg('rating');
        $new_total_comments = DB::table($messages_table)
            ->where('site_id', $site_id)
            ->count('rating');
        
        $new_site = DB::table($site_table)
            ->where('id', $site_id)
            ->update(['avg_rating' => $new_avg_rating, 'total_comments' => $new_total_comments]); 
    }
}
