@extends('front.layouts.master')


    @inject('model','App\Models\Contact')


    @section('title')
        <title>Contacts</title>
    @endsection


    @section('content')

        <!-- Navigator Start -->
        <section id="navigator">
            <div class="container">
                <div class="path">
                    <div class="path-main" style="color: darkred; display:inline-block;">Home</div>
                    <div class="path-directio" style="color: grey; display:inline-block;"> / Contact Us</div>
                </div>

            </div>
        </section>
        <!-- Navigator End -->

        <!-- login Start -->
        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 call">
                        <div class="title">Head</div>
                        <img src="{{asset('front/imgs/logo.png')}}" alt="">
                        <hr>
                        <h4>Mobile: +{{$settings->phone}}</h4>
                            <h4>Fax: +2 455 6646</h4>
                                <h4>Email: {{$settings->email}}</h4>
                                    <hr>
                                    <h3>Find Us On</h3>
                                    <div class="icons">
                                        <i class="fab fa-facebook-square fa-3x"></i>
                                        <i class="fab fa-google-plus-square fa-3x"></i>
                                        <i class="fab fa-twitter-square fa-3x"></i>
                                        <i class="fab fa-whatsapp-square fa-3x"></i>
                                        <i class="fab fa-youtube-square fa-3x"></i>
                                    </div>
                    </div>
                    <div class="col-md-6 info">
                    @include('flash::message')
                        <div class="title">Head</div>
                        {!! Form::model($model, [
                            'url' => url('contact-us')
                        ]) !!}

                        <input type="text" name="name" id="" placeholder="Name" required="">
                            <input type="email" name="email" id="" placeholder="Email" required="">
                            <input type="text" name="phone" id="" placeholder="phone" required="">
                            <input type="text" name="subject" id="" placeholder="title" required="">
                            <textarea name="message" id="" cols="10" rows="5" placeholder="Message"></textarea>
                            <div class="reg-group">
                                <button type="submit">Send</button>
                            </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </section>
        <!-- login End -->

    @endsection
