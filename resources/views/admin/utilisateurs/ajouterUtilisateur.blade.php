@extends('layouts.admin')
@section('title','Ajouter')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/admin/utilisateurs/ajouterUtilisa.css')}}">
@endsection
@section('main')
    <main>
        <h1 class="title">Nouveau Utilisateur</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('dashboard')}}">Acceuil</a></li>
            <li class="divider">/</li>
            <li><a href="{{route('utilisateurs.index')}}">Utilisateurs</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Nouveau Utilisateur</a></li>
        </ul>
        <section class="ajouter_utilis">
            <form action="{{route('utilisateurs.store')}}" method="POST" class="utilis_form">
                @csrf
                <div class="input_group">
                    <label for="lname">Nom <span class="required">*</span></label>
                    <input type="text" name="lname" class="input" id="nom" required placeholder="Nom" value="{{old('lname')}}">
                    <span class="message" id="message_last">{{ $errors->first('lname') }}</span>
                </div>
                <div class="input_group">
                    <label for="lname">Prénom <span class="required">*</span></label>
                    <input type="text" name="fname" class="input" id="prenom" required placeholder="Prénom" value="{{old('fname')}}">
                    <span class="message" id="message_first">{{ $errors->first('fname') }}</span>
                </div>
                <div class="input_group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" name="email" class="input" id="email" required placeholder="Votre E-mail Adresse" value="{{old('email')}}">
                    <span class="message" id="message_email">{{ $errors->first('email') }}</span>
                </div>
                <div class="input_group">
                    <label for="lname">Téléphone <span class="required">*</span></label>
                    <input type="text" name="phone" class="input" id="phone" required minlength="10" maxlength="10" placeholder="Votre Téléphone" value="{{old('phone')}}">
                    <span class="message" id="message_phone">{{ $errors->first('phone') }}</span>
                </div>
                <div class="radios">
                    <div>
                        <input type="radio" name="role" id="client" class="client" required checked value="2">
                        <label for="client">Client </label>
                    </div>
                    <div>
                        <input type="radio" name="role" id="agent" class="agent" required value="3">
                        <label for="agent">Annonceur </label>
                    </div>
                </div>
                <div class="input_group">
                    <label for="password">Mot De Passe <span class="required">*</span> </label>
                    <input type="password" name="password" id="password" class="input" required placeholder="Mot De Passe">
                    <span class="message" id="message_password">{{ $errors->first('password') }}</span>
                </div>
                <div class="input_group">
                    <label for="password_confirmation">Confirmation <span class="required">*</span> </label>
                    <input type="password" name="password_confirmation" id="confirm_pass" class="input" required placeholder="Confirmer Mot De Passe">
                    <span class="message" id="message_confirm">{{ $errors->first('password_confirmation') }}</span>
                </div>
                <div class="check">
                    <input type="checkbox" id="voir" class="voir">
                    <label for="voir">Voir Mot De Passe</label>
                </div>
                <button class="btn">Ajouter</button>
            </form>
        </section>
    </main>
    <script>
        var btn = document.getElementById('voir');
        btn.addEventListener('click', () => {
        var x = document.querySelector('#password');
        var y = document.querySelector('#confirm_pass');
            if (x.type === "password") {
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
            }
        });
    </script>
@endsection