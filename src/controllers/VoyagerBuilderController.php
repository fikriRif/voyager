<?php

namespace TCG\Voyager\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use TCG\Voyager\Models\User as User;
use TCG\Voyager\Models\DataType as DataType;
use TCG\Voyager\Models\DataRow as DataRow;
use Log;

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
        return view('voyager::devtools.builder.browse');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('voyager::devtools.builder.edit-add', array('table' => $request->input('table')));
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
        $this->updateDataType($dataType, $requestData);

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
        return view('voyager::devtools.builder.edit-add', array('dataType' => DataType::find($id) ));
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
        $requestData = $request->all();
        $dataType = DataType::find($id);
        $this->updateDataType($dataType, $requestData);

    }

    public function updateDataType($dataType, $requestData){

        $dataType->name = $requestData['name'];
        $dataType->slug = $requestData['slug'];
        $dataType->display_name_singular = $requestData['display_name_singular'];
        $dataType->display_name_plural = $requestData['display_name_plural'];
        $dataType->icon = $requestData['icon'];
        $dataType->model_name = $requestData['model_name'];
        $dataType->description = $requestData['description'];
        $dataType->save();

        $columns = Schema::getColumnListing($dataType->name);

        foreach($columns as $column){
            $dataRow = DataRow::where('data_type_id', '=', $dataType->id)->where('field', '=', $column)->first();
            if(!isset($dataRow->id)){
                $dataRow = new DataRow;
            }
            $dataRow->data_type_id = $dataType->id;

            $dataRow->required = $requestData['field_required_' . $column];

            $bread_checks = array('browse', 'read', 'edit', 'add', 'delete');
            
            foreach($bread_checks as $check){
                if(isset($requestData['field_' . $check . '_' . $column])){
                    $dataRow->{$check} = 1;
                } else {
                    $dataRow->{$check} = 0;
                }
            }
            $dataRow->field = $requestData['field_' . $column];
            $dataRow->type = $requestData['field_input_type_' . $column];
            $dataRow->details = $requestData['field_details_' . $column];
            $dataRow->display_name = $requestData['field_display_name_' . $column];
            $dataRow->save();
        }

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

