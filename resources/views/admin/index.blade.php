
@extends('layouts.admin')

@section('content')
<div class="main-container">
			<div class="xs-pd-20-10 pd-ltr-20">
				<div class="title pb-20">
					<!-- <h2 class="h3 mb-0">Hospital Overview</h2> -->
				</div>

				<div class="row pb-10">
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark">{{$abonnementsNbr}}</div>
									<div class="font-14 text-secondary weight-500">
										Abonnements
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#09cc06">
										<i class="icon-copy ti-rss-alt"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark">{{$entreprisesNbr}}</div>
									<div class="font-14 text-secondary weight-500">
										Entreprises
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#ff5b5b">
										<span class="icon-copy ti-home"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark">{{$abonnementsActif}}</div>
									<div class="font-14 text-secondary weight-500">
										Abonnements actif
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#09cc06">
										<i
											class="icon-copy ti-credit-card"
											aria-hidden="true"
										></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark">{{$abonnementsInactif}}</div>
									<div class="font-14 text-secondary weight-500">Abonnements inactif</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="red">
										<i class="icon-copy ti-credit-card" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="card-box pb-10">
					<div class="h5 pd-20 mb-0">Liste des Abonnements</div>
					<table class="data-table table nowrap">
						<thead>
                            <tr>
								<th scope="col">#</th>
								<th scope="col">Entreprise</th>
								<th scope="col">Debut</th>
                                <th scope="col">Fin</th>
								
							</tr>
						</thead>
						<tbody>
                        @foreach($abonnements as $abonnement)
							<tr>
								<th scope="row">{{$abonnement->id}}</th>
								<td>{{$abonnement->entreprise->nom}}</td>
								<td>{{$abonnement->start_date}}</td>
                                <td>{{$abonnement->end_date}}</td>

							</tr>
                        @endforeach
						</tbody>
					</table>
				</div>




			</div>
		</div>

	@endsection
