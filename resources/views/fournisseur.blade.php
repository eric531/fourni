@extends('base.dashboard')


@section('content')
<div id="page-wrapper" style=>
					<div class="main-page">
					
			<!-- <div class="row" style="padding-top:15px;background:#ddd;  margin-bottom:20px; margin-top:50px;">
			
			<form>
			<div class="col-md-3"> 
			<center style="font-size:18px; text-align:center;padding-top:3px;">
			Rechercher 
			</center>
			</div>
				<div class="col-md-3"> 
			<div class="form-group"> 
			<select style="padding-top:0px;padding-bottom:0px;height:34px;" name="selector1" id="selector1" class="form-control1">
			<option>Domaine</option>
										<option>Informatique</option>
										<option>Electricité</option>
										<option>BTP</option>
			
			</select></div> 
			</div>
				<div class="col-md-3"> 
			<div class="form-group"> <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Mot clé"> </div> 
			</div>
				<div class="col-md-3"> 
			<div class="form-group">
			<input type="submit" value="OK Lancer" class="btn btn-primary">
			</div>
			</div>
			</form>
			</div>
			
			
			<div class="row" style="background:#ddd; margin-bottom:20px;">
			<br>
			<form>
			<div class="col-md-6"> 
			<center style="font-size:18px; text-align:center;padding-top:3px;">
			Recherche par nom de produit ou service
			</center>
			</div>
		
				<div class="col-md-3"> 
			<div class="form-group"> <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Nom du produit ou service"> </div> 
			</div>
				<div class="col-md-3"> 
			<div class="form-group">
			<input type="submit" value="OK Lancer" class="btn btn-primary">
			</div>
			</div>
			</form>
			</div>
			
			
			
			</div> -->
			
			<div class="main-page">
			<div class="tables">
				<div class="table-responsive bs-example widget-shadow">
						<h4>Liste des fournisseurs</h4>
					<table class="table table-bordered">
							<thead>
								<tr>
									 <th colspan="2">NOM ENTREPRISE</th>
									  <th>DOMAINE</th> <th>CONTACTS</th>
									   <th>E-MAIL</th> <th>Voir Fiche</th>
								</tr>
							</thead> 
							
							<!-- <form action="{{ route('ajouterfournisseurs') }}" method="POST">
    @csrf
    @foreach ($fournisseurs as $fournisseur)
        <input type="checkbox" name="fournisseurs[]" value="{{ $fournisseur->id }}">
        {{ $fournisseur->name }}
        <br>
    @endforeach
    <button type="submit">Ajouter les fournisseurs sélectionnés</button>
</form> -->

						@forelse ($fournisseurs as $fourni)
						<tbody>
							<tr> 
								<th scope="row">
									<input type="checkbox">
										<td>{{$fourni->name}}</td>
										<td>{{$fourni->domaine}}</td> 
										<td>{{$fourni->contact}}</td> 
										<td>{{$fourni->email}}</td>
									<td>
										<span class="badge badge-danger">Voir fiche</span>
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