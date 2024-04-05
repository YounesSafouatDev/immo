@extends('layouts.app')
@section('title','Biens')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/properties.css')}}" />
@endsection
@section('content')
    <!-- Section Properties -->
    <section class="section_properties">
        <div class="section_text">
            <h1 class="section_title">LISTE DES BIENS</h1>
            <span><a href="{{route('accueil')}}">Accueil </a> | Properties</span>
        </div>
        <div class="section_cards">
            <div class="property_card">
                @if ($annonces->isNotEmpty())
                    @foreach ($annonces as $annonce )
                        <div class="card_list">
                            <img src="{{asset('storage/annonces/'.$annonce->images->first()->path)}}" alt="property_image" class="card_image">
                            <div class="card_text">
                                <a href="{{route('bien',$annonce->id)}}" class="text_title">{{Str::limit($annonce->title,140)}}...</a>
                                <p class="text_description">{!!Str::limit($annonce->description,70)!!}...</p>
                            </div>
                            <div class="card_details">
                                @if (in_array($annonce->category_id, [1, 2, 3]))
                                    <span> <i class="fa-regular fa-square"></i> {{$annonce->surface}} m<small><sup>2</sup></small></span>
                                    <span> {{$annonce->bedroom}} <i class="fa-solid fa-bed"></i> </span>
                                    <span> {{$annonce->bathroom}} <i class="fa-solid fa-bath"></i> </span>
                                @elseif(in_array($annonce->category_id, [3,4]))
                                    <span> <i class="fa-regular fa-square"></i> {{$annonce->surface}}m<small><sup>2</sup></small></span>
                                    <span> {{$annonce->bathroom}} <i class="fa-solid fa-bath"></i> </span>
                                @else 
                                    <span> <i class="fa-regular fa-square"></i> {{$annonce->surface}}m<small><sup>2</sup></small></span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    
                @else
                    <p>Aucune Annonce trouvé</p>
                @endif
                
            </div>
            <div class="pagination">
                <a href="{{$annonces->previousPageUrl()}}" class="prev">
                    << Précédente
                </a>
                <a href="{{$annonces->nextPageUrl()}}" class="next">
                    Suivante >>
                </a>
            </div>
        </div>
        
    </section>
@endsection