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
        <h1 class="title">Liste Des Articles En Corbeille</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('dashboard')}}">Acceuil</a></li>
            <li class="divider">/</li>
            <li><a href="{{route('articles.index')}}">Articles</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Corbeille</a></li>
        </ul>
        <section class="table__header">
            <a href="{{route('articles.create')}}" class="ajouter_article">Ajouter Article</a>
            <div class="input-group">
                <input type="search" placeholder="Chercher Article...">
                <img src="{{asset('assets/images/search.png')}}" alt="recherche icon">
            </div>
        </section>
        @if($trashed->isEmpty())
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
                        @foreach ($trashed as $key => $trash )
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$trash->title}}</td>
                                <td> {{$trash->slug}} </td>
                                <td>
                                    <p class="status categorie">{{$trash->category->name}}</p>
                                </td>
                                <td> {{$trash->deleted_at->format('d-m-Y')}} </td>
                                <td class="actions">
                                    <form action="{{route('restore')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$trash->id}}" required>
                                        <button class="delete" style="color: blue" onclick="return confirm('Êtes-vous sûr de vouloir restaurer {{$trash->title}} ?')"><i class="fa-solid fa-rotate-left"></i></button>
                                    </form>
                                    <form method="POST" action="{{route('force',$trash->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{$trash->id}}" required/>
                                        <button id="delete" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer définitivement cet {{$trash->title}} ?')"> <i class="fa-solid fa-trash"></i></button>
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