<?php

namespace TCG\Voyager\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use TCG\Voyager\Models\User as User;
use TCG\Voyager\Models\DataType as DataType;

class VoyagerBreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $segment_count = 0;
        foreach($request->segments() as $segments){
            $segment_count += 1;
        }

        $slug = $request->segment($segment_count);
        $dataType = DataType::where('slug', '=', $slug)->first();

        return view('voyager::bread.browse', array('dataType' => $dataType));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('voyager::bread.edit-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = User::create($request->all());
        if(isset($user->exists) && $user->exists):
            return redirect('/admin/users')->with(array('message' => 'Successfully Created New User', 'alert-class' => 'success'));
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('voyager::users.show', array('user' => User::find($id)));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('voyager::users.edit-add', array('user' => User::find($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(User::destroy($id)){
            return redirect('/admin/users')->with(array('message' => 'Successfully Deleted User', 'alert-class' => 'success', 'alert-icon' => 'trash-o'));
        }

        return redirect('/admin/users')->with(array('message' => 'Sorry it appears there was a problem deleting this user', 'alert-class' => 'danger', 'alert-icon' => 'exclamation-triangle'));

    }
}

