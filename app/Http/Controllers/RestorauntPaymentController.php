<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class RestorauntPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records =Payment::where(function ($query) use ($request) {
            if ($request->amount) {
                $query->where('amount', 'like', '%'.$request->name.'%');
            }
            if ($request->restaurant_name) {
                $query->whereHas('restaurant' , function ($q) use ($request){
                    $q->where('name', 'like', '%'.$request->restaurant_name.'%');
                });
            }
        })->paginate(10);
        return view('payments.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment =Payment::all();
        return view('payments.create' , compact('payment'));
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
            'amount'=>'required',
            'notes'=>'required',
            'restaurant_id'=>'required',
        ];
        $messages=[
            'amount.required'=>'amount is required',
            'notes.required'=>'notes is required',
            'restaurant_id.required'=>'restaurant is required',
        ];
        $this->validate($request,$rules,$messages);
        $record=Payment::create($request->all());
        flash()->success("success");
        return redirect('payments');
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
        $model=Payment::findOrFail($id);
        return view('payments.edit',compact('model' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $record=Payment::findOrFail($id);
        $record->update($request->all());
        flash()->success('Edited');
        return redirect('payments');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=City::findOrFail($id);
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
