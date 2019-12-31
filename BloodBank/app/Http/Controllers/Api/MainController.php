<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Governorate;
use App\Models\City;
use App\Models\Client;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Profile;
use App\Models\BloodType;
use App\Models\Notification;
use App\Models\Token;
use App\Models\Post;
use App\Models\DonationRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;








class MainController extends Controller
{


    public function governorates()
    {
        $governorates = Governorate::all();
        return responseJson(1, "success", $governorates);
    }


    public function cities(Request $request)
    {
        $cities = City::where(function($query) use($request){
            if($request->has('governorate_id'))
            {
                $query->where('governorate_id', $request->governorate_id);
            }
        })->get();
        return responseJson(1, "success", $cities);
    }


    public function categories()
    {
        $categories = Category::all();
        return responseJson(1, "success", $categories);
    }


    public function profile(Request $request)
    {
        $client = $request->user();
        
        return responseJson(1, "success", $client);
        
    }


    public function editProfile(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name'               => 'required',
            'email'              => 'required|email',
            'date_of_birth'      => 'required',
            'blood_type_id'      => 'required',
            'last_donation_date' => 'required',
            'city_id'            => 'required',
            'phone'              => 'required',
            'password'           => 'required',
        ]);
        if($validation->fails())
        {
            return responseJson(0, "validation error", $validator->errors());
        }
       
        $request->merge(['password', Hash::make($request->password)]);
        $client = Client::where('api_token', $request->api_token)->first()
        ->update($request->all());
        return responseJson(1, "updated succefully", $client); 
    }


    public function bloodTypes()
    {
        $blood_types = BloodType::all();
        return responseJson(1, "success", $blood_types);
    }


    public function posts(Request $request)
    {
        $posts = Post::where(function($query) use($request){
            if($request->has('category_id'))
            {
                $query->where('category_id', $request->category_id);
            }
        })->get();
        return responseJson(1 ,"success", $posts);

    }


    public function postsId(Request $request)
    {
        $postsId = Post::find(2);
        return responseJson(1, "success", $postsId);
    }


    
    public function donationRequestCreate(Request $request)
    {
        
        // validation
        $rules = [
            'patient_name'    => 'required',
            'patient_phone'   => 'required|digits:11',
            'city_id'         => 'required|exists:cities,id',
            'hospital_name'   => 'required',
            'blood_type_id'   => 'required|exists:blood_types,id',
            'patient_age'     => 'required',
            'bags_num'        => 'required',
            'hospital_address'=> 'required'
        ];
        $validator = validator()->make($request->all(), $rules);
        if($validator->fails())
        {
            $data = $validator->errors();
            return responseJson(0, $validator->errors()->first(), $data);
        }
          // create donation request
          
          $client  = Client::find($request->user()->id);

          if($client)
          {
            $donationRequest = $client->donation_requests()->create($request->all());
          }

        // find clients suitable for this donation request
        $clientsIds = $donationRequest->city->governorate
        ->clients()->
        whereHas('bloodTypes', function($query) use($request){
            $query->where('blood_type_id',$request->blood_type_id);
        })->pluck('clients.id')->toArray();
        
        if(count($clientsIds))
        {
             // create a notification on database
            $notification = $donationRequest->notifications()->create([
                'title'   => 'يوجد حالة تبرع بالدم قريبة منك',
                'content' => $donationRequest->blood_type->name. 'محتاج متبرع لفصيلة'
            ]);
            // attach clients to this notification
            $notification->clients()->sync($clientsIds);

            $tokens = Token::whereIn('client_id',$clientsIds)->where('token', '!=', null)->pluck('token')->toArray();
            if(count($tokens))
            {
                $title = $notification->title;
                $body  = $notification->content;
                $data  = ['donation_request_id' => $donationRequest->id];

               notifyByFirebase($title,$body,$tokens,$data);
               
                return responseJson(1, "تم ارسال الاشعارات بنجاح", $donationRequest);
            }
        }

    }


    public function donationRequest(Request $request)
    {
        $donationRequest = DonationRequest::where(function($query) use($request) {
            if($request->has('city_id'))
            {
                if($request->has('blood_type_id'))
                {
                    $query->where('blood_type_id',$request->blood_type_id);
                }
            }
        })->get();
        return responseJson(1, "success", $donationRequest);
    }


    public function notificationSettings(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'blood_type_id'   => 'required',
            'governorate_id'  => 'required'
        ]);
        if($validation->fails())
        {
            $data = $validation->errors();
            return responseJson(0, "برجاء ادخال بيانات صحيحة");
        }
         $request->user()->bloodTypes()->sync($request->blood_type_id);
         $request->user()->governorates()->sync($request->governorate_id); 
        return  responseJson(1, "success" ,$request->user()->load('bloodTypes' , 'governorates'));
    }


    public function notifications()
    {
        $notifications = Notification::all();
        return responseJson(1, "success", $notifications);
    }


    public function updateNotificationSettings(Request $request)
    {

    }


    public function settings()
    {
        $settings = Setting::all();
        return responseJson(1, "success", $settings);
    }


    public function contacts(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email',
            'phone'     => 'required',
            'subject'   => 'required',
            'message'   => 'required'
        ]);
        if($validator->fails())
        {
            $data = $validator->errors();
            return responseJson(0, "validation fails" , $validator->errors());
        }
        $contacts = Contact::create($request->all());
        $contacts->save();
        return responseJson(1, "success", $contacts);
       
    }


    public function toggleFavourite(Request $request)
    {
        $post = Post::find($request->post_id);
        $request->user()->posts()->toggle($post);
         return responseJson(1, "تم تسجيل الاعجاب");
    }
  

}
