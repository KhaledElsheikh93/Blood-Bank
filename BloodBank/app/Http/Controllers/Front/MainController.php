<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Contact;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Models\DonationRequest;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function home(Request $request)
    {
        $posts     = Post::where('publish_date', '<' , Carbon::now()->toDateString())->take(9)->get();
        $donations = DonationRequest::where(function($query) use($request){
            if($request->city_id)
            {
                $query->where('city_id', $request->city_id);
            }
            if($request->blood_type_id)
            {
                $query->where('blood_type_id', $request->blood_type_id);
            }
        })->take(6)->get();
        return view('front.home', compact('posts', 'donations'));
    }


    public function toggleFavourite(Request $request)
    {
        $toggle = auth('site_client')->user()->posts()->toggle($request->post_id);
        return responseJson(1, "success", $toggle);

    }


    public function getCities($id)
    {
        $governorates = Governorate::findOrfail($id);
        $cities = $governorates->cities;
        return responseJson(1, "success", $cities);
    } 


    public function post($id)
    {
        $post = Post::findOrfail($id);
        return view('front.post', compact('post'));
    }


    public function posts()
    {
        $posts = Post::all();
        return view('front.posts', compact('posts'));
    }


    public function donationDetails($id)
    {
        $donation = DonationRequest::findOrFail($id);
        return view('front.donation-details',compact('donation'));
    }


    public function donationRequest(Request $request)
    {
        $donations = DonationRequest::where(function($query) use($request){
            if($request->city_id)
            {
                $query->where('city_id', $request->city_id);
            }
            if($request->blood_type_id)
            {
                $query->where('blood_type_id', $request->blood_type_id);
            }
        })->take(6)->get();
        return view('front.donation-request', compact('donations'));
     	
    }

    public function aboutUs()
    {
        return view('front.about-us');
    }


    public function contactUs()
    {
        return view('front.contact-us');
    }


    public function contactUsCreate(Request $request)
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
        flash('تم ارسال رسالتك')->success();
        return back();
    }
}

   


   

