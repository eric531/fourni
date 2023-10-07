@extends('base.dashboard')


@section('content')
<div id="page-wrapper" style=>
					<div class="main-page">
					
			
			
			
			
			
			</div>
			<!-- <div class="container">
    <h1>Détails du fournisseur</h1>
	

	
</div> -->
			
<div class="container">
    <h1>Détails du fournisseur</h1>
	<form action="{{route('ajouterfournisseurs')}}" method="post">
		

        <input type="text" class="form-control" name="fournisseurs[]" value="{{ $fournisseur->name }}">
        <input type="text" class="form-control" name="fournisseurs[]" value="{{ $fournisseur->domaine }}">
        <input type="text" class="form-control" name="fournisseurs[]" value="{{ $fournisseur->email }}">
      
        <br>
        <button type="submit">ajouter</button>
	</form>

	
</div>

		</div>


@endsection()