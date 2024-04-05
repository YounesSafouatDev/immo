<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv="X-UA-Compatible" content="IE=7">
	<link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/b1fd037577.js" crossorigin="anonymous"></script>
	<!-- Jquery Link -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" 
			integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" 
			crossorigin="anonymous" referrerpolicy="no-referrer">
		</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" 
			integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" 
			crossorigin="anonymous" referrerpolicy="no-referrer">
		</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" 
			integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" 
			crossorigin="anonymous" referrerpolicy="no-referrer" />
    </script>
    @yield('style')
    @yield('script')
	<link rel="stylesheet" href="{{asset('assets/css/admin/admin.css')}}">
    <script src="{{asset('assets/js/script.js')}}" defer></script>
	<title>Annonceur - @yield('title')</title>
</head>
<body>
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand"><i class='bx bxs-home icon'></i>EXPERTIMMO</a>
		<ul class="side-menu">
			<li><a href="#" class="active"><i class='bx bxs-dashboard icon' ></i> Tableau de Bord</a></li>
			<li>
				<a href="#"><i class='bx bxs-notepad icon' ></i> Annonce <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="{{route('annonceur.index')}}">Tous</a></li>
					<li><a href="{{route('annonceur.premium')}}">Premium</a></li>
					<li><a href="{{route('annonceur.create')}}">Ajouter</a></li>
					<li><a href="{{route('annonceur.trash')}}">Corbeille</a></li>
				</ul>
			</li>
			
			<li>
				<a href="#"><i class='bx bxs-message-square-dots icon'></i> Message <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="{{route('message.messages')}}">Tous</a></li>
					<li><a href="{{route('message.trash')}}">Corbeille</a></li>
				</ul>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->

	<!-- NAVBAR -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu toggle-sidebar' ></i>
			<form action="#">
				<div class="form-group">
					<input type="text" placeholder="Chercher Utilisateur...">
					<i class='bx bx-search icon' ></i>
				</div>
			</form>
			<span class="divider"></span>
			<div class="profile">
				<img src="{{asset('assets/images/avatar.png')}}" alt="profile annonceur">
				<ul class="profile-link">
					<li><a href="{{route('profile.edit',auth()->user()->id)}} "><i class='bx bxs-user-circle icon'></i> Profil</a></li>
					<li>
                        <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class='bx bxs-log-out-circle'></i> Déconnexion
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                        @csrf
                    </form>
				</ul>
			</div>
		</nav>
        @yield('main')
    </section>
	<!-- NAVBAR -->
	
</body>
</html>