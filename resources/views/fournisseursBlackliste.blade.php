@extends('base.dashboard')


@section('content')
<div id="page-wrapper" style=>


   
	<div class="main-page">


			<div class="main-page" style="margin-top: -50px;">>
			<div class="tables">
            <div class="table-responsive bs-example widget-shadow" style="border-radius:10px; padding:10px">
            <div class="row p7" style="display: flex;">
                <div class="col-md-8">
                <h4 style="color:#4f52ba;">
                    <b>Liste des fournisseurs blacklisté(s)</b>
                </h4>
                <em style="color:#4f52ba">Ces fournisseurs blacklistés sont sur la liste noire de l'entreprise <br>et ne peuvent plus être utilité pour une quelconque collaboration <br> en tant que  fournisseur blaclisté<em>
                </div>
                <div class="col-md-4 p3" style="display: flex;">
                <div>
                    <a href="{{route('draft_list')}}">
                    <button type="button"style="" class="btn btn-primary">FOURNISSEURS PROSPECT(S)</button>

                    </a>
                </div>
                &nbsp;
                <div>
                        <a href="{{route('fournisseur')}}">
                        <button type="button"style="background-color:#fff; color:#4f52ba;" class="btn btn-primary ">FOURNISSEURS AGREE(S)</button>

                        </a>
                </div>
                </div>
            </div>
    <form id="searchForm" method="POST" action="{{ route('search_fourn') }}">
        @csrf

        <div class="col-md-4">
            <div class="form-group"style="border-radius: 15px;">
                <input type="text" name="entreprise" class="form-control search-filter" id="exampleInputEmail3" placeholder="Entreprise">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group"style="border-radius: 15px;">
                <input type="text" name="search" class="form-control search-filter2" id="exampleInputEmail4" placeholder="Mot clé">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group"style="border-radius: 15px;">
                <input type="text" name="domaine" class="form-control search-filter3" id="exampleInputEmail5" placeholder="Domaine d'activité">
            </div>
        </div>
        
    </form>
    
                <div class="row">
                    <div class="col-md-3" style="display:flex;padding-bottom:5px">
                        <div>
                        <button type="button" class="btn btn-primary filter-btn">Filter Selection</button>

                        </div>
                        &nbsp;
                        <div>
                        <form id="exportExcelForm" method="POST" action="{{ route('export.excel') }}">
                            @csrf
                            <input type="hidden" name="selected_suppliers_ids" id="selectedSuppliersIdsExcel">
                            <button type="submit" class="btn btn-success export-excel-btn">Export to Excel</button>
                        </form>
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
               
        <br>

                <table class="table table-bordered">
                    <thead style="background-color: #4f52ba;color:#fff;">
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

                            @empty
                        <tr>
                            <td colspan="7" style="color: red;">Aucun fournisseur enregistré</td>
                        </tr>
                        @endforelse
						</tbody>
					
					</table>
               
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
