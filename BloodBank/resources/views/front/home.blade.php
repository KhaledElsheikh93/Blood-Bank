@extends('front.layouts.master')


@inject('blood_types', 'App\Models\BloodType')


@inject('cities', 'App\Models\City')


    @section('title')
        <p>Blood Bank</p>
    @endsection


    @section('content')
        <!-- Header Start -->
        <section id="header">
            <div class="container">
                <!-- <h1>We are seeking for a better community health.</h1>
                <h4>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora repellat inventore nemo repudiandae
                    ipsum quos.</h4>
                <button class="btn more" onclick= "window.location.href = 'About-us.html';">More</button> -->
            </div>
        </section>
        <!-- Header End -->

        <!-- Sub Header Start -->
        <section id="sub-header">
            <div class="container">
                <h3>A SINGLE PINT CAN SAVE THREE LIVES, A SINGLE GESTURE CAN CREATE A MILLION SMILES.</h3>
            </div>
        </section>
        <!-- Sub Header End -->

        <!-- Articles Start -->
        <section id="articles">
            <div class="container">
                <h2 style="display: inline-block;">Articles</h2>
                <div class="swiper-container">
                <div class="button-area" style="display: inline-block; margin-left: 850px;">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </button>
                </div>
                    <div class="swiper-wrapper">
                        @foreach($posts as $post)
                            <div class="swiper-slide">
                                <div class="card">
                                    <div class="card-img-top" style="position: relative;">
                                        <img src="{{ asset($post->image) }}" alt="Card image">
                                        <button class="like"><i class="fas fa-heart icon-large"></i></button>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $post->title }}</h4>
                                        <p class="card-text">{{ $post->content }}</p>
                                        <div class="btn-cont">
                                            <button class="card-btn" onclick= "window.location.href = '{{ url('/posts',$post->id) }};'">Details</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- Articles End -->

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
                @foreach($donations as $donation)
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="type">
                                    <h2>{{ $donation->blood_type->name }}</h2>
                                </div>
                            </div>
                            <div class="data col-lg-6">
                                <h4>Name: {{ $donation->patient_name }}</h4>
                                <h4>Hospital: {{ $donation->hospital_name }}</h4>
                                <h4>City: {{ $donation->city->name }}</h4>
                            </div>
                            <div class="col-lg-3">
                                <button onclick= "window.location.href = '{{ url('donation-details', $donation->id) }}';">Details</button>
                            </div>

                        </div>
                        @endforeach
                    </div>
                    
                </div>
                <div class="more-req">
                    <button onclick= "window.location.href = '{{ url('donation-request') }}';">More</button>
                </div>
            </div>
        </section>
        <!-- Requests End -->

        <!-- Call us Start -->
        <section id="call-us">
            <div class="layer">
                <div class="container">
                    <h1>Call Us</h1>
                    <h4>You can call us for your inquiries about any information.</h4>
                    <div class="whats">
                        <img src="{{ asset('front/imgs/whats.png') }}" alt="">
                        <h3>+20 {{ $settings->phone }}</h3>
                    </div>
                </div>
            </div>
        </section>
        <!-- Call us End -->

        <!-- App Start -->
        <section id="app">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info">
                            <h1>Blood Bank Application</h1>
                            <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae earum officiis et eligendi nam
                                harum corporis saepe deserunt.</h3>
                            <h4>Available On</h4>
                            <img src="{{ asset('front/imgs/ios.png') }}" alt="">
                            <img src="{{ asset('front/imgs/google.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img class="app-screen" src="{{ asset('front/imgs/App.png') }}" alt="">
                    </div>
                </div>
            </div>
        </section>
        @push('scripts')
        <script>
            function toggleFavourite(heart){
                var post_id = heart.id;
                //console.log(post_id);
                $.ajax({
                    url:'{{url(route('toggle-favourite'))}}' ,
                    type:'get',
                    data:{_token:"{{csrf_token()}}",post_id:post_id},
                    success:function (data) {
                        console.log(data);
                        var currentClass=$(heart).attr('class');
                        if(currentClass.includes('first')){
                            $(heart).removeClass('first-heart').addClass('second-heart')
                        }else{
                            $(heart).removeClass('second-heart').addClass('first-heart');
                        }
                    }
                });
            }
        </script>
        @endpush
        <!-- App End -->
    @endsection

    