@extends('base.dashboard')

@section('content')

<!-- main content start -->
<div id="page-wrapper">
    <div class="main-page">
        <div class="row-one">
            <div class="col-md-3 widget" style="width: 220px;height: 100px;">
                <div class="stats-left">
                    <h6 style="color:#fff">TOTAL</h6>
                    <br>
                    <h5>FOURNISSEURS AGRÉÉS</h5>
                </div>
                <div class="stats-right">
                    <label>{{ $fourn_agree }}</label>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="col-md-3 widget states-mdl"style="width: 220px;height: 100px;">
                <div class="stats-left">
                    <h6 style="color:#fff">TOTAL</h6><br>
                    <h5>FOURNISSEURS PROSPECTS</h5>
                </div>
                <div class="stats-right">
                    <label>{{ $fourn_draft }}</label>
                </div>
                
            </div>
            <div class="col-md-3 widget states-last"style="width: 220px;height: 100px;">
                <div class="stats-left">
                    <h6 style="color:#fff">TOTAL</h6> <br>
                    <h5>FOURNISSEURS BLACKLISTÉS</h5>
                </div>
                <div class="stats-right">
                    <label>{{ $fourn_blacklist }}</label>
                </div>
                <div class="clearfix"> </div>
            </div>

            <div class="col-md-3 widget states-mdl"style="width: 220px;height: 100px;">
                <div class="stats-left">
                    <h6 style="color:#fff">TOTAL</h6> <br>
                    <h5>COMMANDE ENREGISTREES</h5>
                </div>
                <div class="stats-right">
                    <label>0</label>
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
