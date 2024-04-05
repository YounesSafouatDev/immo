@extends('layouts.app')
@section('title','Article')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/simpleBlog.css')}}">
@endsection
@section('content')
    <section class="simple_blog">
        <div class="simple_text">
            <h2 class="simple_title">Article</h2>
            <span class="simple_link"> <a href="{{route('accueil')}}">Accueil</a> | <a href="{{route('articles.list')}}">Articles</a> | Article | {{$article->id}}</span>
        </div>
    </section>
    <section class="section_simple">
        <div class="simple_infos">
            <div class="simple_img">
                <div class="carousel">
                    @foreach ($article->images as $image)
                        <div style="background-image:url('{{asset('storage/articles/'.$image->path)}}')"></div>
                    @endforeach
                </div>
            </div>
            <p class="simple_infos_title">{{$article->title}}</p>
            <span class="simple_writer">By admin - {{$article->created_at->format('D M Y')}}</span>
            <p class="simple_description">
                {!!$article->description!!}
            </p>
        </div>
        <div class="simple_search">
            <div class="simple_categories">
                <p>Catégories</p>
                @foreach ($categories as $category)
                    <a href="{{route('articles.list')}}">{{$category->name}}</a>
                @endforeach
            </div>
            <div class="simple_tops">
                <p class="tops_title">Top Articles</p>
                @foreach ($articles as $item)
                    <a href="{{route('article',$item->id)}}">{{$item->title}}</a>
                @endforeach
            </div>
        </div>
    </section>
    <section class="section_premium">
        <h3 class="premium_title">PREMIUM PROPERTIES</h3>
        <div class="premium_cards" id="premiumCardsContainer">
            @foreach ($annonces as $item)
                <div class="premium">
                    <img src="{{ asset('storage/annonces/' . $item->images->first()->path) }}" alt="property_image" class="premium_image">
                    <div class="premium_text">
                        <a href="{{route('bien',$item->id)}}" class="text_title">{{$item->title}}</a>
                        <p class="text_description">{!!Str::limit($item->description,75)!!}...</p>
                    </div>
                    <div class="premium_details">
                        @if (in_array($item->category_id, [1, 2, 3]))
                            <span> <i class="fa-regular fa-square"></i> {{$item->surface}} m<small><sup>2</sup></small></span>
                            <span> {{$item->bedroom}} <i class="fa-solid fa-bed"></i> </span>
                            <span> {{$item->bathroom}} <i class="fa-solid fa-bath"></i> </span>
                        @elseif(in_array($item->category_id, [3,4]))
                            <span> <i class="fa-regular fa-square"></i> {{$item->surface}}m<small><sup>2</sup></small></span>
                            <span> {{$item->bathroom}} <i class="fa-solid fa-bath"></i> </span>
                        @else 
                            <span> <i class="fa-regular fa-square"></i> {{$item->surface}}m<small><sup>2</sup></small></span>
                        @endif
                    </div>
                </div>
            @endforeach
            <!-- More Premium -->
        </div>
        <div class="btns">
            <button id="prevButton" class="btn"><i class="fa-solid fa-backward"></i> Précédente</button>
            <button id="nextButton" class="btn">Suivante <i class="fa-solid fa-forward"></i></button>
        </div>
    </section>
    <script src="{{asset('assets/js/simple-blog.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
@endsection