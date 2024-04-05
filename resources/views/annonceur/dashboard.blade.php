@extends('layouts.annonceur')
@section('title','Dashboard')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/admin/dashboard.css')}}">
@endsection
@section('main')
    <!-- MAIN -->
		<main>
			<h1 class="title">Tableau de Bord</h1>
			<ul class="breadcrumbs">
				<li><a href="{{route('annonceur.dashboard')}}">Acceuil</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Tableau de Bord</a></li>
			</ul>
			<div class="info-data">
				<div class="card">
					<div class="head">
						<div>
							<h2>{{$nbannonces}}</h2>
							<p>Annonces</p>
						</div>
					</div>
				</div>
				
				<div class="card">
					<div class="head">
						<div>
							<h2>{{$nbmessages}}</h2>
							<p>Messages</p>
						</div>
					</div>
				</div>
			</div>
            @if(session('message'))
                <section class="section_message" id="section_message">
                    {{ session('message') }}
                </section>
            @endif
            <table>
                <caption>Liste Des Messages</caption>
                <thead>
                    <tr>
                        <th scope="col" class="id">#</th>
                        <th scope="col">Nom & Prénom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Annonce</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $key => $message )
                        <tr>
                            <td scope="row" data-label="Id" >{{$key+1}}</td>
                            <td data-label="Nom">{{$message->nom}} {{$message->prenom}}</td>
                            <td data-label="Email">{{$message->email}}</td>
                            <td data-label="Téléphone">{{$message->telephone}}</td>
                            <td data-label="Rôle">{{$message->annonce_id}}</td>
                            <td data-label="actions" class="actions">
                                <form method="POST" action="{{route('message.delete',$message->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button id="delete" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer le message de  {{$message->nom}} {{$message->prenom}} ?')"> Supprimer </button>
                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{route('message.messages')}}" class="voirplus">Voir Plus</a>
            <table>
                <caption>Liste Des Annonces</caption>
                <thead>
                    <tr>
                        <th scope="col" class="id">#</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Description</th>
                        <th scope="col">Valide</th>
                        <th scope="col">Premuim</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($annonces as $key => $annonce)
                        <tr>
                            <td scope="row" data-label="Id" >{{$key+1}}</td>
                            <td data-label="Titre">{{$annonce->title}}</td>
                            <td data-label="Description">{!!Str::limit($annonce->description, 20)!!}</td>
                            <td data-label="Valide">
                                @if ($annonce->is_valid)
                                    <i class="fa-solid fa-check valide"></i>
                                @else
                                    <i class="fa-solid fa-minus non"></i>
                                @endif
                            </td>
                            <td data-label="Premuim">
                                @if ($annonce->is_premium)
                                    <i class="fa-solid fa-check valide"></i>
                                @else
                                    <i class="fa-solid fa-minus non"></i>
                                @endif
                            </td>
                            <td data-label="actions" class="actions">
                                <a href="{{route('annonceur.show',$annonce->id)}}" class="voir"><i class="fa-regular fa-eye"></i></a>
                                <a href="{{route('annonceur.edit',$annonce->id)}}" class="edit"><i class="fa-regular fa-pen-to-square"></i></a>
                                <form method="POST" action="{{route('annonceur.destroy',$annonce->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button id="delete" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer {{$annonce->title}}?')"> <i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{route('annonceur.index')}}" class="voirplus">Voir Plus</a>

		</main>
	<!-- MAIN -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.getElementById('section_message').style.display = 'none';
            }, 15000); 
        });
    </script>
@endsection