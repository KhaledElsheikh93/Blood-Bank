@extends('front.layouts.master')

    @inject('blood_types', 'App\Models\BloodType')

    @inject('cities', 'App\Models\City')

    @inject('donations ', 'App\Models\DonationRequest')


    @section('title')
       <title>Donation Requests</title>
    @endsection

    @section('content')

         <!-- Requests Start -->
         <section id="requests">
            <div class="title">
                <h2>Donations</h2>
                <hr class="line">
            </div>
            <div class="container">
            {!! Form::open(['method' => 'get']) !!}
                <div class="row">
                    <div class="col-lg-5">
                        {!! Form::select('blood_type_id', $blood_types->pluck('name','id'),request()->input('blood_type_id'),[
                            'class' => 'form-control',
                             'placeholder' => 'Blood Type ...'
                        ]) !!}
                    </div>
                    <div class="col-lg-5">
                       {!! Form::select('city_id', $cities->pluck('name', 'id'),request()->input('city_id'), [
                            'class'      => 'form-control',
                            'placeholder'=> 'City..'
                       ]) !!}
                    </div>
                    <div class="search">
                        <button type="submit"><i class="col-lg-2 fas fa-search"></i></button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="row">
                @foreach($donations->get() as $donation)
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="type">
                                    <h2>{{  $donation->blood_type->name  }}</h2>
                                </div>
                            </div>
                            <div class="data col-lg-6">
                                <h4>Name: {{  $donation->patient_name  }} </h4>
                                <h4>Hospital: {{  $donation->hospital_name  }}</h4>
                                <h4>City: {{  $donation->hospital_address  }}</h4>
                            </div>
                            <div class="col-lg-3">
                                <button onclick= "window.location.href = '{{ url('donation-details', $donation->id) }}';">Details</button>
                            </div>

                        </div>
                        @endforeach
                    </div>
                    
                </div>
                <div class="more-req">
                    <button onclick= "window.location.href = 'donation-request';">More</button>
                </div>
            </div>
        </section>
        <!-- Requests End -->

    @endsection

    