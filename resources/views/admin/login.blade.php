
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{asset('/styles/css/login/bootstrap.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{asset('/styles/css/login/style.css')}}" type="text/css" />
	<!-- <link rel="stylesheet" href="{{asset('/styles/css/login/dark.css')}}" type="text/css" /> -->
	<link rel="stylesheet" href="{{asset('/styles/css/login/font-icons.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{asset('/styles/css/login/animate.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{asset('/styles/css/login/magnific-popup.css')}}" type="text/css" />

	<link rel="stylesheet" href="{{asset('/styles/css/login/responsive.css')}}" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Document Title
	============================================= -->
	<title>Admin | Gestion des Agréments Fournisseurs</title>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap nopadding">

				<div class="section nopadding nomargin" style="width: 100%; height: 100%; position: absolute; left: 0; top: 0; background: #ffff;"></div>

				<div class="section nobg full-screen nopadding nomargin">
					<div class="container-fluid vertical-middle divcenter clearfix">

						

						<div class="card divcenter noradius noborder" style="max-width: 400px;">
							<div class="card-body" style="padding: 40px;border:1px solid; border-radius:9px;box-shadow:0px 0px 5px 5px gray; border-color:#003399">
								<form id="login-form" name="login-form" class="nobottommargin" method="POST" action="{{ route('admin.login') }}">
                                @csrf
								<div class="center">
							<a href="index.html"><img src="{{asset('styles/uploads/logo.png')}}" alt="Logo-Bsc-agrement" style="height: 50px;"></a>
						</div>
			
                                    <span style='text-align:center; display:flex; justify-content:center'>Connectez vous en tant que &nbsp;<b>administrateur</b></span>
									<br>
									<hr>
									@if ($errors->any())
			<div class="alert alert-danger" style="height: 70px;">
				<ul class="list-unstyled">
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif

									<div class="col_full">
										<label for="login-form-username">Email <span style='color:red'>*</span>:</label>
										<input type="text" name="email" id="login-form-username" placeholder="Adresse E-mail"  name="email" class="form-control not-dark" />
									</div>

									<div class="col_full">
										<label for="login-form-password">Mot de passe <span style='color:red'>*</span>:</label>
										<input type="password" name="password" id="login-form-password" placeholder="Entrer mot de passe" value="" class="form-control not-dark" />
									</div>

									<div class="col_full nobottommargin">
										<button class="button button-3d button-black nomargin" type='submit' id="login-form-submit" value="login">Se connecter</button>
										<!-- <a href="#" class="fright">Forgot Password?</a> -->
									</div>
								</form>

								
			

								<!-- <div class="center">
									<h4 style="margin-bottom: 15px;">or Login with:</h4>
									<a href="#" class="button button-rounded si-facebook si-colored">Facebook</a>
									<span class="d-none d-md-block">or</span>
									<a href="#" class="button button-rounded si-twitter si-colored">Twitter</a>
								</div> -->
							</div>
						</div>

						<div class="center dark"><small>&copy; <span style="color:red">BSC - Business Supply Center </span> / {{date('Y')}} - V1.0 / -Tous droits réservés</small></div>
						<div class="center dark"><small><span>Développer par</span> <a style="color: red;" href="https://eso-dev.com">ESO-DEV</a> </small></div>

					</div>
				</div>

			</div>

		</section><!-- #content end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- External JavaScripts
	============================================= -->
	<script src="{{asset('/styles/js/login/jquery.js')}}"></script>
	<script src="{{asset('/styles/js/login/plugins.js')}}"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="{{asset('/styles/js/login/functions.js')}}"></script>

</body>
</html>