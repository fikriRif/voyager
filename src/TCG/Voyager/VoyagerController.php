<?php

namespace TCG\Voyager;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VoyagerController extends Controller
{
	
	public function login()
	{
		return view('voyager::login');
	}

	public function postLogin(Request $request)
    {
    	$email = $request->input('email');
    	$password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            return redirect()->intended('admin');
        } else {
        	return redirect()->back()->with('error', 'Credentials do not match our records.');
        }
    }

	public function index()
	{
		return view('voyager::index');
	}

	public function logout()
	{
		Auth::logout();
		return redirect('/admin/login');
	}
}