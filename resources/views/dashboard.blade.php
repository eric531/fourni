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
			<form method="POST" action="{{route('recherche')}}">

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
    <h1>Détails du fournisseur</h1>
	

	
</div>
			
		

		</div>
@endsection