<?php

namespace TCG\Voyager\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use TCG\Voyager\Models\User as User;
use TCG\Voyager\Models\DataType as DataType;
use TCG\Voyager\Models\DataRow as DataRow;

use Illuminate\Support\Facades\Schema as Schema;

class VoyagerBuilderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('voyager::builder.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('voyager::builder.create-edit', array('table' => $request->input('table')));
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
        $requestData = $request->all();

        $dataType = new DataType;
        $dataType->name = $request['name'];
        $dataType->slug = $request['slug'];
        $dataType->display_name = $request['display_name'];
        $dataType->icon = $request['icon'];
        $dataType->model_name = $request['model_name'];
        $dataType->description = $request['description'];
        $dataType->save();

        $columns = Schema::getColumnListing($dataType->name);

        foreach($columns as $column){
            if($column != "id" && $column != "created_at" && $column != "updated_at"):
                $dataRow = new DataRow;
                $dataRow->data_type_id = $dataType->id;
                if($requestData['field_show_' . $column] != "on"){
                    $dataRow->show = 0;
                }
                $dataRow->field = $requestData['field_' . $column];
                $dataRow->type = $requestData['field_input_type_' . $column];
                $dataRow->details = $requestData['field_details_' . $column];
                $dataRow->save();
            endif;
        }

        echo 'success';

        
        // $user = User::create($request->all());
        // if(isset($user->exists) && $user->exists):
        //     return redirect('/admin/users')->with(array('message' => 'Successfully Created New User', 'alert-class' => 'success'));
        // endif;
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
        return view('voyager::users.create-edit', array('user' => User::find($id)));
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

