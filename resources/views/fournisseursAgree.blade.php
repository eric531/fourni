@extends('base.dashboard')


@section('content')
<div id="page-wrapper" style=>
					<div class="main-page">


			<div class="main-page">
			<div class="tables">
				<div class="table-responsive bs-example widget-shadow">
						<h4>Liste des fournisseurs agrées</h4>
					<table class="table table-bordered">
							<thead>
								<tr>
									 <th colspan="2">NOM ENTREPRISE</th>
									  <th>DOMAINE</th> <th>CONTACTS</th>
									   <th>E-MAIL</th> <th>Voir Fiche</th>
								</tr>
							</thead>



						@forelse ($fournisseurs as $fourni)
						<tbody>
							<tr>
								<th scope="row">
									<input type="checkbox">
                                        <td>{{$fourni->entreprise}}</td>
										<td>{{$fourni->domaine_activites_1}}</td>
										<td>{{$fourni->mobile}}</td>
										<td>{{$fourni->email}}</td>
									<td>
										<span class="badge badge-danger">Voir fiche</span>
									</td>

                                    <td>
										<form action="{{route('blacklist_set',['id'=>$fourn->id])}}" method="post">
                                            @method('_put')
                                            <button type="submit" class="btn btn-primary"> add to Blaclist</button>
                                        </form>
									</td>
							</tr>


						</tbody>
						@empty
							<span style="color: red;">aucun fournisseur enregistrer</span>
						@endforelse
					</table>
						<div class="row">
						<div class="col-md-3">
								<button type="submit" class="btn btn-primary" style="">Filtrer sélection</button>
						</div>
							<div class="col-md-3">
								<button type="submit" class="btn btn-primary" style="">Exporter PDF</button>
						</div>
						<div class="col-md-3">
								&nbsp;
						</div>
							<div class="col-md-3">
								<button type="submit" class="btn btn-primary" style="float:right;">Mailing list</button>
						</div>

						</div>
					</div>
			</div>
			</div>
		</div>
@endsection
