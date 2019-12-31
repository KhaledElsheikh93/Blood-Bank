@extends('front.layouts.master')

    @inject('posts', 'App\Models\Post')

    @section('content')

        <!-- Navigator Start -->
        <section id="navigator">
            <div class="container">
                <div class="path">
                    <div class="path-main" style="color: darkred; display:inline-block;">Home</div>
                    <div class="path-main" style="color: darkred; display:inline-block;">/ Articles</div>
                   
                </div>

            </div>
        </section>
        <!-- Navigator End -->

        <!-- article Start -->
        <section id="article">
            <div class="container">
                <img class="head-img" src="{{  asset($post->image)  }}" alt="">
                <div class="details-container">
                    <div class="title">{{  $post->title  }}</div>
                    <p>{{  $post->content  }}</p>
                    <strong><a>Share this article:</a></strong>
                    <div class="icons">
                        <i class="fab fa-facebook-square fa-3x"></i>
                        <i class="fab fa-google-plus-square fa-3x"></i>
                        <i class="fab fa-twitter-square fa-3x"></i>
                    </div>

                </div>
                <!-- Articles Start -->
                <section id="articles">
                    <div class="container">
                        <h2 style="display: inline-block;">Articles</h2>
                        <div class="swiper-container">
                            <div class="button-area" style="display: inline-block; margin-left: 850px;">
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                              
                            </div>
                            <div class="swiper-wrapper">
                            @foreach($posts->get() as $post2)
                                <div class="swiper-slide">
                                    <div class="card">
                                        <div class="card-img-top" style="position: relative;">
                                            <img src="{{ asset($post2->image) }}" alt="Card image">
                                            <button class="like"><i class="fas fa-heart icon-large"></i></button>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">{{ $post2->title }}</h4>
                                            <p class="card-text">{{ $post2->content }}</p>
                                            <div class="btn-cont">
                                                <button class="card-btn"
                                                    onclick="window.location.href = '{{ url('posts', $post2->id) }}';">Details</button>
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
        @push('script')
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
                            if(currentClass.includes('first'))
                            {
                                $(heart).removeClass('first-heart').addClass('second-heart')
                            }
                            else
                            {
                                $(heart).removeClass('second-heart').addClass('first-heart');
                            }
                        }
                    });
                }
            </script>
        @endpush    
    @endsection

   