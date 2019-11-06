<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BloodType;

class BloodTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = BloodType::paginate(10);
        return view('blood_types.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blood_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required'
        ];

        $message = [
            'name.required' => "Please insert blood type"
        ];
            
        $this->validate($request, $rules, $message);

        $record = BloodType::create($request->all());
        flash("Blood type added succefully")->success();
        return redirect(route('blood_types.index'));
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
        $model = BloodType::findOrfail($id);
        return view('blood_types.edit', compact('model'));
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
        $record = BloodType::findOrfail($id);
        $record->update($request->all());
        flash("blood type has succefully updated");
        return redirect(route('blood_types.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = BloodType::findOrfail($id);
        $record->delete();
        flash("Deleted")->success();

        return back();
    }
}
