@extends('layouts.admin')
@section('title','Utilisateurs')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/admin/articles/articles.css')}}">
@endsection
@section('script')
    <script src="{{asset('assets/js/articles.js')}}" defer></script>
@endsection 
@section('main')
    <main>
        <h1 class="title">Liste Des Utilisateurs</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('dashboard')}}">Acceuil</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Utilisateurs</a></li>
        </ul>
        @if(session('message'))
            <section class="section_message" id="section_message">
                {{ session('message') }}
            </section>
        @endif
        <section class="table__header">
            <a href="{{route('utilisateurs.create')}}" class="ajouter_article">Ajouter Utilisateur</a>
            <form method="POST" action="{{route('utilisateurs.deleteAll')}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="supprimer_articles" onclick="return confirm('Êtes-vous sûr de vouloir supprimer tous les utilisateurs ?')">Supprimer Tous</button>
            </form>
            <div class="input-group">
                <input type="search" placeholder="Chercher Utilisateur...">
                <img src="{{asset('assets/images/search.png')}}" alt="recherche icon">
            </div>
        </section>
        @if($utilisateurs->isEmpty())
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
                        @foreach ($utilisateurs as $key => $utilisateur )
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$utilisateur->fname}} {{$utilisateur->lname}}</td>
                                <td> {{$utilisateur->email}} </td>
                                <td> {{$utilisateur->phone}} </td>
                                <td>
                                    <p class="status categorie">{{$utilisateur->role->role}}</p>
                                </td>
                                <td> 
                                    @if($utilisateur->email_verified_at === null)
                                        <i class="fa-solid fa-circle-xmark x"></i>
                                    @else
                                        <i class="fa-solid fa-circle-check check"></i>
                                    @endif
                                </td>
                                <td> {{$utilisateur->created_at->format('d-m-Y')}} </td>
                                <td class="actions">
                                    <a href="{{route('utilisateurs.show',$utilisateur->id)}}" class="voir"><i class="fa-regular fa-eye"></i></a>
                                    <a href="{{route('utilisateurs.edit',$utilisateur->id)}}" class="edit"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <form method="POST" action="{{route('utilisateurs.destroy',$utilisateur->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button id="delete" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer {{$utilisateur->lname}} {{$utilisateur->fname}} ?')"> <i class="fa-solid fa-trash"></i></button>
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