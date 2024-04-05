@extends('layouts.app')
@section('title','Accueil')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />
@endsection
@section('content')
    <!-- Section Banner -->    
    <section class="banner">
        <h1 class="banner_title">Louez ou Achetez en toute tranquillité avec notre Expertise</h1>
        <a href="{{route('biens')}}" class="banner_link">PREMIUM IMMOBILIERS &nbsp;&nbsp;<i class="fa-solid fa-magnifying-glass" style="font-size: 18px;"></i></a>
    </section>
    <!-- Main -->
    <main class="main">
        <div class="text">
            <h2 class="bien_title">BIEN IMMOBILIER</h2>
            <p>
                Nos biens sont soigneusement sélectionnés pour répondre à 
                vos besoins et vous offrir le confort et la qualité de vie que vous méritez
            </p>
        </div>
        <section class="list_categories">
            @foreach ($categories as $category)
                <div class="category">
                    <img src="{{asset('assets/images/'.$category->name.'.png')}}" alt="image immobilier" class="category_image" loading="lazy">
                    <div class="category_text">
                        <a href="{{route('biens',$category->id)}}" class="category_link">{{$category->name}}</a>
                        <span>{{count($category->annonces)}} annonces</span>
                    </div>
                </div>
            @endforeach
            
        </section>
        <div class="properties_text">
            <h3 class="text_title">PREMIUM IMMOBILIERS</h3>
            <a href="{{route('biens')}}" class="property_link">Tous</a>
        </div>
        <section class="properties_cards">
            @if ($annonces->isNotEmpty())
                @foreach ($annonces as $annonce)
                    <div class="property">
                        <div class="cover" style="background-image:  url('{{asset('storage/annonces/'.$annonce->images->first()->path)}}');">
                            <h3>{{Str::limit($annonce->title,140)}}...</h3>
                            <span class="price">{{$annonce->price}} Dhs</span>
                           
                            <div class="card-back">
                                <a href="{{route('bien',$annonce->id)}}" class="back_link">Plus detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Aucune Annonce trouvé</p>
            @endif
            
        </section>
        <div class="annonceurs_text">
            <h3 class="text_title">ANNONCEURS</h3>
            <a href="" class="annonceur_link">Tous</a>
        </div>
        <section class="agents_cards">
            @if ($annonceurs->isNotEmpty())
                @foreach ($annonceurs as $annonceur)
                    <div class="card card0" style="background-image:url('{{asset('assets/images/agent.webp')}}')">
                        <div class="border">
                            <a href="{{route('biens')}}" class="agent_link">{{$annonceur->fname}} {{$annonceur->lname}}</a>
                            <div class="icons">
                                <a href="https://wa.me/+212.{{$annonceur->whatsapp}}"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                                <a href="{{$annonceur->instagram}}"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="{{$annonceur->facebook}}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Aucun Annonceur trouvé</p>
            @endif
           
        </section>
        <div class="articles_text">
            <h3 class="text_title">NOUVEAUX ARTICLES</h3>
            <a href="" class="article_link">Tous</a>
        </div>
        <section class="articles_cards">
            @if ($articles->isNotEmpty())
                @foreach ( $articles as $article )
                    <div class = "article">
                        @if($article->images->isNotEmpty())
                            <img src="{{ asset('storage/articles/'.$article->images->last()->path) }}" alt="{{$article->category->name}}">
                        @else 
                            <img src="{{asset('assets/images/agent.webp')}}" alt="{{$article->category->name}}">
                        @endif
                        <div class="article-content">
                            <h3 class="article_title">
                                {{$article->title}}
                            </h3>
                            <p>
                                {!!Str::limit($article->description,250)!!}
                            </p>
                            <a href="" class="article_button">
                                Voir Plus &nbsp; 
                                <i class="fa-solid fa-arrow-right icon"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Aucun Article trouvé</p>
            @endif
        </section>
        
    </main>
@endsection