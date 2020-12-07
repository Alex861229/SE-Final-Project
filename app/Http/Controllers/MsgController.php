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
            return redirect()->back();
        }
    }
    // 顯示該名User的所有留言
    public function index()
    {
        $id = Auth::id();
        $TwMessages = TaiwanMessage::where('user_id', $id)->with('user')->with('site')->get();
        $KrMessages = KoreaMessage::where('user_id', $id)->with('user')->with('site')->get();;
        return view('msg_test', compact('TwMessages','KrMessages')); 
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
    public function edit($country, $msg_id)
    {
        if ($country == 'tw') {
            $TwMessage = TaiwanMessage::where('id', $msg_id)->first();
            $site = TaiwanSite::find($TwMessage['site_id']);
            return view('msg_edit', compact('TwMessage','country','msg_id', 'site'));
    
        } else {
            $KrMessage = KoreaMessage::where('id', $msg_id)->first();
            $site = KoreaSite::find($KrMessage['site_id']);
            return view('msg_edit', compact('KrMessage','country', 'msg_id', 'site'));    
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
            if ($country == 'tw') {
                $site_id = DB::table('taiwan_messages')->where('id', $msg_id)->value('site_id');
                $new_message = DB::table('taiwan_messages')
                    ->where('id', $msg_id)
                    ->update([
                        'content' => $request->content,
                        'rating' => $request->rating,
                    ]);
                
            } else {
                $site_id = DB::table('korea_messages')->where('id', $msg_id)->value('site_id');
                $new_message = DB::table('korea_messages')
                    ->where('id', $msg_id)
                    ->update([
                        'content' => $request->content,
                        'rating' => $request->rating,
                    ]);
                    
            }
            return redirect('/message');
            // return redirect('/message')
            //     ->action('MsgController@updateRating', [
            //         'request' => $request,
            //         'country' => $country,
            //         'site_id' => $site_id,
            //         'msg_id' => $msg_id,
            //         'method' => 'update',
            //     ]);
        }      
    }
    // 更新留言的平均評分和評分個數
    public function updateRating(Request $request, $country, $site_id, $msg_id, $method) 
    {
        if ($country == 'tw') {
            $site = TaiwanSite::find($site_id);
            $cur_rating = DB::table('taiwan_messages')->where('id', $msg_id)->value('rating');            
        } else {
            $site = KoreaSite::find($site_id);
            $cur_rating = DB::table('korea_messages')->where('id', $msg_id)->value('rating');    
        }
                
        if ($method == 'store') {
            $new_total_comments = $site['total_comments'] + 1;
            $new_avg_rating = ($site['avg_rating']*$site['total_comments'] + $request['rating']) / $new_total_comments;

        } elseif($method == 'destroy') {
            $new_total_comments = $site['total_comments'] - 1;
            $new_avg_rating = ($site['avg_rating']*$site['total_comments'] - cur_rating) / $new_total_comments;
            
        } else {
            $new_avg_rating = ($site['avg_rating']*$site['total_comments'] - cur_rating + $request['rating']) / $site['total_comments'];
        }

        if ($country == 'tw') {
            $new_Site = DB::table('taiwan_site')
                ->where('id', $site_id)
                ->update(['avg_rating' => $new_avg_rating, 'total_comments' => $new_total_comments]);       
        } else {
            $new_Site = DB::table('korea_site')
                ->where('id', $site_id)
                ->update(['avg_rating' => $new_avg_rating, 'total_comments' => $new_total_comments]);       
             
        }
    }
}
