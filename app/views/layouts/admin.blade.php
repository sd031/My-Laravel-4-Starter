<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Website - Admin</title>
	<meta name="author" content="Author">
	<meta name="description" content="Description">

	<!-- Styles -->
	<link rel="stylesheet" href="{{ URL::asset('assets/css/vendor/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
	<style>
		body {
			padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
		}
	</style>

	<!-- Fav and touch icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="../assets/ico/favicon.png">

	<!-- Outdated browser message -->
	<link rel="stylesheet" type="text/css" media="screen" href="http://www.devslide.com/public/labs/browser-detection/browser-detection.css" />
	<script type="text/javascript" src="http://www.devslide.com/public/labs/browser-detection/browser-detection.js">
	<script type="text/javascript">
	<!--
		var noticeLang = "goofy";
		var displayPoweredBy = false;
		var notSupportedBrowsers = [{'os': 'Any', 'browser': 'MSIE', 'version': 6}, {'os': 'Any', 'browser': 'Firefox', 'version': 1}];
	// -->
	</script>
</head>
<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				@include('layouts._adminmenu')
			</div>
		</div>
	</div>

	<div class="container">
		@include('_flashmessages')

		@yield('content')

	</div> <!-- /container -->
	

	<!-- Scripts -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="{{ URL::asset('assets/js/vendor/jquery-1.9.1.min.js') }}"><\/script>')</script>
	<script src="{{ URL::asset('assets/js/vendor/bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/script.js') }}"></script>
	@yield('extra_js')

	<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
	<script>
		var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
		g.src='//www.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g,s)}(document,'script'));
	</script>
</body>
</html>