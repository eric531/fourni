






<!DOCTYPE HTML>
<html>
<head>
<title>BSC | Répertoire des Forunisseurs agréés</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="BSC" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="{{asset('styles/css/bootstrap.css')}}" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="{{asset('styles/css/style.css')}}" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="{{asset('styles/css/font-awesome.css')}}" rel="stylesheet">
<!-- //font-awesome icons -->
 <!-- js-->
<script src="{{asset('styles/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('styles/js/modernizr.custom.js')}}"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts-->
<!--animate-->
<link href="{{asset('styles/css/animate.css')}}" rel="stylesheet" type="text/css" media="all">
<script src="{{asset('styles/js/wow.min.js')}}"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!-- chart -->
<script src="{{asset('styles/js/Chart.js')}}"></script>
<!-- //chart -->
<!--Calender-->
<link rel="stylesheet" href="{{asset('styles/css/clndr.css')}}" type="text/css" />
<script src="{{asset('styles/js/underscore-min.js')}}" type="text/javascript"></script>
<script src= "{{asset('styles/js/moment-2.2.1.js')}}" type="text/javascript"></script>
<script src="{{asset('styles/js/clndr.js')}}" type="text/javascript"></script>
<script src="{{asset('styles/js/site.js')}}" type="text/javascript"></script>
<!--End Calender-->
<!-- Metis Menu -->
<script src="{{asset('styles/js/metisMenu.min.js')}}"></script>
<script src="{{asset('styles/js/custom.js')}}"></script>
<link href="{{asset('styles/css/custom.css')}}" rel="stylesheet">
<!--//Metis Menu -->
</head>
<body class="cbp-spmenu-push" style="background:#003399;">
	<div class="main-content">



		<!-- main content start-->
		<div id="page-wrapper" style="background:#d3d3d3;padding-top:30px;">
			<div class="main-page login-page ">
				<h3 class="title1"><img style="height:80px;" src="{{asset('styles/uploads/logo.png')}}"></h3>
				<div class="widget-shadow">
					<div class="login-top">
						<h4>Bienvenue sur <a href="#">  BSC <br>Répertoire des Fournisseurs agréés</a> </h4>
					</div>
					<div class="login-body">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

							<input  type="text" class="user" name="email" placeholder="Enter your email" required="">
							<input   type="password" name="password" class="lock" placeholder="password">
							<input type="submit" value="Se connecter">
							<div class="forgot-grid">
								<label class="checkbox"><input type="checkbox" name="remember" checked=""><i></i>Se souvenir de moi</label>
								<div class="forgot">
									<a href="#"></a>
								</div>
								<div class="clearfix"> </div>
							</div>
					</form>
					</div>
				</div>

				<!--
				<div class="login-page-bottom">
					<h5> - OR -</h5>
					<div class="social-btn"><a href="#"><i class="fa fa-facebook"></i><i>Sign In with Facebook</i></a></div>
					<div class="social-btn sb-two"><a href="#"><i class="fa fa-twitter"></i><i>Sign In with Twitter</i></a></div>
				</div>
				-->
			</div>
		</div>
		<!--footer-->
		<div class="footer">
		<p>&copy; © 2022 BSC Logiciel Fournisseurs agréés -Tous droits réservés</p>
		</div>
        <!--//footer-->
	</div>
	<!-- Classie -->
		<script src="{{asset('styles/js/classie.js')}}"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;

			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};

			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!--scrolling js-->
	<script src="{{asset('styles/js/jquery.nicescroll.js')}}"></script>
	<script src="{{asset('styles/js/scripts.js')}}"></script>
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->
   <script src="{{asset('styles/js/bootstrap.js')}}"> </script>
</body>
</html>
