<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{

    use AuthenticatesUsers;

    protected $guardName = 'admin';
    protected $maxAttempts = 3;
    protected $decayMinutes = 2;

	public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function showLoginForm(){
    	return view('admin.login');
    }

    public function login(Request $request){
    	
    	$this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
        }

        if (Auth::guard('admin')
        	->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            $request->session()->regenerate();
            $this->clearLoginAttempts($request);

            return redirect()->intended(route('admin.dashboard'));
        }
        $this->incrementLoginAttempts($request);
        //return back()->withInput($request->only('email', 'remember'));
        return redirect()
                ->back()
                ->withInput()
                ->withErrors(["Incorrect user login details!"]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
