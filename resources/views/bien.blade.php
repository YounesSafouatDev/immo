@extends('layouts.app')
@section('title','Bien')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/simpleProperty.css')}}" />
@endsection
@section('script')
    <script src="{{asset('assets/js/simple-property.js')}}" defer></script>
@endsection
@section('content')
    <section class="simple_property">
        <div class="simple_text">
            <h2 class="simple_title">Bien Immobilier</h2>
            <span class="simple_link"> <a href="{{route('accueil')}}">Accueil</a> | <a href="{{route('biens')}}">Biens Immobilier</a> | Bien | {{$annonce->id}}</span>
        </div>
    </section>
    @if(session('message'))
        <section class="section_message" id="section_message">
            {{ session('message') }}
        </section>
    @endif
    <section class="section_simple">
        <div class="simples_images">
            <img src="{{ asset('storage/annonces/' . $annonce->images->first()->path) }}" alt="" class="first" loading="lazy">
            <div class="images_second" id="imageCardsContainer">
                @foreach ($annonce->images as $image)
                    <img src="{{ asset('storage/annonces/' . $image->path) }}" alt="bien immobilier" class="second" loading="lazy">
                @endforeach
            </div>
            <div class="btns_np">
                <a href="#" class="prev" id="prevButton">&lt;&lt;</a>
                <a href="#" class="next" id="nextButton">&gt;&gt;</a>
            </div>
        </div>
        <div class="simple_informations">
            <div class="inforamtions_property">
                <p class="property_title"><span>{{$annonce->title}}</span></p>
                <span class="property_adresse">{{$annonce->address}} | {{$annonce->city}}</span>
                <div class="property_details">
                    <span><i class="fa-regular fa-square"></i> {{$annonce->surface}}m<small><sup>2</sup></small></span>
                    @if ($annonce->bedroom != 0)
                        <span>{{$annonce->bedroom}} <i class="fa-solid fa-bed"></i></span>
                    @endif
                    @if ($annonce->bathroom != 0)
                        <span>{{$annonce->bathroom}} <i class="fa-solid fa-bath"></i></span>
                    @endif
                    
                    
                </div>
                <div class="informations_description">
                    <p class="description_title">DESCRIPTION</p>
                    <p class="description_text">
                        {!!$annonce->description!!}
                    </p>
                </div>
                <span class="type">{{$annonce->type}}</span> 
                <span class="status">{{$annonce->status}}</span>
                @if($annonce->type =='Location' )
                    <p class="price">{{$annonce->price}} Dhs / Mois</p>
                @else   
                    <p class="price">{{$annonce->price}} Dhs</p>
                @endif
                
            </div>
        </div>
    </section>
    <section class="section_annonceur">
        <div class="info_anno">
            <div class="img_annonceur"></div>
            <span>{{$annonce->user->fname}} {{$annonce->user->lname}}</span>
        </div>
        <form action="{{route('messages.envoyer')}}" method="post" class="formulaire">
            @csrf
            <label for="nom">Nom </label>
            <input type="text" name="nom" class="input" required placeholder="Votre Nom">
            <span class="error">{{$errors->first('nom')}}</span>
            <label for="prenom">Prénom </label>
            <input type="text" name="prenom" class="input" required placeholder="Votre Prénom">
            <span class="error">{{$errors->first('prenom')}}</span>
            <label for="email">Email</label>
            <input type="email" name="email" class="input" required placeholder="Votre Adresse Email">
            <span class="error">{{$errors->first('email')}}</span>
            <label for="telephone">Téléphone </label>
            <input type="tel" name="telephone" class="input" required placeholder="Votre Numéro de Téléphone">
            <span class="error">{{$errors->first('telephone')}}</span>
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" required class="input" placeholder="Votre Adresse">
            <span class="error">{{$errors->first('adresse')}}</span>
            <input type="hidden" name="annonce" value="{{$annonce->id}}">
            <input type="submit" class="btn_submit" value="Envoyer">
        </form>
    </section>
    <!-- Properties  -->
    <section class="section_premium">
        <h3 class="premium_title">PREMIUM PROPERTIES</h3>
        <div class="premium_cards" id="premiumCardsContainer">
            @foreach ($annonces as $item)
                <div class="premium">
                    <img src="{{ asset('storage/annonces/' . $item->images->first()->path) }}" alt="property_image" class="premium_image">
                    <div class="premium_text">
                        <a href="{{route('bien',$item->id)}}" class="text_title">{{$item->title}}</a>
                        <p class="text_description">{!!Str::limit($item->description,75)!!}...</p>
                    </div>
                    <div class="premium_details">
                        @if (in_array($item->category_id, [1, 2, 3]))
                            <span> <i class="fa-regular fa-square"></i> {{$item->surface}} m<small><sup>2</sup></small></span>
                            <span> {{$item->bedroom}} <i class="fa-solid fa-bed"></i> </span>
                            <span> {{$item->bathroom}} <i class="fa-solid fa-bath"></i> </span>
                        @elseif(in_array($item->category_id, [3,4]))
                            <span> <i class="fa-regular fa-square"></i> {{$item->surface}}m<small><sup>2</sup></small></span>
                            <span> {{$item->bathroom}} <i class="fa-solid fa-bath"></i> </span>
                        @else 
                            <span> <i class="fa-regular fa-square"></i> {{$item->surface}}m<small><sup>2</sup></small></span>
                        @endif
                    </div>
                </div>
            @endforeach
            
            <!-- More Premium -->
        </div>
        <div class="btns">
            <button id="prev" class="btn"><i class="fa-solid fa-backward"></i> Précédente</button>
            <button id="next" class="btn">Suivante <i class="fa-solid fa-forward"></i></button>
        </div>
    </section>
    <script>
        var form = document.querySelector("formulaire");
        var messagep = document.querySelector('.error');
        var regexPhone = /^(06|07)\d{8}$/;
        form.addEventListener('submit', (event)=>{
            if (!isPhoneNumberValid) {
                event.preventDefault();
                messagep.innerHTML = 'dix nombre 06|07'
            }
        });
        function checkPhoneNumber(phoneNumber) {
            return phoneNumber.match(regexPhone);
        }
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.getElementById('section_message').style.display = 'none';
            }, 15000); 
        });
    </script>
@endsection

    