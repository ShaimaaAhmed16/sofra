<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records=User::paginate(20);
        return view('user.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|confirmed',
            'roles_list'=>'required',
        ];
        $messages=[
            'name.required'=>'name is required',
            'email.required'=>'email is required',
            'password.required'=>'password is required',
            'roles_list.required'=>'role is required',
        ];
        $this->validate($request,$rules,$messages);
        $request->merge(['password'=>bcrypt($request->password)]);
        $record=User::create($request->except('roles_list'));
        @$record->roles()->attach($request->roles_list);
        flash()->success("success");
        return redirect(route('user.index'));
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
        $model=User::findOrFail($id);
        return view('user.edit',compact('model'));
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
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$id,
            'password'=>'required|confirmed',
            'roles_list'=>'required',
        ];
        $messages=[
            'name.required'=>'name is required',
            'email.required'=>'email is required',
            'password.required'=>'password is required',
            'roles_list.required'=>'role is required',
        ];
        $this->validate($request,$rules,$messages);
        $record=User::findOrFail($id);
        $record->roles()->sync((array)$request->roles_list);
        $request->merge(['password'=>bcrypt($request->password)]);
        $record->update($request->all());
        flash()->success('Edited');
        return redirect(route('user.index'));

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=User::findOrFail($id);
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
