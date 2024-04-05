@extends('layouts.admin')
@section('title','Annonce')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/admin/annonces/annonce.css')}}">
@endsection
@section('main')
    <main>
        <h1 class="title">Liste Des Annonces</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('dashboard')}}">Acceuil</a></li>
            <li class="divider">/</li>
            <li><a href="{{route('annonces.index')}}">Annonces</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Annonce</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">{{$annonce->id}}</a></li>
        </ul>
        
        <section class="annonce_info">
            <section class="images">
                @foreach ($annonce->images as $image)
                    <img src="{{asset('storage/annonces/'.$image->path)}}" alt="image Annonce {{$annonce->title}}">
                @endforeach
            </section>
            <h2 class="info_title">{{$annonce->title}}</h2>
            <span class="date">{{$annonce->user->fname}} {{$annonce->user->lname}} - {{$annonce->created_at->format('d M Y')}}</span>
            <span>{{$annonce->city}} - {{$annonce->address}}</span>
            <span class="category">{{$annonce->category->name}}</span>
            <span class="info_description">{!! $annonce->description !!}</span>
            <span class="table_title">Informations Du Bien</span>
            <div class="container_table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Statut</th>
                            <th>Type</th>
                            <th>Valid</th>
                            <th>Premium</th>
                            <th>Superficie m<small><sup>2</sup></small></th>
                            <th>Prix Dhs</th>
                            <th>Chambres</th>
                            <th>SDB</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$annonce->status}}</td>
                            <td>{{$annonce->type}}</td>
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
                            <td>{{$annonce->surface}}</td>
                            <td>{{$annonce->price}}</td>
                            <td>{{$annonce->bedroom}}</td>
                            <td>{{$annonce->bathroom}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="btns">
                <a href="{{route('annonces.edit',$annonce->id)}}" class="btn_warning">Modifier</a>
                <form action="{{route('annonces.destroy',$annonce->id)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn_danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer l\'annonce {{$annonce->title}} ?')">Supprimer</button>
                </form>
            </div>
        </section>
    </main>
@endsection