@extends('layouts.admin')
@section('title','Ajouter Article')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/admin/articles/aeArticle.css')}}">
@endsection
@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
@endsection
@section('main')
    
    <main>
        <h1 class="title">Nouveau Article</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('dashboard')}}">Acceuil</a></li>
            <li class="divider">/</li>
            <li><a href="{{route('articles.index')}}">Articles</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Nouveau Article</a></li>
        </ul>
        
        <div class="new_article">
            <form action="{{route('articles.store')}}" method="post" class="form" enctype="multipart/form-data">
                @csrf
                <div class="input_group">
                    <label for="title">Titre Article</label>
                    <input type="text" id="title" placeholder="Un Titre Pour L'article" required  class="input" name="title" onchange="slugifyInput(this.value)" value="{{old('title')}}">
                    <span class="error">{{ $errors->first('title') }}</span>
                </div>
                <div class="input_group">
                    <label for="slug">Slug Article (Auto) </label>
                    <input type="text" id="slug" placeholder="Un Slug Pour L'article" required readonly class="input" name="slug" value="{{old('slug')}}">
                    <span class="error">{{ $errors->first('slug') }}</span>
                </div>
                <div class="input_group">
                    <label for="images[]">Images</label>
                    <input type="file"  class="input_file" id="input_file" name="images[]" required multiple id="images" >
                    <span class="error">{{ $errors->first('images') }}</span>
                </div>
                <div class="input_group">
                    <label for="category">Catégorie</label>
                    <select name="category" id="category"  class="select_category">
                        <option value="0" selected disabled>Choisir Un Catégorie</option>
                        @foreach ($categories as $category ) 
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <span class="error">{{ $errors->first('category') }}</span>
                </div>
                <div class="input_group_text">
                    <label for="description"> Contenu </label>
                    <textarea  name="description" required class="desc" id="desc" rows="10"> {{old('description')}}</textarea>
                    <span class="error">{{ $errors->first('description') }}</span>
                </div>
                <button class="btn_ajouter">Ajouter</button>
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
    </script>
    <script>
       function slugifyInput(str) {
            str = str.replace(/^\s+|\s+$/g, ''); // trim
            str = str.toLowerCase();
            var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
            var to   = "aaaaeeeeiiiioooouuuunc------";
            for (var i=0, l=from.length ; i<l ; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }
            str = str.replace(/[^a-z0-9 -]/g, '') 
                    .replace(/\s+/g, '-') 
                    .replace(/-+/g, '-');

            str = "Art-" + str.slice(0,3) + "-" + Date.now();
            
            document.getElementById("slug").value = str;
        }
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.getElementById('section_message').style.display = 'none';
            }, 20000); 
        });
    </script>

@endsection