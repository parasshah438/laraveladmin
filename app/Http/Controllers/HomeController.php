<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Visitors;
use DB;


class HomeController extends Controller
{
   
    public function index()
    {
        return view('home');
    }

    public function getdata(Request $request){


    	$check_ip =  $request->input('ip');
    	$browser_name =  $request->input('browser');

    	 $data = Visitors::WHERE('ip',$check_ip)->count();
    	if($data > 0){

    	$update = Visitors::where('ip',$check_ip)->update(['browser'=>$browser_name]);		


    	}
    	else
    	{

    	$data = new Visitors;
        $data->username = $request->input('username');
        $data->browser = $request->input('browser');
        $data->browser_version = $request->input('browser_version');
        $data->device = $request->input('device');
        $data->ios = $request->input('ios');
        $data->ip = $request->input('ip');
        $data->mac = $request->input('mac');
        $data->save();
        }
        return "done";
    
    }
}
