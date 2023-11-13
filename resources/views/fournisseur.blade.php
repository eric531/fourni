@extends('base.dashboard')


@section('content')

	<div id="page-wrapper" style=>
        <span><br></span>

        <form id="searchForm" method="POST" action="{{ route('search_fourn') }}">

		@csrf
		<div class="col-md-6" style=" background-color:orange;" >

		</div>

		<div class="col-md-3">
			<div class="form-group">
				<input type="text" name="search" class="form-control" id="exampleInputEmail3" placeholder="domaine">
			</div>
		</div>

		<div class="col-md-3">

			<div class="form-group">
            <button type="button" class="form-group btn-primary search-filter">Rechercher</button>
			</div>

		</div>

		</form>

		<div class="main-page">


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
										<form action="{{route('blacklist_set')}}" method="post">
                                            @csrf
                                           <input type="hidden" name="id" value="{{$fourni->id}}">
                                            <button type="submit" class="btn btn-primary"> add to Blaclist</button>
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



        <script>
   var btn = document.querySelector('.search-filter');
   var form = document.getElementById('searchForm');

   btn.addEventListener('click', function (event) {
      event.preventDefault(); 
      var formData = new FormData(form);
      filterSearch(formData.get('search'));
   }, true);

   function filterSearch(searchTerm) {
      var payload = {
         "search": searchTerm,
      }

      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': '<?php echo csrf_token(); ?>'
         }
      });

      $.ajax({
         type: 'POST',
         dataType: "json",
         url: "{{ route('search_fourn') }}",
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
