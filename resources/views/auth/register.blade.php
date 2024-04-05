@extends('layouts.app')
@section('title','Register')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/register.css')}}">
@endsection
@section('script')
    <script src="{{asset('assets/js/register.js')}}" defer></script>
@endsection
@section('content')
    @if(session('message'))
        <section class="section_message" id="section_message">
            {{ session('message') }}
        </section>
    @endif
    <!-- Section Register -->
    <h1 class="sign_up_title">NOUVEAU COMPTE</h1>
    <section class="sign_up">
        <img src="{{asset('assets/images/login.webp')}}" alt="register image" class="form_image">
        <div class="register_form">
            <form action="{{route('register')}}" class="up_form" method="post">
                @csrf
                <div class="sign_group">
                    <div class="group">
                        <label for="lname">Nom <span class="required">*</span> </label>
                        <input type="text" name="lname" id="lname" class="group_input" required placeholder="Votre Nom" value="{{old('lname')}}">
                        <span class="message" id="message_first">{{ $errors->first('lname') }}</span>
                    </div>
                    <div class="group">
                        <label for="fname">Prénom <span class="required">*</span> </label>
                        <input type="text" name="fname" id="fname" class="group_input" required placeholder="Votre Prénom" value="{{old('fname')}}">
                        <span class="message" id="message_last">{{ $errors->first('fname') }}</span>
                    </div>
                </div>
                <div class="sign_group">
                    <div class="group">
                        <label for="email">Email <span class="required">*</span> </label> 
                        <input type="email" name="email" id="email" class="group_input" required placeholder="Adresse E-mail" value="{{old('email')}}">
                        <span class="message" id="message_email">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="group">
                        <label for="phone">Téléphone <span class="required">*</span> </label>
                        <input type="tel" name="phone" id="phone" class="group_input" required placeholder="Numéro Téléphone" value="{{old('phone')}}"> 
                        <span class="message" id="message_phone">{{ $errors->first('phone') }}</span>
                    </div>
                </div>
                <div class="sign_group">
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
                </div>
                <div class="sign_group">
                    <div class="group">
                        <label for="password">Mot De Passe <span class="required">*</span> </label>
                        <input type="password" name="password" id="password" class="group_input" required placeholder="Mot De Passe">
                        <span class="message" id="message_password">{{ $errors->first('password') }}</span>
                    </div>
                    <div class="group">
                        <label for="password_confirmation">Confirmation <span class="required">*</span> </label>
                        <input type="password" name="password_confirmation" id="confirm_pass" class="group_input" required placeholder="Confirmer Mot De Passe">
                        <span class="message" id="message_confirm">{{ $errors->first('password_confirmation') }}</span>
                    </div>
                </div>
                <div class="check_group">
                    <input type="checkbox" name="accept" id="accept" class="accept" required checked>
                    <label for="accept">Acceptez toutes les <a href=""> Conditions </a> et <a href=""> Autorisations </a> </label>
                    <span class="message" id="message_accept"></span>
                </div>
                <input type="submit" value="S'inscrire" class="btn_form" id="btn_form">
            </form>
        </div>
    </section>
@endsection