<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Setting::all();
        return view('admin.settings.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.create');
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
            'notification' => 'required',
            'settings_text'=> 'required',
            'about_app'    => 'required',
            'phone'        => 'required|numeric',
            'email'        => 'required|email',
            'fb_link'      => 'required',
            'tw_link'      => 'required',
            'insta_link'   => 'required'
        ];
        $messages = [
            'notification.required' => ' برجاء ادخال ملاحظات',
            'settings_text.required'=> 'برجاء ادخال البيانات',
            'about_app.required'    => 'برجاء ادخال معلومات حول التطبيق',
            'phone.required'        => 'برجاء ادخال رقم الهاتف',
            'email.required'        => 'برجاء ادخال ايمييل التطبيق',
            'fb_link.required'      => 'برجاء ادخال رابط حسابك علي الفيس بوك',
            'tw_link.required'      => 'برجاء ادخال رابط تويتر',
            'insta_link.required'   => 'برجاء ادخال رابط حسابك علي انستغرام' 

        ];
        $this->validate($request, $rules, $messages);
        $record = Setting::create($request->all());
        flash('settings have been added')->success();
        return redirect(route('settings.index'));
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
        $model = Setting::findOrfail($id);
        return view('admin.settings.edit', compact('model'));
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
        $rules = [
            'notification' => 'required',
            'settings_text'=> 'required',
            'about_app'    => 'required',
            'phone'        => 'required|numeric',
            'email'        => 'required|email',
            'fb_link'      => 'required',
            'tw_link'      => 'required',
            'insta_link'      => 'required'
        ];
        $messages = [
            'notification.required' => ' برجاء ادخال ملاحظات',
            'settings_text.required'=> 'برجاء ادخال البيانات',
            'about_app.required'    => 'برجاء ادخال معلومات حول التطبيق',
            'phone.required'        => 'برجاء ادخال رقم الهاتف',
            'email.required'        => 'برجاء ادخال ايمييل التطبيق',
            'fb_link.required'      => 'برجاء ادخال رابط حسابك علي الفيس بوك',
            'tw_link.required'      => 'برجاء ادخال رابط تويتر',
            'insta_link.required'   => 'برجاء ادخال رابط حسابك علي انستغرام' 

        ];
        $this->validate($request, $rules, $messages);
        $record = Setting::findOrfail($id);
        $record->update($request->all());
        flash('Settings Edited')->success();
        return redirect(route('settings.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Setting::findOrfail($id);
        $record->delete();
        flash('Deleted')->success();
        return back();
    }
}
