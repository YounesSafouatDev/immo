@extends('layouts.admin')
@section('title','Dashboard')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/admin/dashboard.css')}}">
@endsection
@section('main')
    <!-- MAIN -->
		<main>
			<h1 class="title">Tableau de Bord</h1>
			<ul class="breadcrumbs">
				<li><a href="{{route('dashboard')}}">Acceuil</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Tableau de Bord</a></li>
			</ul>
			<div class="info-data">
				<div class="card">
					<div class="head">
						<div>
							<h2>{{$annonces->count()}}</h2>
							<p>Annonces</p>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="head">
						<div>
							<h2>{{$utilisateurs->count()}}</h2>
							<p>Utilisateurs</p>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="head">
						<div>
							<h2>{{$articles->count()}}</h2>
							<p>Articles</p>
						</div>
					</div>
				</div>
			</div>
            <table>
                <caption>Liste Des Utilisateurs</caption>
                <thead>
                    <tr>
                        <th scope="col" class="id">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Rôle</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($utilisateurs as $key => $utilisateur )
                        <tr>
                            <td scope="row" data-label="Id" >{{$key+1}}</td>
                            <td data-label="Nom">{{$utilisateur->lname}}</td>
                            <td data-label="Email">{{$utilisateur->email}}</td>
                            <td data-label="Téléphone">{{$utilisateur->phone}}</td>
                            <td data-label="Rôle">{{$utilisateur->role->role}}</td>
                            <td data-label="actions" class="actions">
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
            <a href="{{route('utilisateurs.index')}}" class="voirplus">Voir Plus</a>
            <table>
                <caption>Liste Des Annonces</caption>
                <thead>
                    <tr>
                        <th scope="col" class="id">#</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Description</th>
                        <th scope="col">Nom Annonceur</th>
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
                            <td data-label="Nom Annonceur">Hilali</td>
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
                                <a href="{{route('annonces.show',$annonce->id)}}" class="voir"><i class="fa-regular fa-eye"></i></a>
                                <a href="{{route('annonces.edit',$annonce->id)}}" class="edit"><i class="fa-regular fa-pen-to-square"></i></a>
                                <form method="POST" action="{{route('annonces.destroy',$annonce->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button id="delete" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer {{$annonce->title}}?')"> <i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{route('annonces.index')}}" class="voirplus">Voir Plus</a>

            <table>
                <caption>Liste Des Articles</caption>
                <thead>
                    <tr>
                        <th scope="col" class="id">#</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date Creation</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $key => $article )
                    <tr>
                        <td scope="row" data-label="Id" >{{$key + 1}}</td>
                        <td data-label="Titre">{{$article->title}}</td>
                        <td data-label="Description">{!!Str::limit($article->description, 100)!!}</td>
                        <td data-label="Date Creation">{{$article->created_at->format('d M Y')}}</td>
                        <td data-label="actions" class="actions">
                            <a href="{{route('articles.show',$article->id)}}" class="voir"><i class="fa-regular fa-eye"></i></a>
                            <a href="{{route('articles.edit',$article->id)}}" class="edit"><i class="fa-regular fa-pen-to-square"></i></a>
                            <form method="POST" action="{{route('articles.destroy',$article->id)}}">
                                @csrf
                                @method('DELETE')
                                <button id="delete" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer {{$article->title}}?')"> <i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{route('articles.index')}}" class="voirplus">Voir Plus</a>
		</main>
	<!-- MAIN -->
@endsection