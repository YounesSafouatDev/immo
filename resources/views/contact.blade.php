@extends('layouts.app')
@section('title','Contact')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/contact.css')}}">
@endsection
@section('content')
      <!-- Section Contact -->
      @if(session('success'))
            <section class="section_message" id="section_message">
                {{ session('success') }}
            </section>
        @endif
    <section class="contact">
        <h1 class="contact_title">Contactez Nous</h1>
        <p class="contact_para">
            N'hésitez pas à nous contacter pour toute question, demande d'information ou pour prendre rendez-vous. Notre équipe 
            professionnelle est là pour vous aider et vous fournir les réponses dont vous avez besoin.
        </p>
        <div class="contact_information">
            <div class="information_card">
                <span class="card_location"><i class="fa-solid fa-location-dot"></i></span>
                <p class="location_address">244, boulevard brahim Roudani</p>
            </div>
            <div class="information_card">
                <span class="card_email"><i class="fa-solid fa-envelope-open"></i></span>
                <p class="email_address">Salmane534@gmail.com</p>
            </div>
            <div class="information_card">
                <span class="card_phone"><i class="fa-solid fa-phone"></i></span>
                <p class="phone_address">0636717851</p>
            </div>
        </div>
        @if ($errors->any())
            <div class="errors">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif    
        <div class="contact_form">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3323.848044323628!2d-7.634471525662234!3d33.583294442348894!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda7d2bfe0594e2f%3A0xf6323ce1cfc2a3b2!2s244%20Bd%20Brahim%20Roudani%2C%20Casablanca%2020250!5e0!3m2!1sen!2sma!4v1711367636553!5m2!1sen!2sma" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>            <form action="{{route('contactezNous')}}" method="POST" class="form_get_in">
                @csrf
                <h2 class="in_title">Entrer En Contact</h2>
                <div class="get_in">
                    <div class="get_in_group">
                        <input type="text" name="name" id="nom" class="get_in_input" required placeholder="Votre Nom et Prénom">
                        <input type="email" name="email" id="email" class="get_in_input" required placeholder="Votre Adresse Email">
                    </div>
                    <div class="get_in_group">
                        <input type="tel" name="phone" id="phone" class="get_in_input" required placeholder="Votre Numéro Téléphone">
                        <input type="text" class="subject" name="subject" id="subject" placeholder="Sujet" required>
                    </div>
                    <textarea name="message" class="message" id="message" cols="30" rows="10" placeholder="Votre Message"></textarea>
                    <input type="submit" id="btn_contact" class="btn_contact" value="Envoyer">
                </div>
            </form>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.getElementById('section_message').style.display = 'none';
            }, 20000); 
        });
    </script>
@endsection