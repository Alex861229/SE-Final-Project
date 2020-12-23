<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaiwanSite;
use App\KoreaSite;
use App\User;
use App\TaiwanMessage;
use App\KoreaMessage;
use App\Restaurent;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class SiteController extends Controller
{
    public function index (){

        return view('test_search');
    }
    public function test (){

            return $sites;
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

                $search_address = TaiwanSite::
                            where('address', 'like', '%'.$request->search.'%')->get();

        		$search_name = TaiwanSite::
        					where('name', 'like', '%'.$request->search.'%')->get();

        		$sites = $search_address->merge($search_name);

        		$sites = $sites->take(10);

        		return view('welcome', compact('sites','country'));

        	} elseif ($country == 'kr')  {

                $search_address = KoreaSite::
                            where('address', 'like', '%'.$request->search.'%')->get();

                $search_name = KoreaSite::
                            where('name', 'like', '%'.$request->search.'%')->get();

                $sites = $search_address->merge($search_name);

                $sites = $sites->take(10);

                return view('welcome', compact('sites','country'));
        		
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

            $TaiwanSite = TaiwanSite::get(); 
            
            $filename = "TaiwanSites.csv";
            $handle = fopen($filename, 'w+');
            fputcsv($handle, array('name', 'description', 'address', 'parking info', 'ticket info'));

            foreach($TaiwanSite as $row) {
                fputcsv($handle, array($row['name'], $row['description'], $row['address'], $row['parkinginfo'], $row['ticketinfo']));
            }    

        } else if ($country == 'kr') {

            $KoreaSite = KoreaSite::get(); 
            
            $filename = "TaiwanSites.csv";
            $handle = fopen($filename, 'w+');
            fputcsv($handle, array('name', 'description', 'address', 'parking info', 'public facility', 'accomodation', 'sports facility', 'entertainment facility', 'support facility'));

            foreach($KoreaSite as $row) {
                fputcsv($handle, array($row['name'], $row['description'], $row['address'], $row['parkinginfo'], $row['public_facility'], $row['accomodation'], $row['sports_facility'], $row['entertainment_facility'], $row['support_facility']));
            } 
        }
        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'sites.csv', $headers);
    }
}
