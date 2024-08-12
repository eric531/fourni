@extends('base.dashboard')


@section('content')
<div id="page-wrapper" style=>
<span><br></span>

   
	<div class="main-page">


			<div class="main-page">
			<div class="tables">
				<div class="table-responsive bs-example widget-shadow">
						<h4>Fournisseurs blacklistés</h4>
                  <div style="height: 100px;background-color:#8080806b; color: #000; padding:5px; border-radius:10px">
            <em>Cette section est réservée pour afficher la liste des fournisseurs blacklistés<em><br><br>

    <form id="searchForm" method="POST" action="{{ route('search_fourn') }}">
        @csrf

        <div class="col-md-3">
            <div class="form-group"style="border-radius: 15px;">
                <input type="text" name="entreprise" class="form-control search-filter" id="exampleInputEmail3" placeholder="Entreprise">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group"style="border-radius: 15px;">
                <input type="text" name="search" class="form-control search-filter2" id="exampleInputEmail4" placeholder="Mot clé">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group"style="border-radius: 15px;">
                <input type="text" name="domaine" class="form-control search-filter3" id="exampleInputEmail5" placeholder="Domaine d'activité">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group"style="border-radius: 15px;">
                <button type="button" class="form-group btn btn-primary search-btn">Rechercher</button>
            </div>
        </div>
    </form>
    
        </div>
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

							</tr>


						</tbody>
						@empty
							<span style="color: red;">aucun fournisseur enregistrer</span>
						@endforelse
					</table>
               <div class="row">
                    <div class="col-md-3" style="display: flex;padding-bottom:5px">
                        <div>
                        <button type="button" class="btn btn-primary filter-btn">Filter Selection</button>

                        </div>
                        &nbsp;
                        <div>
                            <a href="{{ route('export.blacklist') }}" class="btn btn-success">Export to Excel</a>

						      </div>
                    </div>

                    
                   
                    <div class="col-md-9" style="display:flex;">
                        <div>
                        <button type="button" class="btn btn-primary mailing-btn-email">Mailing to</button>
                        </div>
                        &nbsp;
                        <div>
                        <button type="submit" class="btn btn-primary mailing-btn-email-list" style="float:right;">Mailing list</button>

                        </div>
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
         url: "{{ route('search_blacklist') }}",
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
