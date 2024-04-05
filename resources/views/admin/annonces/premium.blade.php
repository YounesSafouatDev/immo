@extends('layouts.admin')
@section('title','Premium Annonce')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/admin/articles/articles.css')}}">
@endsection
@section('script')
    <script src="{{asset('assets/js/articles.js')}}" defer></script>
@endsection 
@section('main')
    <main>
        <h1 class="title">Liste Des Annonces</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('dashboard')}}">Acceuil</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Premium Annonces</a></li>
        </ul>
        <section class="table__header">
            <a href="{{route('annonces.create')}}" class="ajouter_article">Ajouter Annonce</a>
            <form method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="supprimer_articles" onclick="return confirm('Êtes-vous sûr de vouloir supprimer tous les annonces ?')">Supprimer Tous</button>
            </form>
            <div class="input-group">
                <input type="search" placeholder="Chercher Annonce...">
                <img src="{{asset('assets/images/search.png')}}" alt="recherche icon">
            </div>
        </section>
        @if($annonces->isEmpty())
            <p class="zero">Aucune Annonce trouvé</p>
        @else
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> Titre <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Annonceur <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Valide <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Premium <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Categorie <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Créer En <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($annonces as $key => $annonce )
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$annonce->title}}</td>
                                <td> {{$annonce->user->lname}} {{$annonce->user->fname}} </td>
                                <td>
                                    @if ($annonce->is_valid)
                                        <i class="fa-solid fa-check valide"></i>
                                    @else
                                        <i class="fa-solid fa-minus non"></i>
                                    @endif
                                </td>
                                <td>
                                    @if ($annonce->is_premium)
                                        <i class="fa-solid fa-check valide"></i>
                                    @else
                                        <i class="fa-solid fa-minus non"></i>
                                    @endif
                                </td>
                                <td>
                                    <p class="status categorie">{{$annonce->category->name}}</p>
                                </td>
                                <td> {{$annonce->created_at->format('d-m-Y')}} </td>
                                <td class="actions">
                                    <a href="{{route('annonces.show',$annonce->id)}}" class="voir"><i class="fa-regular fa-eye"></i></a>
                                    <a href="{{route('annonces.edit',$annonce->id)}}" class="edit"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <form method="POST" action="{{route('annonces.destroy',$annonce->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button id="delete" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer {{$annonce->title}} ?')"> <i class="fa-solid fa-trash"></i></button>
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