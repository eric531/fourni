@extends('base.dashboard')


@section('content')
<div id="page-wrapper" style=>
					<div class="main-page">


			<div class="main-page">
			<div class="tables">
				<div class="table-responsive bs-example widget-shadow">
						<h4>Liste des Prostpects</h4>
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
										<form action="{{route('ajouterfournisseurs')}}" method="post">
                                            @csrf
											<input type="hidden" name="id" value="{{ $fourni->id }}">
                                            <input type="hidden" name="entreprise" value="{{ $fourni->entreprise }}">
                                            <input type="hidden" name="domaine_activites_1" value="{{ $fourni->domaine_activites_1 }}">
                                            <input type="hidden" name="email" value="{{ $fourni->email }}">
                                            <input type="hidden" name="mobile" value="{{ $fourni->mobile }}">
                                            <input type="hidden" name="fixe" value="{{ $fourni->fixe }}">
                                            <input type="hidden" name="rccm" value="{{ $fourni->rccm }}">
                                            <input type="hidden" name="cc" value="{{ $fourni->cc }}">
                                            <input type="hidden" name="date_dfe" value="{{ $fourni->date_dfe }}">
                                            <input type="hidden" name="situation_geo" value="{{ $fourni->situation_geo }}">
                                            <input type="hidden" name="produits_services" value="{{ $fourni->produits_services }}">
                                            <input type="hidden" name="validite_arf" value="{{ $fourni->validite_arf }}">
                                            <input type="hidden" name="validite_cnps" value="{{ $fourni->validite_cnps}}">
                                            <input type="hidden" name="interloc_nom" value="{{ $fourni->interloc_nom }}">
                                            <input type="hidden" name="interloc_fonction" value="{{ $fourni->interloc_fonction }}">
                                            <input type="hidden" name="interloc_contact" value="{{ $fourni->interloc_contact }}">
                                            <input type="hidden" name="interloc_email" value="{{ $fourni->interloc_email }}">
                                            <input type="hidden" name="status" value="{{ $fourni->status }}">
                                            <button type="submit" class="btn btn-primary">Ajouter</button>
                                        </form>
									</td>
							</tr>


						</tbody>
						@empty
							<span style="color: red;">aucun fournisseur enregistrer</span>
						@endforelse
					</table>
						
			</div>
			</div>
		</div>
@endsection
