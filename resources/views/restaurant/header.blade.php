<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Restaurant</title>
<!-- Css -->
	
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
	<!-- Media css -->
	<link rel="stylesheet" href="{{ url('css/media.css')}}">
	<!-- Main css -->
	<link rel="stylesheet" href="{{ url('css/home.css')}}">
	<!-- Font GentiumBookBasic -->
	<link href="https://fonts.googleapis.com/css?family=Gentium+Book+Basic" rel="stylesheet">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ url('css/font-awesome.css')}}">
<!-- JS -->
	<!-- Jquery 3.2.1 -->
	<script src="{{ url('js/jquery-3.2.1.min.js') }}"></script>

	<!-- JS scroll to div -->
	<script src="{{ url('js/scroll.js') }}"></script>

	<!-- Boostrap js -->
	<script src="{{ url('js/bootstrap.min.js') }}"></script>
	
	{{-- Masony --}}
	
	<meta name="_token" content="{!! csrf_token() !!}" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<script src="js/masonry.pkgd.min.js"></script>
	<script>
		$(document).ready(function(){
			$('.section_menu').masonry({
			  // options
			  itemSelector: '.menu',
			});

		});
	</script>

</head>
<body>
<header>
	<div class="container">
		<div class="row">
			<div id="promo">
				<!-- menu header -->
				<div class="cover_menu_head">
					<div class="menu-header">
						<div class="col-lg-228 col-md-3">
							<a class="logo" href=""><img src="images/logo.png" alt="" ></a>
						</div>
						<div class="col-lg-772 col-md-9">
							<ul class="menu-bar">
							@if (isset($menuTop))
								@foreach ($menuTop as $list)
								<li><a href="#">{{ ucwords($list->name)}}</a></li>
								@endforeach
							@else
								<li><a href="#">Home</a></li>
							@endif
								{{-- <li><a href="#">About</a></li>
								<li><a href="#">Ingredients</a></li>
								<li><a href="#">Menu</a></li>
								<li><a href="#">Reviews</a></li>
								<li><a href="#">Reversions</a></li> --}}
								<li class="menu-icons"><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li class="menu-icons"><a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								<li class="menu-icons"><a href=""><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- Title -->
				<div class="slogan_head">
					<h1>the right ingredients for the right food</h1>
				</div>

				<!-- devider -->
				<div class="text-center">
					<img src="images/devider.png" alt="" class="devider">
				</div>

				<!-- button -->
				<div class="button_top">
					<button type="button" class="button-black">BOOK A TABLE</button>
					<button type="button" class="button-white">SEE THE MENU</button>
				</div>
			</div>
		</div>
	</div>	
</header>