@extends('base.dashboard')


@section('content')
<div id="page-wrapper" style=>
					<div class="main-page">

			<div class="row" style="padding-top:15px;background:#ddd;  margin-bottom:20px; margin-top:50px;">

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
			<form method="GET" action="{{route('recherche')}}">

			@csrf
			<div class="col-md-6">
			<center style="font-size:18px; text-align:center;padding-top:3px;">
			Rechercher un fournisseur agrée
			</center>
			</div>

				<div class="col-md-3">
			<div class="form-group"> <input type="text" name="code_fournisseur" class="form-control" id="exampleInputEmail3" placeholder="code: FCIxxxxx0"> </div>
			</div>
				<div class="col-md-3">
			<div class="form-group">
			<button type="submit" class="form-group">Rechercher</button>
			</div>
			</div>
			</form>
			</div>



			</div>
			<div class="container">
			@if(session('error'))
        <div style=" color: red;">{{ session('error') }}</div>
    @endif
	@if(session('success'))
        <div style=" color: green;">{{ session('success') }}</div>
    @endif
    <h1>Détails du fournisseur</h1>

	@if (isset($searchfournisseur) && !session('error'))
	<h3>Ajouter un fournisseur</h3>

	<form action="{{route('ajouterfournisseurs')}}" method="POST">
		@csrf
        <p><strong>Nom du fournisseur:</strong> {{ isset($searchfournisseur['entreprise']) ? $searchfournisseur['entreprise'] : 'Non disponible' }}</p>
<p><strong>Domaine du fournisseur:</strong> {{ isset($searchfournisseur['domaine_activites_1']) ? $searchfournisseur['domaine_activites_1'] : 'Non disponible' }}</p>
<p><strong>Gmail du fournisseur:</strong> {{ isset($searchfournisseur['email']) ? $searchfournisseur['email'] : 'Non disponible' }}</p>
@if (isset($searchfournisseur['id']))
    <input type="hidden" name="fournisseur" value="{{ $searchfournisseur['id'] }}">
@else
    <input type="hidden" name="fournisseur" value="">
@endif
<input type="hidden" name="name" value="{{ isset($searchfournisseur['entreprise']) ? $searchfournisseur['entreprise'] : '' }}">
<input type="hidden" name="domaine" value="{{ isset($searchfournisseur['domaine_activites_1']) ? $searchfournisseur['domaine_activites_1'] : '' }}">
<input type="hidden" name="email" value="{{ isset($searchfournisseur['email']) ? $searchfournisseur['email'] : '' }}">

    <button type="submit" style="background-color: #007BFF; color: #fff; border: none; padding: 10px 20px; cursor: pointer;">
        Ajouter fournisseur
    </button>


</form>
@endif

@if (!isset($searchfournisseur) && !session('success') && !session('error'))
        <p>Le fournisseur n'a pas été trouvé.</p>
    @endif



</div>



		</div>
@endsection
