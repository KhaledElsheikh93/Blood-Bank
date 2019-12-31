@extends('front.layouts.master')


    @inject('model','App\Models\Client')


    @section('title')
        <title>Login</title>
    @endsection


    @section('content')


        <!-- Navigator Start -->
        <section id="navigator">
            <div class="container">
                <div class="path">
                    <div class="path-main" style="color: darkred; display:inline-block;">Home</div>
                    <div class="path-directio" style="color: grey; display:inline-block;"> / Login</div>
                </div>

            </div>
        </section>
        <!-- Navigator End -->

        <!-- Login Start -->
        <section id="login">
            @include('flash::message')
            <div class="container">
                <img src="{{ asset('front/imgs/logo.png') }}" alt="">
                {!! Form::model($model,[
                  'url' => url('client-login')
                  
                ]) !!}
                <input class="username" type="email" placeholder="Eamil" name="email" required>
                <input class="password" type="Password" placeholder="Password" name="password" required>
                <input class="check" type="checkbox">Remember me
                <a href="#">Forget Password ?</a><br>
                <div class="reg-group">
                    <button style="background-color: darkred;" type="submit">Login</button>
                    <button style="background-color: rgb(51, 58, 65);">Make new account</button>
                </div>
                {!! Form::close() !!}
            </div>
        </section>
        <!-- Login End -->

    @endsection
