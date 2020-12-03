<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaiwanSite;
use App\KoreaSite;
use App\User;
use App\TaiwanMessage;
use App\KoreaMessage;
use Auth;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    public function index (){

    	return view('test_search');
    }

    public function search(Request $request)
    {
    	$validator = Validator::make($request->all(),[
            'country' => ['required', 'string'],
            'search' => ['required', 'string'],
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);

        } else {

            $country = $request->country;

        	if ($country == 'tw') {

        		$search_name = TaiwanSite::
        					where('name', 'like', '%'.$request->search.'%')->get();

        		$search_address = TaiwanSite::
        					where('address', 'like', '%'.$request->search.'%')->get();

        		$sites = $search_name->merge($search_address);

        		$sites = $sites->take(10);

        		return view('test_search_result', compact('sites','country'));

        	} else {

        		return redirect()->back();
        	}
    	}
    }

    public function siteAllMsg($country ,$site_id)
    {
    	if (Auth::check()) {

			$user = Auth::user(); 

            if ($country == 'tw') {

                $messages = TaiwanMessage::where('id', $site_id)
                                ->orderBy('created_at', 'desc')
                                ->get();

                return view('msg_test', compact('user','messages','country'));
            
            } else {

                $messages = KoreaMessage::where('id', $site_id)
                                ->orderBy('created_at', 'desc')
                                ->get();

                return view('msg_test', compact('user','messages','country'));
            }
			
		
		} else {

            if ($country == 'tw') {

                $messages = TaiwanMessage::where('id', $site_id)
                                ->orderBy('created_at', 'desc')
                                ->get();

                return view('msg_test', compact('messages','country'));
            
            } else {

                $messages = KoreaMessage::where('id', $site_id)
                                ->orderBy('created_at', 'desc')
                                ->get();

                return view('msg_test', compact('messages','country'));
            }
        }
    }
}
