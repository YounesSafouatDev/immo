@extends('layouts.app')
@section('title','Se Connecter')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
@endsection
@section('script')
    <script src="{{asset('assets/js/login.js')}}" defer></script>
@endsection
@section('content')
    <!-- Section Login -->
    @if(session('message'))
        <section class="section_message" id="section_message">
            {{ session('message') }}
        </section>
    @endif
    @if(session('error'))
        <section class="section_error" id="section_message">
            {{ session('error') }}
        </section>
    @endif
    <section class="login">
        <img src="{{asset('assets/images/login.webp')}}" alt="login image" class="form_image">
        <div class="login_form">
            <h1 class="form_title">BIENVENUE</h1>
            <form action="{{route('login')}}" class="sign_in" method="post">
                @csrf
                <div class="sign_group">
                    <label for="email">Email <span class="required">*</span> </label>
                    <input type="email" name="email" id="email" class="group_input" required placeholder="Votre E-mail" 
                        @if (isset($_COOKIE['email']))
                            value="{{$_COOKIE['email']}}"
                        @else
                            value="{{old('email')}}"
                        @endif
                    >
                    <span class="message_email" id="message_email">{{ $errors->first('email') }}</span>
                </div>
                <div class="sign_group">
                    <label for="password">Mot De Passe <span class="required">*</span></label>
                    <input type="password" name="password" id="password" class="group_input" required placeholder="********" >
                    <span class="message_password" id="message_password">{{ $errors->first('password') }}</span>
                </div>
                <div class="sign_check_link">
                    <div class="check">
                        <input type="checkbox" name="remember" id="remember" class="remember" 
                            @if (isset($_COOKIE['email']))
                                checked=""
                            @endif
                        >
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="{{route('forget')}}" class="forgot">Mot de passe oublié ?</a>
                </div>
                <input type="submit" value="Se Connecter" class="btn_form" id="btn_form">
            </form>
            <p class="account">Vous n'avez pas de compte ?<a href="{{route('show_register')}}"> S'inscrire</a></p>
        </div>
    </section>

@endsection