@extends('layouts.admin')
@section('title','Modifier Annonce')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/admin/annonces/aeAnnonces.css')}}">
@endsection
@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
@endsection
@section('main')
    <main>
        <h1 class="title">Nouvelle Annonce</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('dashboard')}}">Acceuil</a></li>
            <li class="divider">/</li>
            <li><a href="{{route('annonces.index')}}">Annonces</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Modifier Annonce</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">{{$annonce->id}}</a></li>
        </ul>
        <section class="images" id="uploaded_images">
            @foreach ($annonce->images as $image)
                <img src="{{asset('storage/annonces/'.$image->path)}}" alt="image Annonce {{$annonce->title}}">
            @endforeach
        </section>
        <div class="new_article">
            <form action="{{route('annonces.update',$annonce->id)}}" method="post" class="form" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="input_group">
                    <label for="title">Titre Annonce <span class="required">*</span></label>
                    <input type="text" required id="titre" placeholder="Un Titre Pour L'annonce" autofocus class="input" name="title" value="{{$annonce->title}}">
                    <span class="error">{{ $errors->first('title') }}</span>
                </div>
                <div class="input_group">
                    <label for="images[]">Images <span class="required">*</span></label>
                    <input type="file" class="input_file" id="input_file" name="images[]" multiple>
                    <span class="error">{{ $errors->first('images') }}</span>
                </div>
                <div class="input_group_ville">
                    <label for="city">Ville <span class="required">*</span></label>
                    <input type="text" required id="ville" placeholder="La Ville De Bien" class="input" name="city"  value="{{$annonce->city}}">
                    <span class="error">{{ $errors->first('city') }}</span>
                </div>
                <div class="input_group_adresse">
                    <label for="address">Adresse <span class="required">*</span></label>
                    <input type="text" required id="adresse" placeholder="L'adresse de Bien" class="input" name="address"  value="{{$annonce->address}}">
                    <span class="error">{{ $errors->first('address') }}</span>
                </div>
                <div class="input_group">
                    <label for="map">Localisation (Google MAP)</label>
                    <input type="text" id="local" placeholder="La Localisation De Bien" class="input" name="map" value="{{$annonce->map}}">
                </div>
                <div class="input_group_select">
                    <label for="type">Type De Bien <span class="required">*</span></label>
                    <select name="type" required>
                        <option value="0" disabled>Ce Bien est pour?</option>
                        <option value="Vente" {{ $annonce->type == 'Vente' ? 'selected' : '' }}>Vendre</option>
                        <option value="Location" {{ $annonce->type == 'Location' ? 'selected' : '' }}>Louer</option>
                    </select>
                    <span class="error">{{ $errors->first('type') }}</span>
                </div>
                <div class="input_group_select">
                    <label for="category">Catégorie De Bien <span class="required">*</span></label>
                    <select name="category" required>
                        <option value="0" disabled>Choisir Une Catégorie</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{ $category->id == $annonce->category_id ? 'selected' : '' }}>{{$category->name}}</option>    
                        @endforeach
                    </select>
                    <span class="error">{{ $errors->first('category') }}</span>
                </div>
                <div class="input_group_select">
                    <label for="status">État Du Bien <span class="required">*</span></label>
                    <select name="status" required>
                        <option value="0" selected disabled>Choisir l'État</option>
                        <option value="Neuf" {{ $annonce->status == 'Neuf' ? 'selected' : '' }}>Neuf</option>
                        <option value="Occasion"  {{ $annonce->status == 'Occasion' ? 'selected' : '' }}>Occasion</option>
                        <option value="Vide"  {{ $annonce->status == 'Vide' ? 'selected' : '' }}>Vide</option>
                        <option value="Meublé"  {{ $annonce->status == 'Meublé' ? 'selected' : '' }}>Meublé</option>
                    </select>
                    <span class="error">{{ $errors->first('status') }}</span>
                </div>
                <div class="input_group_select">
                    <label for="annonceur">Annonceur De Bien <span class="required">*</span></label>
                    <select name="annonceur" required>
                        @foreach ($utilisateurs as $utilisateur)
                            <option value="{{$utilisateur->id}}" {{ $annonce->user_id == $utilisateur->id ? 'selected' : '' }}>{{$utilisateur->fname}} {{$utilisateur->lname}}</option>
                        @endforeach
                    </select>
                    <span class="error">{{ $errors->first('annonceur') }}</span>
                </div>
                <div class="input_group_nombre">
                    <label for="surface">Superficie <span class="required">*</span></label>
                    <input type="number" required placeholder="m²" class="input" name="surface" min="1" value="{{$annonce->surface}}">
                    <span class="error">{{ $errors->first('surface') }}</span>
                </div>
                <div class="input_group_nombre">
                    <label for="price">Prix <span class="required">*</span> </label>
                    <input type="number" required id="price" placeholder="en (Dhs)" class="input" name="price" min="1" value="{{$annonce->price}}">
                    <span class="error">{{ $errors->first('price') }}</span>
                </div>
                <div class="input_group_nombre">
                    <label for="bedroom">Chambres</label>
                    <input type="number" id="chambres" placeholder="Nombre" class="input" name="bedroom" min="0" value="{{$annonce->bedroom}}">
                    <span class="error">{{ $errors->first('bedroom') }}</span>
                </div>
                <div class="input_group_nombre">
                    <label for="bathroom">SDB</label>
                    <input type="number" id="titre" placeholder="Nombre" class="input" name="bathroom" min="0" value="{{$annonce->bathroom}}">
                    <span class="error">{{ $errors->first('bathroom') }}</span>
                </div>
                <div class="input_group_choix">
                    <label for="is_valid">Valide <span class="required">*</span></label>
                    <select name="is_valid" id="valid">
                        @if ($annonce->is_valid)
                            <option value="0">Non</option>
                            <option value="1" selected>Oui</option>
                        @else
                            <option value="0" selected>Non</option>
                            <option value="1">Oui</option>
                        @endif
                    </select>
                </div>
                <div class="input_group_choix">
                    <label for="is_premium">Premium <span class="required">*</span></label>
                    <select name="is_premium" id="premium" >
                        @if ($annonce->is_premium)
                            <option value="0">Non</option>
                            <option value="1" selected>Oui</option>
                        @else
                            <option value="0" selected>Non</option>
                            <option value="1">Oui</option>
                        @endif
                    </select>
                </div>         
                <div class="input_group_text">
                    <label for="description"> Description Bien </label>
                    <textarea  name="description" required class="desc" id="desc" rows="10"> {{$annonce->description}}</textarea>
                    <span class="error">{{ $errors->first('description') }}</span>
                </div>
                <button class="btn_ajouter">Modifier</button>
            </form>
        </div>
    </main>
    <script>
        ClassicEditor
            .create( document.querySelector('#desc'), {
                toolbar: [
                    'ckbox', '|', 'heading', '|', 'undo', 'redo', '|', 'bold', 'italic', '|',
                    'blockQuote', 'indent', '|', 'bulletedList', 'numberedList'
                ],
            })
            .catch( error => {
                console.error( error );
            } );
            $(function() {
                var availableCity = [
                    "Casablanca", "El Kelaa des Srarhna", "Fès", "Tangier", "Marrakech", "Sale", "Mediouna", "Rabat", "Meknès",
                    "Oujda-Angad", "Kenitra", "Agadir", "Tétouan", "Taourirt", "Temara", "Safi", "Khénifra", "Laâyoune", "Mohammedia",
                    "Kouribga", "El Jadid", "Béni Mellal", "Ait Melloul", "Nador", "Taza", "Settat", "Barrechid", "Al Khmissat", "Inezgane",
                    "Ksar El Kebir", "Larache", "Guelmim", "Berkane", "Khemis Sahel", "Ad Dakhla", "Bouskoura", "Al Fqih Ben Çalah", "Oued Zem",
                    "Sidi Slimane", "Errachidia", "Guercif", "Oulad Teïma", "Ben Guerir", "Sefrou", "Fnidq", "Sidi Qacem", "Moulay Abdallah",
                    "Youssoufia", "Martil", "Aïn Harrouda", "Skhirate", "Ouezzane", "Sidi Yahya Zaer", "Al Hoceïma", "M’diq", "Sidi Bennour",
                    "Midalt", "Azrou", "My Drarga", "Ain El Aouda", "Beni Yakhlef", "Ad Darwa", "Al Aaroui", "Qasbat Tadla", "Boujad", "Jerada",
                    "Mrirt", "El Aïoun", "Azemmour", "Temsia", "Zagora", "Ait Ourir", "Azilal", "Sidi Yahia El Gharb", "Biougra", "Zaïo", "Aguelmous",
                    "El Hajeb", "Zeghanghane", "Imzouren", "Tit Mellil", "Mechraa Bel Ksiri", "Al ’Attawia", "Demnat", "Arfoud", "Tameslouht", "Bou Arfa",
                    "Sidi Smai’il", "Souk et Tnine Jorf el Mellah", "Mehdya", "Aïn Taoujdat", "Chichaoua", "Tahla", "Oulad Yaïch", "Moulay Bousselham",
                    "Iheddadene", "Missour", "Zawyat ech Cheïkh", "Bouknadel", "Oulad Tayeb", "Oulad Barhil", "Bir Jdid", "Tifariti"
                ];

                $("#ville").autocomplete({
                    source: availableCity,
                    minLength: 2, 
                    delay: 100,
                    appendTo: ".form"
                });
            });
            $(document).ready(function () {
                $('#input_file').change(function () {
                    $('#uploaded_images').empty(); 
                    $.each(this.files, function (index, file) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('#uploaded_images').append('<img src="' + e.target.result + '" alt="">');
                        };
                        reader.readAsDataURL(file);
                    });
                });
            });  
    </script>
@endsection