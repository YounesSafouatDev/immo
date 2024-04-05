@extends('layouts.app')
@section('title','A propos')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/about.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
@endsection
@section('content')
    <!-- About us -->
    <h2 class="apropos_text">
        A propos de Nous
    </h2>
    <section class="about" >
        <div class="about_img"></div>
        <div class="about_text">
            <span class="about_title">#1 Le lieu idéal pour trouver votre bien immobilier</span>
            <span class="about_desc">
                Notre agence immobilière est dédiée à vous aider à trouver la propriété parfaite. 
                Que vous cherchiez à louer ou à acheter, 
                nous sommes là pour vous accompagner à chaque étape du processus. 
            </span>
            <ul class="about_list">
                <li><i class="fa-solid fa-check"></i> Recherche personnalisée de biens immobiliers </li>
                <li><i class="fa-solid fa-check"></i> Négociation et gestion des offres</li>
                <li><i class="fa-solid fa-check"></i> Contact avec l'annonceur facilité</li>
            </ul>
            <a href="{{route('accueil')}}" class="about_btn">Voir Plus</a>
        </div>
    </section>
    <!-- Service -->
    <h2 class="services_text">
       Nos Services
    </h2>
    <section class="services">
        <div class="service">
            <h3 class="number">01</h3>
            <p class="service_title">Trouvez la maison de vos rêves </p>
            <p class="service_para">
                Parcourez une vaste sélection de propriétés, des appartements chaleureux aux maisons spacieuses, 
                et découvrez des lieux qui correspondent à votre style de vie et à vos besoins.
            </p>
        </div>
        <div class="service">
            <h3 class="number">02</h3>
            <p class="service_title"> Agent Expérimenté</p>
            <p class="service_para">
                Avec des années d'expertise dans le domaine, 
                notre équipe vous accompagne dans la recherche de votre maison idéale. 
            </p>
        </div>
        <div class="service">
            <h3 class="number">03</h3>
            <p class="service_title">Acheter ou louer des propriétés</p>
            <p class="service_para">
                ur notre site d'annonce immobilière, explorez une gamme variée de biens immobiliers 
                disponibles à l'achat ou à la location. 
            </p>
        </div>
        <div class="service">
            <h3 class="number">04 </h3>
            <p class="service_title">Des milliers de propriétés </p>
            <p class="service_para">
                Parcourez des maisons, des appartements, des terrains et bien plus encore, 
                dans des emplacements variés et pour tous les budgets.
            </p>
        </div>
    </section>
@endsection