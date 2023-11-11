@extends('base.dashboard')


@section('content')

	<!-- main content start-->
    <div id="page-wrapper">
			<div class="main-page">
				<div class="row-one">
					<div class="col-md-4 widget">
						<div class="stats-left ">
							<h5>NOMBRE</h5>
							<h4>FOURNISSEURS AGREES</h4>
						</div>
						<div class="stats-right">
							<label> {{$fourn_agree}}</label>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="col-md-4 widget states-mdl">
						<div class="stats-left">
							<h5>NOMBRE</h5>
							<h4>FOURNISSEURS PROSPECTS</h4>
						</div>
						<div class="stats-right">
							<label> {{$fourn_draft}}</label>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="col-md-4 widget states-last">
						<div class="stats-left">
							<h5>NOMBRE DE</h5>
							<h4>FOURNISSEURS BLACKLISTES</h4>
						</div>
						<div class="stats-right">
							<label>{{$fourn_blacklist}}</label>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="clearfix"> </div>
				</div>

                
				<div class="row">
					<div class="col-md-4 stats-info widget ">
						<div class="stats-title">
							<h4 class="title">5 domaines les plus fourni</h4>
						</div>
						<div class="stats-body">
							<ul class="list-unstyled">
								<li>GoogleChrome <span class="pull-right">85%</span>
									<div class="progress progress-striped active progress-right">
										<div class="bar green" style="width:85%;"></div>
									</div>
								</li>
								<li>Firefox <span class="pull-right">35%</span>
									<div class="progress progress-striped active progress-right">
										<div class="bar yellow" style="width:35%;"></div>
									</div>
								</li>
								<li>Internet Explorer <span class="pull-right">78%</span>
									<div class="progress progress-striped active progress-right">
										<div class="bar red" style="width:78%;"></div>
									</div>
								</li>
								<li>Safari <span class="pull-right">50%</span>
									<div class="progress progress-striped active progress-right">
										<div class="bar blue" style="width:50%;"></div>
									</div>
								</li>
								<li>Opera <span class="pull-right">80%</span>
									<div class="progress progress-striped active progress-right">
										<div class="bar light-blue" style="width:80%;"></div>
									</div>
								</li>
								<li class="last">Others <span class="pull-right">60%</span>
									<div class="progress progress-striped active progress-right">
										<div class="bar orange" style="width:60%;"></div>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-md-8 stats-info stats-last widget-shadow">
						<div class="stats-title">
							<h4 class="title">5 domaines les moins fourni</h4>
						</div>
						<div class="stats-body">
							<ul class="list-unstyled">
								<li>GoogleChrome <span class="pull-right">85%</span>
									<div class="progress progress-striped active progress-right">
										<div class="bar green" style="width:85%;"></div>
									</div>
								</li>
								<li>Firefox <span class="pull-right">35%</span>
									<div class="progress progress-striped active progress-right">
										<div class="bar yellow" style="width:35%;"></div>
									</div>
								</li>
								<li>Internet Explorer <span class="pull-right">78%</span>
									<div class="progress progress-striped active progress-right">
										<div class="bar red" style="width:78%;"></div>
									</div>
								</li>
								<li>Safari <span class="pull-right">50%</span>
									<div class="progress progress-striped active progress-right">
										<div class="bar blue" style="width:50%;"></div>
									</div>
								</li>
								<li>Opera <span class="pull-right">80%</span>
									<div class="progress progress-striped active progress-right">
										<div class="bar light-blue" style="width:80%;"></div>
									</div>
								</li>
								<li class="last">Others <span class="pull-right">60%</span>
									<div class="progress progress-striped active progress-right">
										<div class="bar orange" style="width:60%;"></div>
									</div>
								</li>
							</ul>
						</div>
					<div class="clearfix"> </div>
				</div>
@endsection
