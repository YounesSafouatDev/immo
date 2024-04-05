@extends('layouts.admin')
@section('title','Modifier')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/admin/utilisateurs/ajouterUtilisa.css')}}">
@endsection
@section('main')
    <main>
        <h1 class="title">Modifier Utilisateur</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('dashboard')}}">Acceuil</a></li>
            <li class="divider">/</li>
            <li><a href="{{route('utilisateurs.index')}}">Utilisateurs</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Modifier Utilisateur</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">{{$utilisateur->id}}</a></li>
        </ul>
        <h2 class="title_infos">Information Personnelle</h2>
        <section class="ajouter_utilis">
            <form action="{{route('utilisateurs.update',$utilisateur->id)}}" method="POST" class="utilis_form">
                @csrf
                @method('put')
                <div class="input_group">
                    <label for="lname">Nom <span class="required">*</span></label>
                    <input type="text" name="lname" class="input" id="nom" required placeholder="Nom" value="{{$utilisateur->lname}}">
                    <span class="message" id="message_last">{{ $errors->first('lname') }}</span>
                </div>
                <div class="input_group">
                    <label for="lname">Prénom <span class="required">*</span></label>
                    <input type="text" name="fname" class="input" id="prenom" required placeholder="Prénom" value="{{$utilisateur->fname}}">
                    <span class="message" id="message_first">{{ $errors->first('fname') }}</span>
                </div>
                <div class="input_group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" name="email" class="input" id="email" required placeholder="Votre E-mail Adresse" value="{{$utilisateur->email}}">
                    <span class="message" id="message_email">{{ $errors->first('email') }}</span>
                </div>
                <div class="input_group">
                    <label for="lname">Téléphone <span class="required">*</span></label>
                    <input type="text" name="phone" class="input" id="phone" required minlength="10" maxlength="10" placeholder="Votre Téléphone" value="{{$utilisateur->phone}}">
                    <span class="message" id="message_phone">{{ $errors->first('phone') }}</span>
                </div>
                <button class="btn">Sauvegarder</button>
            </form>
        </section>
        @if($utilisateur->role_id == 3)
            <h2 class="title_infos">Réseau Sociaux</h2>
            <form action="{{route('utilisateurs.reseau',$utilisateur->id)}}" method="POST" class="url_form">
                @csrf
                <div class="input_group">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" name="whatsapp" class="input" id="whatsapp" minlength="10" maxlength="10" placeholder="Numéro Téléphone Whatsapp" value="{{$utilisateur->whatsapp}}">
                    <span class="message">{{ $errors->first('whatsapp') }}</span>
                </div>
                <div class="input_group">
                    <label for="facebook">Facebook</label>
                    <input type="text" name="facebook" class="input" id="facebook" placeholder="Votre Profil Facebook" value="{{$utilisateur->facebook}}">
                </div>
                <div class="input_group">
                    <label for="instagram">Instagram</label>
                    <input type="text" name="instagram" class="input" id="instagram" placeholder="Votre Profil Instagram" value="{{$utilisateur->instagram}}">
                </div>
                <button class="btn">Ajouter</button>
            </form> 
        @endif
        

        <h2 class="title_infos">Mot De Passe</h2>
        <form action="{{route('utilisateurs.changermdp',$utilisateur->id)}}" method="POST" class="url_form">
            @csrf
            <div class="input_group">
                <label for="ancien">Ancien Mot De Passe</label>
                <input type="password" name="ancien" class="input" id="pss" min="8" placeholder="Ancien Mot De Passe" required value="{{old('ancien')}}">
                <span class="message" id="message_confirm">{{ $errors->first('ancien') }}</span>
            </div>
            <div class="input_group">
                <label for="password">Nouveau Mot De Passe</label>
                <input type="password" name="password" class="input" id="password" min="8" required placeholder="Nouveau Mot De Passe" value="{{old('password')}}">
                <span class="message" id="message_confirm">{{ $errors->first('password') }}</span>
            </div>
            <div class="input_group">
                <label for="password_confirmation">Confirmation </label>
                <input type="password" name="password_confirmation" min="8" required id="confirm_pass" class="input" required placeholder="Confirmer Nouveau Mot De Passe">
                <span class="message" id="message_confirm">{{ $errors->first('password_confirmation') }}</span>
            </div>
            <div class="mdp_group">
                <input type="checkbox" id="voir" class="voir">
                <label for="voir">Voir Mot De Passe</label>
            </div>
            <button class="btn">Modifier</button>
        </form>
    </main>
    <script>
        var btn = document.getElementById('voir');
        btn.addEventListener('click', () => {
        var x = document.querySelector('#password');
        var y = document.querySelector('#confirm_pass');
        var z = document.querySelector('#pss');
            if (x.type === "password") {
                x.type = "text";
                y.type = "text";
                z.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
                z.type = "password";
            }
        });
        var regexPhone = /^(06|07)\d{8}$/;
    </script>
@endsection