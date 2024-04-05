@extends('layouts.admin')
@section('title','Utilisateur')
  
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/admin/utilisateurs/utilisateur.css')}}">
@endsection

@section('main')
    <main>
        <h1 class="title">Article</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('dashboard')}}">Acceuil</a></li>
            <li class="divider">/</li>
            <li><a href="{{route('utilisateurs.index')}}">Utilisateurs</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Utilisateur</a></li>
            <li class="divider">/</li>
            <li>{{$utilisateur->id}}</li>
        </ul>
        <section class="utilisateur_infos">
            <img src="{{asset('assets/images/agent.webp')}}" alt="profile admin" class="infos_image">
            <h2>{{$utilisateur->fname}} {{$utilisateur->lname}} <span class="role">{{$utilisateur->role->role}}</span></h2>
            <p class="infos_desc">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corrupti, 
                aliquid alias quos praesentium incidunt ducimus eaque aliquam consequuntur expedita tenetur!
            </p>
            <div class="infos_perso">
                <h2>Coordonnées de Contact</h2>
                <span><i class="fa-solid fa-envelope"></i> {{$utilisateur->email}}</span>
                <span><i class="fa-solid fa-phone"></i> {{$utilisateur->phone}}</span>
            </div>
            @if ($utilisateur->role_id == 3)
                <div class="infos_perso">
                    <h2>Réseaux Sociaux</h2>
                    <a href=""><i class="fa-brands fa-whatsapp"></i> {{$utilisateur->whatsapp}}</a>
                    <a href=""><i class="fa-brands fa-facebook"></i> Facebook</a>
                    <a href=""><i class="fa-brands fa-instagram"></i> Instagram</a>
                </div>
            @endif
            <div class="btns">
                <a href="{{route('utilisateurs.edit',$utilisateur->id)}}" class="edit">Modifier</a>
                <form action="{{route('utilisateurs.destroy',$utilisateur->id)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer l\'Utilisateur {{$utilisateur->fname}} ?')">Supprimer</button>
                </form>
            </div>
        </section>
    </main>
@endsection