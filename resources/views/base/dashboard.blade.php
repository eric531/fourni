<!DOCTYPE HTML>
<html>
<head>
	<title>BSC | Logiciel</title>
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
	<script src="js/Chart.js"></script>
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

<body class="cbp-spmenu-push">
	<div class="main-content">
		<!--left-fixed -navigation-->
		<div class=" sidebar" role="navigation">
            <div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
					<ul class="nav" id="side-menu">
						<li>
							<a href="{{route('dashboard')}}" class="active"><i class="fa fa-home nav_icon"></i>Tableau de bord</a>
						</li>

						<li>
							<a href="{{route('fournisseur')}}" class="active"><i class="fa fa-table nav_icon"></i>Liste des fournisseurs agrées</a>
						</li>

						<li>
							<a href="{{route('draft_list')}}" class="active"><i class="fa fa-table nav_icon"></i>Liste des fournisseurs prospects</a>
						</li>

						<li>
							<a href="{{route('blacklist')}}" class="active"><i class="fa fa-table nav_icon"></i>Liste des fournisseurs blacklistés</a>
						</li>

						
					</ul>
					<!-- //sidebar-collapse -->
				</nav>
			</div>
		</div>
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				<!--toggle button start-->
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
				<!--logo -->
				<div class="logo" style="background:#fff;" >
					<a href="index.html">
						<h1><img style="background:#fff;height:60px;" src="{{asset('styles/uploads/logo.png')}}"></h1>

					</a>
				</div>
				<!--//logo-->
				<!--search-box-->


				<div class="search-box" style="font-weight:bold; padding-top:15px; font-size:13px;">

				</div><!--//end-search-box-->
				<div class="clearfix"> </div>
			</div>
			
			<div class="header-right">
				
				<!--notification menu end -->
				<div class="profile_details">
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">
									<span class="prfil-img"><img src="{{asset('styles/uploads/nhavila.png')}}" style="height:60px; width:60px;border-radius:100%;" alt=""> </span>
									<div class="user-name">
										<p>N'havila</p>
                                        <span>{{$user}}</span>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>
								</div>
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li> <a href="#"><i class="fa fa-cog"></i> Paramètres</a> </li>
								<li> <a href="#"><i class="fa fa-user"></i> Profil</a> </li>
								<li>

								<form action="{{route('logout')}}" method="post">
                @csrf
                <button><i class="icon-power mr-2"></i> Logout</button>
        </form>							</form>
								</li>

							</ul>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="clearfix"> </div>
		</div>
		<!-- //header-ends -->
		<!-- main content start-->


    @yield('content')
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
