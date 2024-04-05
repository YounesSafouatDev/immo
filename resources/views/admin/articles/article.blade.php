@extends('layouts.admin')
@section('title','Article')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/admin/articles/article.css')}}">
@endsection
@section('main')
<main>
    <h1 class="title">Article</h1>
    <ul class="breadcrumbs">
        <li><a href="{{route('dashboard')}}">Acceuil</a></li>
        <li class="divider">/</li>
        <li><a href="{{route('articles.index')}}">Articles</a></li>
        <li class="divider">/</li>
        <li><a href="#" class="active">Article</a></li>
        <li class="divider">/</li>
        <li>{{$article->id}}</li>
    </ul>
    <section class="section_blog">
        <div class="blog_infos">
            <div class="blog_img">
                <div class="images">
                    @foreach ($article->images as $image)
                        <img src="{{asset('storage/articles/'.$image->path)}}" alt="maison image">
                    @endforeach
                </div>
            </div>
            <p class="blog_infos_title">{{$article->title}}</p>
            <span class="blog_writer">Par administrateur - {{$article->created_at->format('d M Y')}}</span>
            <span class="blog_categ">{{$article->category->name}}</span>
            <div class="blog_description">{!!$article->description!!}</div>
        </div>
    </section>
    <section class="blog_btns">
        <a href="{{route('articles.edit',$article->id)}}" class="btn_warning">Modifier</a>
        <form action="{{route('articles.destroy',$article->id)}}" method="POST">
            @csrf
            @method('delete')
            <button class="btn_danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer l\'article {{$article->title}} ?')">Supprimer</button>
        </form>
    </section>
</main>
@endsection