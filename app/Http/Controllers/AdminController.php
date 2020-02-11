<?php

namespace App\Http\Controllers;

use App\admins;
use Illuminate\Http\Request;
use Auth;
use Hash;

class AdminController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function update_profile(Request $request)
    {

        $id = Auth::guard('admin')->user()->id; 
        $data = admins::find($id);
        $data->name = $request->input('name');
        $data->email = $request->input('email');


        if ($password = $request->input('password')) {
            $data->password = Hash::make($password);
        }

        $data->save();
        return redirect('admin/profile');
    }
}
