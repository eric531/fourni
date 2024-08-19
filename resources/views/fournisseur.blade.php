@extends('base.dashboard')

@section('content')


<div id="page-wrapper">
    

    <div class="main-page" style="margin-top: -50px;">
        <div class="tables">
        
            <div class="table-responsive bs-example widget-shadow" style="border-radius:10px; padding:10px">
            <div class="row p7" style="display: flex;">
                <div class="col-md-8">
                <h4 style="color:#4f52ba;">
                    <b>Liste des fournisseurs Agées</b>
                </h4>
                <em style="color:#4f52ba">Ces fournisseurs agrées peuvent être blacklisté <br> en tant que  fournisseur blaclisté<em>
                </div>
                <div class="col-md-4 p3" style="display: flex;">
                <div>
                    <a href="{{route('draft_list')}}">
                    <button type="button"style="" class="btn btn-primary">FOURNISSEURS PROSPECT(S)</button>

                    </a>
                </div>
                &nbsp;
                <div>
                        <a href="{{route('blacklist')}}">
                        <button type="button"style="background-color:#fff; color:#4f52ba;" class="btn btn-primary ">FOURNISSEURS BLACKLISTE(S)</button>

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
                            <th>SELCTION</th>
                            <th>NOM ENTREPRISE</th>
                            <th>DOMAINE</th>
                            <th>CONTACTS</th>
                            <th>E-MAIL</th>
                            <th>VOIR FICHE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fournisseurs as $fourni)
                        <tr>
                            <td><input type="checkbox" name="selected_suppliers[]" value="{{ $fourni->id }}" data-email="{{ $fourni->email }}"></td>
                            <td>{{ $fourni->entreprise }}</td>
                            <td>{{ $fourni->domaine_activites_1 }}</td>
                            <td>{{ $fourni->mobile }}</td>
                            <td>{{ $fourni->email }}</td>
                            <td><span class="badge badge-danger">Voir fiche</span></td>
                            <td>
                                <form action="{{ route('blacklist_set') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $fourni->id }}">
                                    <button type="submit" class="btn btn-primary">Liste noire</button>
                                    <div class="form-check form-switch">

                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label>
                                    </div>
                                </form>
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
    document.addEventListener('DOMContentLoaded', function() {
        var searchForm = document.getElementById('searchForm');
        var searchBtn = document.querySelector('.search-btn');
        var mailingBtnEmail = document.querySelector('.mailing-btn-email');
        var mailingBtnEmailList = document.querySelector('.mailing-btn-email-list');
        var exportExcelForm = document.getElementById('exportExcelForm');

        searchBtn.addEventListener('click', function(event) {
            event.preventDefault();
            var formData = new FormData(searchForm);
            filterSearch(formData.get('search'), formData.get('domaine'), formData.get('entreprise'));
        }, true);

        ['search-filter', 'search-filter2', 'search-filter3'].forEach(function(className) {
            document.querySelector('.' + className).addEventListener('input', function(event) {
                event.preventDefault();
                var formData = new FormData(searchForm);
                filterSearch(formData.get('search'), formData.get('domaine'), formData.get('entreprise'));
            }, true);
        });

        function filterSearch(searchTerm, domaine, entreprise) {
            var payload = {
                search: searchTerm,
                entreprise: entreprise,
                domaine: domaine
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '{{ route('search_fourn') }}',
                data: payload,
                timeout: 5000,
                success: function(data) {
                    console.log('SUCCESS', data.response);
                    var tableBody = document.querySelector('table tbody');
                    tableBody.innerHTML = '';

                    if (data.response.length > 0) {
                        data.response.forEach(function(fourni) {
                            var newRow = tableBody.insertRow();
                            newRow.innerHTML = `
                                <td><input type="checkbox" name="selected_suppliers[]" value="${fourni.id}" data-email="${fourni.email}"></td>
                                <td>${fourni.entreprise}</td>
                                <td>${fourni.domaine_activites_1}</td>
                                <td>${fourni.mobile}</td>
                                <td>${fourni.email}</td>
                                <td><span class="badge badge-danger">Voir fiche</span></td>
                                <td>
                                    <form action="{{ route('blacklist_set') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="${fourni.id}">
                                        <button type="submit" class="btn btn-primary">Add to Blacklist</button>
                                    </form>
                                </td>
                            `;
                        });
                    } else {
                        tableBody.innerHTML = '<tr><td colspan="7">Aucun résultat trouvé</td></tr>';
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX Error:', textStatus, errorThrown);
                }
            });
        }

        mailingBtnEmail.addEventListener('click', function(event) {
            event.preventDefault();
            var selectedSuppliers = document.querySelectorAll('input[name="selected_suppliers[]"]:checked');
            var emails = Array.from(selectedSuppliers).map(function(checkbox) {
                return checkbox.dataset.email;
            });

            if (emails.length > 0) {
                var mailtoLink = 'mailto:' + emails.join(',') + '?subject=Subject&body=Body';
                window.location.href = mailtoLink;
            } else {
                alert('Veuillez sélectionner au moins un fournisseur.');
            }
        }, true);

        mailingBtnEmailList.addEventListener('click', function(event) {
            event.preventDefault();
            var selectedSuppliers = document.querySelectorAll('input[name="selected_suppliers[]"]:checked');
            var emails = Array.from(selectedSuppliers).map(function(checkbox) {
                return checkbox.dataset.email;
            });

            if (emails.length > 0) {
                var emailList = emails.join(';');
                alert('Liste des emails sélectionnés:\n' + emailList);
            } else {
                alert('Veuillez sélectionner au moins un fournisseur.');
            }
        }, true);

        document.querySelector('.export-excel-btn').addEventListener('click', function(event) {
            event.preventDefault();
            var selectedSuppliers = document.querySelectorAll('input[name="selected_suppliers[]"]:checked');
            var ids = Array.from(selectedSuppliers).map(function(checkbox) {
                return checkbox.value;
            });

            if (ids.length > 0) {
                document.getElementById('selectedSuppliersIdsExcel').value = ids.join(',');
                exportExcelForm.submit();
            } else {
                alert('Veuillez sélectionner au moins un fournisseur.');
            }
        });
    });

</script>

@endsection
