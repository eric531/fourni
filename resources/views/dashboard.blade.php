@extends('base.dashboard')

@section('content')

<!-- main content start -->
<div id="page-wrapper">
    <div class="main-page">
        <div class="row-one">
            <div class="col-md-4 widget">
                <div class="stats-left">
                    <h5>NOMBRE</h5>
                    <h4>FOURNISSEURS AGRÉÉS</h4>
                </div>
                <div class="stats-right">
                    <label>{{ $fourn_agree }}</label>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="col-md-4 widget states-mdl">
                <div class="stats-left">
                    <h5>NOMBRE</h5>
                    <h4>FOURNISSEURS PROSPECTS</h4>
                </div>
                <div class="stats-right">
                    <label>{{ $fourn_draft }}</label>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="col-md-4 widget states-last">
                <div class="stats-left">
                    <h5>NOMBRE DE</h5>
                    <h4>FOURNISSEURS BLACKLISTÉS</h4>
                </div>
                <div class="stats-right">
                    <label>{{ $fourn_blacklist }}</label>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
        </div>

        <div class="tables">
            <div class="table-responsive bs-example widget-shadow">
                <h4>Liste des fournisseurs</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>NOM ENTREPRISE</th>
                            <th>DOMAINE</th>
                            <th>CONTACTS</th>
                            <th>E-MAIL</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fournisseurs as $fourni)
                        <tr>
                            <td>{{ $fourni->entreprise }}</td>
                            <td>{{ $fourni->domaine_activites_1 }}</td>
                            <td>{{ $fourni->mobile }}</td>
                            <td>{{ $fourni->email }}</td>
                            <td>
                                <form action="{{ route('blacklist_set') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $fourni->id }}">
                                    <button type="submit" class="btn btn-primary">Liste noire</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="color: red;">Aucun fournisseur enregistré</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
