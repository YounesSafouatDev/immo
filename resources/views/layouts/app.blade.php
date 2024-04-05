<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <!-- Title -->
    <title>ExpertImmo - @yield('title')</title>
    <!-- Style Css -->
    <link rel="stylesheet" href="{{asset('assets/css/layout.css')}}" />
    @yield('style')
    <!-- Script -->
    <script src="/assets/js/index.js" defer></script>
    @yield('script')
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/b1fd037577.js" crossorigin="anonymous"></script>
    <!-- Jquery Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" 
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" 
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" 
        integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" 
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" 
        integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="header_top">
            <a href="/" class="logo">EXPERT<span class="second_part">IMMO</span></a>
            @guest
                <a href="{{route('deposer')}}" class="btn_annonce">Déposer Annonce </a>
            @else
                <a href="#" class="btn_annonce" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Déconnexion
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                    @csrf
                </form>
            @endguest
        </div>
        <nav class="navigation">
            <div class="navigation_links">
                <a href="{{route('accueil')}}" class="link">Accueil</a>
                <a href="{{route('biens')}}" class="link">Bien Immobilier</a>
                <a href="{{route('about')}}" class="link">A propos</a>
                <a href="{{route('contact')}}" class="link">Contact</a>
                <a href="{{route('articles.list')}}" class="link">Articles</a>
            </div>
            <div class="navigation_icons">
                <a href="#" id="search" class="link">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
                @guest
                    <a href="{{route('show_login')}}" class="link">
                        <i class="fa-regular fa-user"></i>
                    </a>
                @else
                    <a href="" class="link">
                        <i class="fa-regular fa-user"></i>
                    </a>
                @endguest
                
            </div>
            <a href="#" class="navigation_icon bars">
                <i class="fa-solid fa-bars link"></i>
            </a>
        </nav>
        <div class="menu">
            <div class="menu_links">
                <a href="#" class="x_close">
                    <i class="fa-solid fa-x link"></i>
                </a>
                <a href="{{route('accueil')}}" class="link">Accueil</a>
                <a href="{{route('biens')}}" class="link">Bien Immobilier</a>
                <a href="{{route('about')}}" class="link">A propos</a>
                <a href="{{route('contact')}}" class="link">Contact</a>
                <a href="{{route('articles.list')}}" class="link">Articles</a>
                <span class="user">
                    @guest
                        <a href="{{route('show_login')}}" class="link">Login</a>
                        <a href="{{route('show_register')}}" class="register">Register</a>
                    @else
                        <a href="" class="link">Profile</a>
                    @endguest
                    
                </span>
            </div>
        </div>
    </header>
    <!-- Section Search -->
    <section class="search">
        <div class="search_list">
            <h2 class="list_text">Rechercher une Propriété</h2>
            <a href="#" class="link" id="x_icon">
                <i class="fa-solid fa-x"></i>
            </a>
        </div>
        <form action="{{route('search')}}" class="search_form" method="POST">
            @csrf
            <div class="form_list">
                <div class="list">
                    <label for="ville">Ville</label>
                    <input type="text" name="ville" id="city" class="city" placeholder="Entrer la ville" />
                </div>
                <div class="list">
                    <label for="type">Type</label>
                    <select name="type" id="type" class="type">
                        <option value="0">Tous les Type</option>
                        <option value="Location">Louer</option>
                        <option value="Vendre">Vendre</option>
                    </select>
                </div>
            </div>
            <div class="form_list">
                <div class="list">
                    <label for="bien">Bien Immobilier</label>
                    <select name="bien" id="properties_type" class="properties_type">
                        <option value="0">Tous Les Biens</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form_list">
                <div class="list">
                    <label for="chambre">Chambres</label>
                    <select name="chambre" id="bed" class="bed">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">+5</option>
                    </select>
                </div>
                <div class="list">
                    <label for="sdb">SDB</label>
                    <select name="sdb" id="bath" class="bath">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">+5</option>
                    </select>
                </div>
            </div>
            <div class="form_list">
                <div class="list">
                    <label for="min">Min Prix</label>
                    <select name="min" id="min" class="min">
                        <option value="0">Illimité</option>
                        <option value="200000">200000 Dhs</option>
                        <option value="1000000">1000000 Dhs</option>
                        <option value="3000000">3000000 Dhs</option>
                        <option value="5000000">5000000 Dhs</option>
                    </select>
                </div>
            </div>
            <input type="submit" value="Chercher" id="btn_search" class="btn_search" />
        </form>
    </section>

    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="footer_about">
            <a href="{{route('accueil')}}" class="about_logo">EXPERTIMMO</a>
            <p class="about_description">
                ExpertImmo est votre nouveau site d'annonce 100 % 
                Immobilier où vous pouvez vendre et acheter vos biens Immobilier 
                rapidement et d'une manière sécurisé.
            </p>
            <div class="about_info">
                <a href="tel" class="info_tel">() 3797091790</a>
                <a href="mailto:" class="info_mail">test@gmail.com</a>
            </div>
        </div>
        <div class="footer_pages">
            <p class="pages_title">Pages</p>
            <a href="{{route('accueil')}}" class="pages_link">ACCEUIL</a>
            <a href="{{route('biens')}}" class="pages_link">BIEN IMMOBILIER</a>
            <a href="{{route('about')}}" class="pages_link">A PROPOS</a>
            <a href="{{route('contact')}}" class="pages_link">CONTACT</a>
            <a href="{{route('articles.list')}}" class="pages_link">ARTICLES</a>
        </div>
        <div class="footer_categories">
            <p class="categories_title">Catégories</p>
            @foreach ($categories as $category)
                <a href="{{route('biens',$category->id)}}" class="categories_link">{{$category->name}}</a>
            @endforeach
            
        </div>
        <div class="footer_social">
            <p class="social_title">Réseaux sociaux</p>
            <a href="" class="social_link">Facebook</a>
            <a href="" class="social_link">Instagram</a>
            <a href="" class="social_link">Tik Tok</a>
            <a href="" class="social_link">Threads</a>
            <a href="" class="social_link">Twitter</a>
        </div>
    </footer>
    <div class="under_footer">
        &copy; All rights are reserved, <a href="/" class="link">EXPERTIMMO</a> Designed By ExpertDeals
    </div>
</body>

</html>