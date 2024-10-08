
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{asset('css/login/bootstrap.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{asset('css/login/style.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{asset('css/login/dark.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{asset('css/login/font-icons.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{asset('css/login/animate.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{asset('css/login/magnific-popup.css')}}" type="text/css" />

	<link rel="stylesheet" href="{{asset('css/login/responsive.css')}}" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Document Title
	============================================= -->
	<title>Login - Layout 4 | Canvas</title>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap nopadding">

				<div class="section nopadding nomargin" style="width: 100%; height: 100%; position: absolute; left: 0; top: 0; background: #444;"></div>

				<div class="section nobg full-screen nopadding nomargin">
					<div class="container-fluid vertical-middle divcenter clearfix">

						<div class="center">
							<a href="index.html"><img src="{{asset('styles/uploads/logo.png')}}" alt="Logo-Bsc-agrement"></a>
						</div>

						<div class="card divcenter noradius noborder" style="max-width: 400px;">
							<div class="card-body" style="padding: 40px;">
								<form id="login-form" name="login-form" class="nobottommargin" method="POST" action="{{ route('login') }}">
                                @csrf
                                    <h3>Connectez vous à votre compte</h3>

									<div class="col_full">
										<label for="login-form-username">Email:</label>
										<input type="text" name="email" id="login-form-username" name="email value="" class="form-control not-dark" />
									</div>

									<div class="col_full">
										<label for="login-form-password">Password:</label>
										<input type="password" name="password" id="login-form-password" value="" class="form-control not-dark" />
									</div>

									<div class="col_full nobottommargin">
										<button class="button button-3d button-black nomargin" type='submit' id="login-form-submit" value="login">Se connecter</button>
										<!-- <a href="#" class="fright">Forgot Password?</a> -->
									</div>
								</form>

								<div class="line line-sm"></div>

								<!-- <div class="center">
									<h4 style="margin-bottom: 15px;">or Login with:</h4>
									<a href="#" class="button button-rounded si-facebook si-colored">Facebook</a>
									<span class="d-none d-md-block">or</span>
									<a href="#" class="button button-rounded si-twitter si-colored">Twitter</a>
								</div> -->
							</div>
						</div>

						<div class="center dark"><small>Copyrights &copy; 2022 BSC Logiciel Fournisseurs agréés -Tous droits réservés</small></div>

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
	<script src="{{asset('js/login/jquery.js')}}"></script>
	<script src="{{asset('js/login/plugins.js')}}"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="{{asset('js/login/functions.js')}}"></script>

</body>
</html>