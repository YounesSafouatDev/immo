@extends('layouts.app')
@section('title','Articles')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/blogs.css')}}" />
@endsection
@section('content')
    <section class="section_blogs">
        <div class="section_text">
            <h1 class="section_title">LISTE DES ARTICLES</h1>
            <span><a href="{{route('accueil')}}">Accueil </a> | Articles</span>
        </div>
        <div class="blogs_cards">
            <div class="blogs_cards">
                @if ($articles->isNotEmpty())
                    @foreach ($articles as $article)
                        <div class="blog_card" style="background-image: url('{{asset('storage/articles/'.$article->images->last()->path)}}')">
                            <p class="categ_blog">
                                @foreach ($categories as $category )
                                    @if ($article->category_id == $category->id)
                                            {{$category->name}}                                            
                                    @endif
                                @endforeach 
                            </p>
                            <a href="{{route('article',$article->id)}}" class="title_blog"> {{$article->title}}</a>
                            <span class="date">{{$article->created_at->format('d M Y')}}</span>
                        </div>
                    @endforeach
                    
                @else
                    <p>Aucun Article trouvé</p>
                @endif
                
            </div>
            <div class="pagination">
                <a href="{{$articles->previousPageUrl()}}" class="prev">
                    << Précédente
                </a>
                <a href="{{$articles->nextPageUrl()}}" class="next">
                    Suivante >>
                </a>
            </div>
        </div>
        
    </section>
@endsection