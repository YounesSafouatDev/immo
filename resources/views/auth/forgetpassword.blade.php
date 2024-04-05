@extends('layouts.app')
@section('title','Email')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/email.css')}}">
@endsection
@section('content')
    @if(session('error'))
        <section class="section_error" id="section_message">
            {{ session('error') }}
        </section>
    @endif
    <section class="enter_email">
        <form action="{{route('recovery')}}" class="send_email" method="post">
            @csrf
            <label for="email" class="label">E-mail Adresse <span class="required"> * </span></label>
            <input type="email" name="email" id="email" class="email" placeholder="Votre Email" required>
            <span class="error">{{ $errors->first('email') }}</span>
            <input type="submit" class="btn_send" value="Envoyer">
        </form>
    </section>
@endsection