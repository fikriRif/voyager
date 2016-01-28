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
    // Browse our Data Type (B)READ
    public function index(Request $request)
    {   
        $slug = $request->segment(2);
        $dataType = DataType::where('slug', '=', $slug)->first();
        return view('voyager::bread.browse', array('dataType' => $dataType));
    }

    // Add a new item of our Data Type BRE(A)D
    public function create(Request $request)
    {
        $slug = $request->segment(2);
        $dataType = DataType::where('slug', '=', $slug)->first();
        return view('voyager::bread.edit-add', array('dataType' => $dataType));
    }

    // Save item from Add BRE(A)D POST
    public function store(Request $request)
    {
        //
        $slug = $request->segment(2);
        $dataType = DataType::where('slug', '=', $slug)->first();

        eval('$data = new ' . $dataType->model_name . ';');

        foreach($dataType->addRows as $row){
            
            /********** PASSWORD TYPE **********/
            if($row->type == 'password'){
                $content = \Hash::make($request->input($row->field));

            /********** CHECKBOX TYPE **********/
            } else if($row->type == 'checkbox'){
                $content = 0;
                $checkBoxRow = $request->input($row->field);
                if(isset($checkBoxRow)){
                    $content = 1;
                }

            /********** FILE TYPE **********/
            } else if($row->type == 'file'){


            /********** IMAGE TYPE **********/
            } else if($row->type == 'file'){

            /********** ALL OTHER TEXT TYPE **********/
            } else {
                $content = $request->input($row->field);
            }

            $data->{$row->field} = $content;
        }
       
        $data->save();

        return redirect('/admin')->with(array('message' => 'Successfully Created New User', 'alert-class' => 'success'));
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

