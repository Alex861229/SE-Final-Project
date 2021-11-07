<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaiwanSite;
use App\KoreaSite;
use App\User;
use App\TaiwanMessage;
use App\KoreaMessage;
use App\Exports\TaiwanSitesExport;
use App\Exports\KoreaSitesExport;
use Excel;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class SiteController extends Controller
{
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

                $search_address = TaiwanSite::
                            where('address', 'like', '%'.$request->search.'%')->get();

        		$search_name = TaiwanSite::
        					where('name', 'like', '%'.$request->search.'%')->get();

        		$sites = $search_address->merge($search_name);

        		$sites = $sites->take(10);

        	} elseif ($country == 'kr')  {

                $search_address = KoreaSite::
                            where('address', 'like', '%'.$request->search.'%')->get();

                $search_name = KoreaSite::
                            where('name', 'like', '%'.$request->search.'%')->get();

                $sites = $search_address->merge($search_name);

                $sites = $sites->take(10);
        		
        	} else {

                return redirect()->back();
            }

            if ($sites->isEmpty()) {

                $error_message = "查無相似景點";
                return view('welcome', compact('sites','country','error_message'));
            }
            else {
                
                return view('welcome', compact('sites','country'));
            }
    	}
    }

    public function siteAllMsg($country ,$site_id)
    {
    	if (Auth::check()) {

			$user = Auth::user(); 

            if ($country == 'tw') {

                $site = TaiwanSite::find($site_id);
                $messages = TaiwanMessage::where('site_id', $site_id)
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);

                return view('message', compact('user','messages','country','site'));
            
            } else {

                $site = KoreaSite::find($site_id);
                $messages = KoreaMessage::where('site_id', $site_id)
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);

                return view('message', compact('user','messages','country','site'));
            }
			
		
		} else {

            if ($country == 'tw') {

                $site = TaiwanSite::find($site_id);
                $messages = TaiwanMessage::where('site_id', $site_id)
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);

                return view('message', compact('messages','country','site'));
            
            } else {

                $site = KoreaSite::find($site_id);
                $messages = KoreaMessage::where('site_id', $site_id)
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);

                return view('message', compact('messages','country','site'));
            }
        }
    }

    public function download($country) {
        
        if ($country == 'tw') {

            return Excel::download(new TaiwanSitesExport, 'TaiwanSites.xlsx');
        } 

        else if ($country == 'kr'){


            return Excel::download(new KoreaSitesExport, 'KoreaSites.xlsx');
        }
    }
}
