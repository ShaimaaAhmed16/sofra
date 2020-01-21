<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestauranrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records =Restaurant::where(function ($query) use ($request) {
            if ($request->name) {
                $query->where('name', 'like', '%'.$request->name.'%');
            }
            if ($request->region_name) {
                $query->whereHas('region' , function ($q) use ($request){
                    $q->where('name', 'like', '%'.$request->region_name.'%');
                });
            }
        })->paginate(10);
        return view('restaurant.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record=Restaurant::findOrFail($id);
        return view('restaurant.show',compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=Restaurant::findOrFail($id);
        $record->delete();
        $data = [
            'status' => 1,
            'msg' => 'تم الحذف بنجاح',
            'id' => $id
        ];
        flash()->success('Deleted');
        return Response::json($data, 200);
    }

    public function search(Request $request){

        $clients =Restaurant::where(function ($query) use ($request) {
            if ($request->input('search')) {
                $query->where('name', 'like', '%.$request->search.%');
            }

            else{
                flash()->error('pleas write name or city ');
            }
        })->paginate(10);
        return redirect(route('restaurant.index'));}

    public function active($id){
        $record=Restaurant::findOrFail($id);
        $record->is_active=1;
        $record->save();
        flash()->success('active');
        return redirect(route('restaurant.index'));
    }

    public function deactive($id){
            $record=Restaurant::findOrFail($id);
        $record->is_active=0;
        $record->save();
        flash()->success('deActive');
        return redirect(route('restaurant.index'));
    }
}
