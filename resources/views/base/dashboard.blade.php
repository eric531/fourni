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
			<div class="logo" style="position:absolute;left:70px" >
					<a href="#">
						<h1>
							<img  style="height: 30px;width:30px" src="{{ asset('storage/' . $logo) }}" alt="logo">
						</h1>
					</a>
				</div> <br> <br><hr><br>
    <ul class="nav" id="side-menu">

        <li >
            <a href="{{ route('dashboard') }}" class="{{ Request::is('dashboard') ? 'active' : '' }}"><i class="fa fa-home nav_icon"></i>Tableau de bord</a>
        </li>
        <li >
            <a href="{{ route('recherche_view') }}" class="{{ Request::is('search_page') ? 'active' : '' }}"><i class="fa fa-search nav_icon"></i>Ajouter nouveau fournisseur</a>
        </li>

        <li>
            <a href="{{ route('fournisseur') }}"  class="{{ Request::is('fournisseurAgree') ? 'active' : '' }}"><i class="fa fa-table nav_icon"></i>Liste des fournisseurs agrées</a>
        </li>

        <li >
            <a href="{{ route('draft_list') }}" class="{{ Request::is('fournisseurProspect') ? 'active' : '' }}"><i class="fa  fa-user nav_icon"></i>Liste des fournisseurs prospects</a>
        </li>
        <!-- <li >
            <a href="#" ><i class="fa fa-edit nav_icon"></i>Evaluation fournisseur</a>
        </li> -->
        <li >
            <a href="{{ route('blacklist') }}" class="{{ Request::is('fournisseurBlackliste') ? 'active' : '' }}"><i class="fa fa-ban nav_icon"></i>Liste des fournisseurs blacklistés</a>
        </li>


    </ul>
	
    <div class="logo " style="background:#fff; position:absolute; top:290px; height:200px; bottom: 100px;">
    <a href="#" style="position:absolute; bottom:0; width:100%;">
        <h1 style="margin:0;"><img style="background:#fff; height:60px; width:auto;" src="{{asset('styles/uploads/logo.png')}}" alt="Logo"></h1>
    </a>
</div>
</nav>

			</div>
		</div>
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		<div class="sticky-header header-section" style="background-color: #f1f1f1;">
		<h1 style="font-size: 35px; position:absolute; left:310px; top: 18px;font-family:sans-serif; color:#80808082"><b>Gestion des Agréments Fournisseurs</b></h1>
			<div class="header-left" style="background-color: #4f52ba;">
				<!--toggle button start-->
				<button id="showLeftPush" style="background-color: #4f52ba;color:#fff"><i class="fa fa-bars"></i></button>
				
				
				
			</div>
			

			<div class="header-right">
			
				<div class="search-box" style="font-weight:bold;border-radius:15px">
				
					<i class="fa fa-search" style="position: absolute; top:10px; left:3px; ; color:#4f52ba12;"></i><input type="text" class="form-control search-filter" id="exampleInputEmail3" placeholder="search">

				</div>

				<!--notification menu end -->
				<div class="profile_details">
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">
									<span class="prfil-img"><img src="{{asset('styles/images/user.png')}}" style="height:60px; width:60px;border-radius:100%;" alt=""> </span>
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
		<!-- <div class="footer">
		   <p>&copy; © 2022 BSC Logiciel Fournisseurs agréés -Tous droits réservés</p>
		</div> -->
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
