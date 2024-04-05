@extends('layouts.annonceur')
@section('title','Messages')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/admin/articles/articles.css')}}">
@endsection
@section('script')
    <script src="{{asset('assets/js/articles.js')}}" defer></script>
@endsection 
@section('main')
    <main>
        <h1 class="title">Liste Des Messages</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('annonceur.dashboard')}}">Acceuil</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Messages</a></li>
        </ul>
        @if(session('message'))
            <section class="section_message" id="section_message">
                {{ session('message') }}
            </section>
        @endif
        <section class="table__header">
            <form method="POST" action="{{route('message.deleteAll')}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="supprimer_articles" onclick="return confirm('Êtes-vous sûr de vouloir supprimer tous les messages ?')">Supprimer Tous</button>
            </form>
            <div class="input-group">
                <input type="search" placeholder="Chercher Message...">
                <img src="{{asset('assets/images/search.png')}}" alt="recherche icon">
            </div>
        </section>
        @if($messages->isEmpty())
            <p class="zero">Aucun Message trouvé</p>
        @else
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> Nom & Prenom <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Email <span class="icon-arrow">&UpArrow;</span></th>                            
                            <th> Téléphone <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Adresse <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Annonce <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Date <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $key => $message )
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$message->nom}} {{$message->prenom}}</td>
                                <td>{{$message->email}}</td>
                                <td>{{$message->telephone}}</td>
                                <td>{{$message->adresse}}</td>
                                <td>
                                    <p class="status categorie">{{$message->annonce_id}}</p>
                                </td>
                                <td> {{$message->created_at->format('d-m-Y')}} </td>
                                <td class="actions">
                                    <form method="POST" action="{{route('message.delete',$message->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button id="delete" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer le message de {{$message->nom}} ?')"> <i class="fa-solid fa-trash"></i></button>
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