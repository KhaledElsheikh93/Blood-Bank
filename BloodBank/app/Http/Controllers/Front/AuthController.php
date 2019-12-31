<?php

namespace App\Http\Controllers\Front;

use App\Models\Client;
use App\Models\Governorate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function viewRegister()
    {
        $governorates = Governorate::all();
        return view('front.signup', compact('governorates'));
    }


    public function register(Request $request)
    {
        $rules = [
            'name'              => 'required',
            'email'             => 'required|email',
            'phone'             => 'required|numeric',
            'password'          => 'required|confirmed',
            'blood_type_id'     => 'required',
            'date_of_birth'     => 'required',
            'last_donation_date'=> 'required',
            'city_id'           => 'required'
        ]; 
        $messages = [
            'name.required'                => 'الرجاء ادخال الاسم',
            'email.required'               => 'برجاء ادخال ايميل صحيح',
            'phone.required'               => 'برجاء ادخال رقم هاتف صحيح',
            'password.required'            => 'برجاء ادخال كلمة السر',
            'password.confirmed'           => 'كلمة السر غير متطابقة',
            'last_donation_date.required'  => 'برجاء ادخال اخر تاريخ تبرع',
            'city_id.required'             => 'برجاء ادخال المدينة الحالية'
        ];
        $this->validate($request, $rules, $messages);
        $request->merge(['password'=>bcrypt($request->password)]);
        $client = Client::create($request->all()); 
        $client->api_token = Str::random(60);
        $client->pin_code  = Str::random(6);
        $client->save();
        flash()->success('تم تسجيل المستخدم بنجاح');
        return redirect(route('client-login'));
    }


    public function viewLogin()
    { 
        return view('front.login');
    }


    public function doLogin(Request $request)
    {   
       $rules = [
           'email'    => 'required|email',
           'password' => 'required'
       ];
       $messages = [
           'email.required'    => 'please insert your email',
           'password.required' => 'please insert your password'
       ];
       $this->validate($request, $rules, $messages);
       $client = Client::where('email', $request->email)->first();
       if(Auth::guard('site_client')->attempt( $request->only('email', 'password')))
       {
           $client = Auth::guard('site_client');
           flash('تم تسجيل الدخول بنجاح')->success();
           return redirect('/');
           
       }
       else
       {
           flash()->error('خطأ في تسجيل الدخول');
           return redirect(route('client-register'));
           
       }
    }


}
