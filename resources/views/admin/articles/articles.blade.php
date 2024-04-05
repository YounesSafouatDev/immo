@extends('layouts.admin')
@section('title','Articles')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/admin/articles/articles.css')}}">
@endsection
@section('script')
    <script src="{{asset('assets/js/articles.js')}}" defer></script>
@endsection 
@section('main')
    <main>
        <h1 class="title">Liste Des Articles</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('dashboard')}}">Acceuil</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Articles</a></li>
        </ul>
        @if(session('message'))
            <section class="section_message" id="section_message">
                {{ session('message') }}
            </section>
        @endif
        <section class="table__header">
            <a href="{{route('articles.create')}}" class="ajouter_article">Ajouter Article</a>
            <form method="POST" action="{{route('deleteAll')}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="supprimer_articles" onclick="return confirm('Êtes-vous sûr de vouloir supprimer tous les articles ?')">Supprimer Tous</button>
            </form>
            <div class="input-group">
                <input type="search" placeholder="Chercher Article...">
                <img src="{{asset('assets/images/search.png')}}" alt="recherche icon">
            </div>
        </section>
        @if($articles->isEmpty())
            <p class="zero">aucun article trouvé</p>
        @else
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> Titre <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Slug <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Categorie <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Créer En <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $key => $article )
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$article->title}}</td>
                                <td> {{$article->slug}} </td>
                                <td>
                                    <p class="status categorie">{{$article->category->name}}</p>
                                </td>
                                <td> {{$article->created_at->format('d-m-Y')}} </td>
                                <td class="actions">
                                    <a href="{{route('articles.show',$article->id)}}" class="voir"><i class="fa-regular fa-eye"></i></a>
                                    <a href="{{route('articles.edit',$article->id)}}" class="edit"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <form method="POST" action="{{route('articles.destroy',$article->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button id="delete" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer {{$article->title}} ?')"> <i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        @endif
        
    </main>
@endsection