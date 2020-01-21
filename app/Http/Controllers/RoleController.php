<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records=Role::paginate(20);
        return view('role.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'name'=>'required|unique:roles',
            'display_name'=>'required',
            'permission_list'=>'required|array',
        ];
        $messages=[
            'name.required'=>'name is required',
            'display_name.required'=>'display Name is required',
            'permission_list.required'=>'permission is required',
        ];
        $this->validate($request,$rules,$messages);
        $record=Role::create($request->all());
        @$record->permissions()->attach($request->permission_list);
        flash()->success("success");
        return redirect(route('role.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model=Role::findOrFail($id);
        //dd($model);
//        return $model->permissions()->get();
        return view('role.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $rules=[
            'name'=>'required|unique:roles,name,'.$id,
            'display_name'=>'required',
            'permission_list'=>'required|array',
        ];
        $messages=[
            'name.required'=>'name is required',
            'display_name.required'=>'display Name is required',
            'permission_list.required'=>'permission is required',
        ];
        $this->validate($request,$rules,$messages);
        $record=Role::findOrFail($id);
        $record->update($request->all());
        $record->permissions()->sync($request->permission_list);
        flash()->success('Edited');
        return redirect(route('role.index'));

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=Role::findOrFail($id);
        $record->delete();
        $data = [
            'status' => 1,
            'msg' => 'تم الحذف بنجاح',
            'id' => $id
        ];
        flash()->success('Deleted');
        return Response::json($data, 200);
    }
}
