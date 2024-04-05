@extends('layouts.admin')
@section('title','Corbeille')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/admin/articles/articles.css')}}">
@endsection
@section('script')
    <script src="{{asset('assets/js/articles.js')}}" defer></script>
@endsection 
@section('main')
    <main>
        <h1 class="title">Liste Des Utilisateurs En Corbeille</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('dashboard')}}">Acceuil</a></li>
            <li class="divider">/</li>
            <li><a href="{{route('utilisateurs.index')}}">Utilisateurs</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Corbeille</a></li>
        </ul>
        <section class="table__header">
            <a href="{{route('utilisateurs.create')}}" class="ajouter_article">Ajouter Utilisateur</a>
            <div class="input-group">
                <input type="search" placeholder="Chercher Utilisateur...">
                <img src="{{asset('assets/images/search.png')}}" alt="recherche icon">
            </div>
        </section>
        @if($trashed->isEmpty())
            <p class="zero">aucun Utilisateur trouvé</p>
        @else
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> Nom & Prénom <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Email <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Téléphone <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Role <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Vérifier <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Créer En <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trashed as $key => $trash )
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$trash->fname}} {{$trash->lname}}</td>
                                <td> {{$trash->email}} </td>
                                <td> {{$trash->phone}} </td>
                                <td>
                                    <p class="status categorie">{{$trash->role->role}}</p>
                                </td>
                                <td> 
                                    @if($trash->email_verified_at === null)
                                    <i class="fa-solid fa-circle-xmark x"></i>
                                    @else
                                        <i class="fa-solid fa-circle-check check"></i>
                                    @endif
                                </td>
                                <td> {{$trash->deleted_at->format('d-m-Y')}} </td>
                                <td class="actions">
                                    <form action="{{route('utilisateurs.restore')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$trash->id}}" required>
                                        <button class="delete" style="color: blue" onclick="return confirm('Êtes-vous sûr de vouloir restaurer {{$trash->fname}} ?')"><i class="fa-solid fa-rotate-left"></i></button>
                                    </form>
                                    <form method="POST" action="{{route('utilisateurs.force',$trash->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{$trash->id}}" required/>
                                        <button id="delete" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer définitivement cet {{$trash->fname}} ?')"> <i class="fa-solid fa-trash"></i></button>
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