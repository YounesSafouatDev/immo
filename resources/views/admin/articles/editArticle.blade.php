@extends('layouts.admin')
@section('title','Modifier')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/admin/articles/aeArticle.css')}}">
@endsection
@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
@endsection

@section('main')
    <main>
        <h1 class="title">Modifier Article</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('dashboard')}}">Acceuil</a></li>
            <li class="divider">/</li>
            <li><a href="{{route('articles.index')}}">Articles</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Modifier Article</a></li>
            <li class="divider">/</li>
            <li>{{$article->id}}</li>
        </ul>
        <div class="images_articles" id="uploaded_images">
            @foreach ($article->images as $image)
                <img src="{{asset('storage/articles/'.$image->path)}}" alt="image Annonce {{$article->title}}">
            @endforeach
        </div>
        <div class="new_article">
            <form action="{{route('articles.update',$article->id)}}" method="post" class="form" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="input_group">
                    <label for="title">Titre Article</label>
                    <input type="text" id="title" placeholder="Un Titre Pour L'article" required  class="input" name="title" onchange="slugifyInput(this.value)" value="{{$article->title}}">
                    <span class="error">{{ $errors->first('title') }}</span>
                </div>
                <div class="input_group">
                    <label for="slug">Slug Article (Auto) </label>
                    <input type="text" id="slug" placeholder="Un Slug Pour L'article" required class="input" name="slug" value="{{$article->slug}}">
                    <span class="error">{{ $errors->first('slug') }}</span>
                </div>
                <div class="input_group">
                    <label for="images[]">Images</label>
                    <input type="file"  class="input_file" id="input_file" name="images[]" required multiple id="images" accept="image/jpeg,image/png,image/jpg,image/webp">
                    <span class="error">{{ $errors->first('images') }}</span>
                </div>
                <div class="input_group">
                    <label for="category">Catégorie</label>
                    <select name="category" id="category"  class="select_category">
                        <option value="0" selected disabled>Choisir Un Catégorie</option>
                        @foreach ($categories as $category ) 
                            @if ($category->id == $article->category_id)
                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                            @else
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <span class="error">{{ $errors->first('category') }}</span>
                </div>
                <div class="input_group_text">
                    <label for="description"> Contenu </label>
                    <textarea name="description" required class="desc" id="desc" rows="10">{{$article->description}}</textarea>
                    <span class="error">{{ $errors->first('description') }}</span>
                </div>
                <button class="btn_warning">Modifier</button>
            </form>
        </div>
    </main>
    <script>
        ClassicEditor
        .create(document.querySelector('#desc'), {
            toolbar: [
                'ckbox', '|', 'heading', '|', 'undo', 'redo', '|', 'bold', 'italic', '|',
                'blockQuote', 'indent', '|', 'bulletedList', 'numberedList'
            ],
        })
        .catch(error => {
            console.error(error);
        });
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