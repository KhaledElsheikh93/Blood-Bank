<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Mail\Mailable;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;

use App\Models\Client;
use App\Models\Token;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = validator()->make($request->all(),[
            'phone'              => 'required|unique:clients',
            'email'              => 'required|unique:clients',
            'name'               => 'required',
            'password'           => 'required|confirmed',
            'date_of_birth'      => 'required',
            'blood_type_id'      => 'required',
            'last_donation_date' => 'required',
            'city_id'            => 'required'
        ]);
        if($validator->fails())
        {
            return responseJson(0, "validation error", $validator->errors());
        }
        $request->merge(['password' => Hash::make($request->password)]);
        $client = Client::create($request->all());
        $client->api_token = Str::random(60);
        $client->pin_code  = Str::random(6);
        $client->save();
        return responseJson(1, "success", [
            'api_token' => $client->api_token,
            'client'    => $client
        ]); 
    }

    

    public function login(Request $request)
    {
        $validator = validator()->make($request->all(),[
            'phone'     => 'required',
            'password'  => 'required'
        ]);
        if($validator->fails())
        {
            return responseJson(0, "Validation error", $validator->errors());
        }
        $client = Client::where('phone' , $request->phone)->first();
        if (Hash::check( $request->password , $client->password)) {
            return responseJson(1, "تم تسجيل الدخول بنجاح", [           
                'api_token' => $client->api_token,
                'client'    => $client
            ]); 
        }else{
            return responseJson(0, "البيانات خطأ الرجاء المحاولة مره اخري");
        }
    }


    public function sendPinCode(Request $request)
    {
        $validator = validator()->make($request->all(),[
            'phone'    => 'required'
        ]);
        if($validator->fails())
        {
            $data = $validator->errors();
            return responseJson(0, $validator->errors()->first(), $data);
        }
        $client = Client::where('phone',$request->phone)->first();
        if($client)
        {
            $code  = Str::random(4);
            $update= $client->update(['pin_code' => $code]);
            if($update)
            {
                // send sms
                // send email
                Mail::to($client->email)
                      ->bcc("khaledelsheikh93@gmail.com")
                      ->send(new ResetPassword($client));

                return responseJson(1 , "برجاء فحص هاتفك");
            }
            else
            {
                return responseJson(0, "حدث خطأ، حاول مرة أخري");
            }   
        }
        else
            {
                return responseJson(0, "لا يوجد حساب مرتبط بهذا الهاتف");
            }
    }


    public function resetPassword(Request $request)
    {
        $validator = validator()->make($request->all(),[
               'phone'    => 'required',
               'password' => 'required|confirmed',
               'pin_code' => 'required'
        ]);
        if($validator->fails())
        {
            $data = $validator->errors();
            return responseJson(0, $validator->errors()->first(), $data);
        }
        else
        {
            $client = Client::where('phone' , $request->phone)->first();
            if($client)
            {

                if($client->pin_code == $request->pin_code)
                {
                    $client->update(['password' , Hash::make($request->password)]);
                    return responseJson(1, "تم تسجيل الدخول بنجاح", [           
                        'api_token' => $client->api_token,
                        'client'    => $client
                    ]); 
                }
                else
                {
                    return responseJson(0, "كود الدخول غير صحيح"); 
                }
            }
            else
            {
                return responseJson(0, "رقم الهاتف غير صحيح"); 
            }
        }
        
    }


    public function registerToken(Request $request)
    {
        
        $validation = validator()->make($request->all(), [
            'token' => 'required',
        ]);
        if($validation->fails())
        {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }
        $request->user()->tokens()->create($request->all());
        return responseJson(1, "تم التسجيل بنجاح");
    }


    public function removeToken(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'token' => 'required'
        ]);
        if($validation->fails()){
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }
        Token::where('token', $request->token)->delete();
        return responseJson(1, "تم الحذف بنجاح");
    }
}
