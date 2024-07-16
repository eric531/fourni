@extends('base.dashboard')


@section('content')
<div id="page-wrapper" style=>

     <span><br></span>

        <form id="searchForm" method="POST" action="{{ route('search_fourn') }}">

		@csrf


        	<div class="col-md-3">
			<div class="form-group">
				<input type="text" name="entreprise" class="form-control search-filter" id="exampleInputEmail3" placeholder="Entreprise">
			</div>
		</div>
        	<div class="col-md-3">
			<div class="form-group">
				<input type="text" name="search" class="form-control search-filter" id="exampleInputEmail3" placeholder="Mot clé">
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<input type="text" name="domaine" class="form-control search-filter" id="exampleInputEmail3" placeholder="Domaine d'activité">
			</div>
		</div>


		<div class="col-md-3">

			<div class="form-group">
            <button type="button" class="form-group btn-primary ">Rechercher</button>
			</div>

		</div>

		</form>
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
                    <div class="row">
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary  mailing-btn" style="">Filter Selection</button>


					    </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary  mailing-btn" style="">Export to PDF</button>

						</div>
						<div class="col-md-3">
                            <a href="{{ route('export.draft') }}" class="btn btn-success">Export to Excel</a>

						</div>
						<div class="col-md-3">
								&nbsp;
						</div>
							<div class="col-md-3">
                                <input type="hidden" name="selected_suppliers_ids" id="selectedSuppliersIds">

								<button type="submit" class="btn btn-primary  mailing-btn" style="">Mailing to</button>
                                <button type="submit" class="btn btn-primary" style="float:right;">Mailing list</button>
						</div>



						</div>
					</div>
                    {!! $fournisseurs->links() !!}
			</div>
			</div>
		</div>



        <script>
    var searchfilter = document.querySelector('.search-filter');
    var searchfilter2 = document.querySelector('.search-filter2');
    var searchfilter3 = document.querySelector('.search-filter3');
    var searchbtn = document.querySelector('.search-btn');
    var form = document.getElementById('searchForm');

    searchbtn.addEventListener('click', function (event) {
      event.preventDefault();
      var formData = new FormData(form);
      filterSearch(formData.get('search'),formData.get('domaine'),formData.get('entreprise'));
   }, true);

    searchfilter.addEventListener('input', function (event) {
      event.preventDefault();
      var formData = new FormData(form);
      filterSearch(formData.get('search'),formData.get('domaine'),formData.get('entreprise'));
   }, true);

 searchfilter2.addEventListener('input', function (event) {
      event.preventDefault();
      var formData = new FormData(form);
      filterSearch(formData.get('search'),formData.get('domaine'),formData.get('entreprise'));
   }, true);

    searchfilter3.addEventListener('input', function (event) {
      event.preventDefault();
      var formData = new FormData(form);
      filterSearch(formData.get('search'),formData.get('domaine'),formData.get('entreprise'));
   }, true);
   function filterSearch(searchTerm,domaine,entreprise) {
      var payload = {
        "search": searchTerm,
        "entreprise": entreprise,
        "domaine": domaine,
      }

      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': '<?php echo csrf_token(); ?>'
         }
      });

      $.ajax({
         type: 'POST',
         dataType: "json",
         url: "{{ route('search_draft') }}",
         data: payload,
         timeout: 5000,
         success: function (data) {
            console.log("SUCCESS", data.response);
            // Remplacez le contenu du tableau avec les données de la réponse AJAX
            // Vous devrez probablement ajuster cette partie en fonction de la structure des données retournées.
            var tableBody = document.querySelector('table tbody');
            tableBody.innerHTML = '';

            if (data.response.length > 0) {
               data.response.forEach(function (fourni) {
                  var newRow = tableBody.insertRow();
                  newRow.innerHTML = `
                     <td><input type="checkbox"></td>
                     <td>${fourni.entreprise}</td>
                     <td>${fourni.domaine_activites_1}</td>
                     <td>${fourni.mobile}</td>
                     <td>${fourni.email}</td>
                     <td><span class="badge badge-danger">Voir fiche</span></td>
                     <td>
                        <form action="{{ route('blacklist_set') }}" method="post">
                           @csrf
                           <input type="hidden" name="id" value="${fourni.id}">
                           <button type="submit" class="btn btn-primary"> add to Blaclist</button>
                        </form>
                     </td>
                  `;
               });
            } else {
               tableBody.innerHTML = '<tr><td colspan="7">Aucun résultat trouvé</td></tr>';
            }
         },
        //  error: function (data) {
        //     console.error("ERROR...", data)
        //     alert("Something went wrong.")
        //  },
        error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error:", textStatus, errorThrown);
            },
      });
   }
</script>
@endsection
