@extends('layouts.annonceur')
@section('title','Corbeille')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/admin/articles/articles.css')}}">
@endsection
@section('script')
    <script src="{{asset('assets/js/articles.js')}}" defer></script>
@endsection 
@section('main')
    <main>
        <h1 class="title">Liste Des Annonces En Corbeille</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('annonceur.dashboard')}}">Acceuil</a></li>
            <li class="divider">/</li>
            <li><a href="{{route('annonceur.index')}}">Annonces</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Corbeille</a></li>
        </ul>
        <section class="table__header">
            <a href="{{route('annonceur.create')}}" class="ajouter_article">Ajouter Annonce</a>
            <div class="input-group">
                <input type="search" placeholder="Chercher Article...">
                <img src="{{asset('assets/images/search.png')}}" alt="recherche icon">
            </div>
        </section>
        @if($trashed->isEmpty())
            <p class="zero">Aucune Annonce trouvé</p>
        @else
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th> Titre <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Ville <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Valide <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Premium <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Categorie <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Créer En <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Actions </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trashed as $key => $annonce )
                        <tr>
                            <td> {{$key+1}} </td>
                            <td> {{$annonce->title}}</td>
                            <td> {{$annonce->city}} </td>
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
                            <td> {{$annonce->deleted_at->format('d-m-Y')}} </td>
                            <td class="actions">
                                <form action="{{route('annonceur.restore')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$annonce->id}}" required>
                                    <button class="delete" style="color: blue" onclick="return confirm('Êtes-vous sûr de vouloir restaurer {{$annonce->title}} ?')"><i class="fa-solid fa-rotate-left"></i></button>
                                </form>
                                <form method="POST" action="{{route('annonceur.force',$annonce->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{$annonce->id}}" required/>
                                    <button id="delete" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer définitivement cet {{$annonce->title}} ?')"> <i class="fa-solid fa-trash"></i></button>
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