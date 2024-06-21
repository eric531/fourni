@extends('base.dashboard')

@section('content')

<div id="page-wrapper">
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
                <input type="text" name="search" class="form-control search-filter2" id="exampleInputEmail4" placeholder="Mot clé">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="text" name="domaine" class="form-control search-filter3" id="exampleInputEmail5" placeholder="Domaine d'activité">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <button type="button" class="form-group btn-primary search-btn">Rechercher</button>
            </div>
        </div>
    </form>

    <div class="main-page">
        <div class="tables">
            <div class="table-responsive bs-example widget-shadow">
                <h4>Liste des fournisseurs</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2">NOM ENTREPRISE</th>
                            <th>DOMAINE</th>
                            <th>CONTACTS</th>
                            <th>E-MAIL</th>
                            <th>Voir Fiche</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fournisseurs as $fourni)
                        <tr>
                            <th scope="row">
                                <td><input type="checkbox" name="selected_suppliers[]" value="{{ $fourni->id }}" data-email="{{ $fourni->email }}"></td>
                                <td>{{$fourni->entreprise}}</td>
                                <td>{{$fourni->domaine_activites_1}}</td>
                                <td>{{$fourni->mobile}}</td>
                                <td>{{$fourni->email}}</td>
                                <td><span class="badge badge-danger">Voir fiche</span></td>
                                <td>
                                    <form action="{{route('blacklist_set')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$fourni->id}}">
                                        <button type="submit" class="btn btn-primary"> liste noir</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="color: red;">aucun fournisseur enregistrer</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary mailing-btn">Filter Selection</button>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary mailing-btn">Export to PDF</button>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('export.excel') }}" class="btn btn-success">Export to Excel</a>
                    </div>
                    <div class="col-md-3">
                        &nbsp;
                    </div>
                    <div class="col-md-3">
                        <input type="hidden" name="selected_suppliers_ids" id="selectedSuppliersIds">
                        <button type="button" class="btn btn-primary mailing-btn-email">Mailing to</button>
                        <button type="submit" class="btn btn-primary" style="float:right;">Mailing list</button>
                    </div>
                </div>
            </div>
            {!! $fournisseurs->links() !!}
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var searchFilter = document.querySelector('.search-filter');
        var searchFilter2 = document.querySelector('.search-filter2');
        var searchFilter3 = document.querySelector('.search-filter3');
        var searchBtn = document.querySelector('.search-btn');
        var form = document.getElementById('searchForm');

        searchBtn.addEventListener('click', function(event) {
            event.preventDefault();
            var formData = new FormData(form);
            filterSearch(formData.get('search'), formData.get('domaine'), formData.get('entreprise'));
        }, true);

        searchFilter.addEventListener('input', function(event) {
            event.preventDefault();
            var formData = new FormData(form);
            filterSearch(formData.get('search'), formData.get('domaine'), formData.get('entreprise'));
        }, true);

        searchFilter2.addEventListener('input', function(event) {
            event.preventDefault();
            var formData = new FormData(form);
            filterSearch(formData.get('search'), formData.get('domaine'), formData.get('entreprise'));
        }, true);

        searchFilter3.addEventListener('input', function(event) {
            event.preventDefault();
            var formData = new FormData(form);
            filterSearch(formData.get('search'), formData.get('domaine'), formData.get('entreprise'));
        }, true);

        function filterSearch(searchTerm, domaine, entreprise) {
            var payload = {
                "search": searchTerm,
                "entreprise": entreprise,
                "domaine": domaine,
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $.ajax({
                type: 'POST',
                dataType: "json",
                url: "{{ route('search_fourn') }}",
                data: payload,
                timeout: 5000,
                success: function(data) {
                    console.log("SUCCESS", data.response);
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
                                        <button type="submit" class="btn btn-primary"> add to Blaclist</button>
                                    </form>
                                </td>
                            `;
                        });
                    } else {
                        tableBody.innerHTML = '<tr><td colspan="7">Aucun résultat trouvé</td></tr>';
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX Error:", textStatus, errorThrown);
                },
            });
        }

        document.querySelector('.mailing-btn-email').addEventListener('click', function(event) {
            event.preventDefault();
            var selectedSuppliers = document.querySelectorAll('input[name="selected_suppliers[]"]:checked');
            var emails = Array.from(selectedSuppliers).map(function(checkbox) {
                return checkbox.dataset.email;
            });

            if (emails.length > 0) {
                var mailtoLink = 'mailto:' + emails.join(',') + '?subject=Subject&body=Body';
                window.location.href = mailtoLink;
            } else {
                alert("Veuillez sélectionner au moins un fournisseur.");
            }
        }, true);
    });
</script>

@endsection
