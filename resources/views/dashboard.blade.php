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
			
			
			
			</div>
			
			
			<div class="main-page">
				<div class="row-one">
					<div class="col-md-4 widget states-last">
						<div class="stats-left ">
							<h5>Nombre de fournisseurs</h5>
							<h4>Agréés</h4>
						</div>
						<div class="stats-right">
							<label> {{$fournisseur->count()}}</label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="col-md-4 widget states-mdl">
						<div class="stats-left">
								<h5>Mes fournisseurs</h5>
							<h4>Top liste</h4>
						</div>
						<div class="stats-right">
							<label> {{$fourn_user->count()}}</label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="col-md-4 widget states-last">
						<div class="stats-left"  style="background-color:rgba(42,156,80,1);">
							<h5>Nombre de </h5>
							<h4>Domaines</h4>
						</div>
						<div class="stats-right" style="background-color:rgba(42,156,80,0.8);">
							<label>5</label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="clearfix"> </div>	
				</div>
				
				<div class="row calender widget-shadow">
					<h4 class="title">Calendrier</h4>
					<div class="cal1">
						
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
@endsection