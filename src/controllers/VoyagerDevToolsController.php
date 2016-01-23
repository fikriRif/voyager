<?php

namespace TCG\Voyager\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use TCG\Voyager\Models\User as User;

class VoyagerDevToolsController extends Controller
{
	public function database(){
		return view('voyager::devtools.database');
	}
}