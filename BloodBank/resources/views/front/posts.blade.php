@extends('front.layouts.master')

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
                <img class="head-img" src="{{ asset('front/imgs/p4.jpg') }}" alt="">
                <div class="details-container">
                    <div class="title">Donations Benefits</div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere qui eius asperiores, animi adipisci
                        quia eum beatae incidunt, laborum velit quibusdam debitis totam, et reiciendis ad? Commodi
                        cupiditate velit vero?
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum aspernatur est magnam, nesciunt
                        culpa provident sit nobis molestias possimus? A optio dolores dolorum, odio nam est ducimus quis
                        quisquam vero.
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae modi veritatis iste provident
                        quis consectetur animi soluta, rerum dicta dolorem suscipit facere quas, porro, pariatur tempora
                        consequuntur ad accusamus. Voluptatem?
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere qui eius asperiores, animi adipisci
                        quia eum beatae incidunt, laborum velit quibusdam debitis totam, et reiciendis ad? Commodi
                        cupiditate velit vero?
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum aspernatur est magnam, nesciunt
                        culpa provident sit nobis molestias possimus? A optio dolores dolorum, odio nam est ducimus quis
                        quisquam vero.
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae modi veritatis iste provident
                        quis consectetur animi soluta, rerum dicta dolorem suscipit facere quas, porro, pariatur tempora
                        consequuntur ad accusamus. Voluptatem?
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere qui eius asperiores, animi adipisci
                        quia eum beatae incidunt, laborum velit quibusdam debitis totam, et reiciendis ad? Commodi
                        cupiditate velit vero?
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum aspernatur est magnam, nesciunt
                        culpa provident sit nobis molestias possimus? A optio dolores dolorum, odio nam est ducimus quis
                        quisquam vero.
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae modi veritatis iste provident
                        quis consectetur animi soluta, rerum dicta dolorem suscipit facere quas, porro, pariatur tempora
                        consequuntur ad accusamus. Voluptatem?
                    </p>
                    <strong><a>Share this article:</a></strong>
                    <div class="icons">
                        <i class="fab fa-facebook-square fa-3x"></i>
                        <i class="fab fa-google-plus-square fa-3x"></i>
                        <i class="fab fa-twitter-square fa-3x"></i>
                    </div>

                </div>

                @inject('posts',App\Models\Post)
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
                            @foreach($posts->get() as $post)
                                <div class="swiper-slide">
                                    <div class="card">
                                        <div class="card-img-top" style="position: relative;">
                                            <img src="{{ asset($post->image) }}" alt="Card image">
                                            <button id="{{ $post->id }}" onclick="toggleFavourite(this)" class="like">
                                                <i class="fas fa-heart icon-large"></i>
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">{{ $post->title }}</h4>
                                            <p class="card-text">{{ $post->content }}</p>
                                            <div class="btn-cont">
                                                <button class="card-btn"
                                                    onclick="window.location.href = '{{ url('/posts'.$post->id) }}';">Details</button>
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
        <!-- Article End -->
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

   