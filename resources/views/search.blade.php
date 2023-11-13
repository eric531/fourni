@extends('base.dashboard')


@section('content')

	<div id="page-wrapper" style=>

    @if(session('error'))
            <div style=" color: red;">{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div style=" color: green;">{{ session('success') }}</div>
        @endif

        <h1>Détails du fournisseur</h1>


            <h3>Ajouter un fournisseur</h3>
		<form method="GET" action="{{route('recherche')}}">

		@csrf
		<div class="col-md-6" style=" background-color:orange;" >
			<center style="font-size:18px; text-align:center;padding-top:3px;">
			Rechercher un fournisseur agrée
			</center>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				<input type="text" name="code_fournisseur" class="form-control" id="exampleInputEmail3" placeholder="code: FCIxxxxx0">
			</div>
		</div>

		<div class="col-md-3">

			<div class="form-group">
				<button type="submit" class="form-group">Rechercher</button>
			</div>

		</div>

		</form>
        @if (isset($searchfournisseur) && !session('error'))
		<div class="main-page">


			<div class="main-page">
			<div class="tables">
				<div class="table-responsive bs-example widget-shadow">
						<h4>Liste des fournisseurs</h4>
                        <form action="{{ route('draft_add') }}" method="POST">
        @csrf

        <p>
            <strong>Nom du fournisseur:</strong> {{ isset($searchfournisseur['entreprise']) ? $searchfournisseur['entreprise'] : 'Non disponible' }}
        </p>
        <p>
            <strong>Domaine du fournisseur:</strong> {{ isset($searchfournisseur['domaine_activites_1']) ? $searchfournisseur['domaine_activites_1'] : 'Non disponible' }}
        </p>
        <p>
            <strong>Gmail du fournisseur:</strong> {{ isset($searchfournisseur['email']) ? $searchfournisseur['email'] : 'Non disponible' }}
        </p>
        <p>
            <strong>Mobile:</strong> {{ isset($searchfournisseur['mobile']) ? $searchfournisseur['mobile'] : 'Non disponible' }}
        </p>
        <p>
            <strong>Fixe:</strong> {{ isset($searchfournisseur['fixe']) ? $searchfournisseur['fixe'] : 'Non disponible' }}
        </p>
        <p>
            <strong>rccm:</strong> {{ isset($searchfournisseur['rccm']) ? $searchfournisseur['rccm'] : 'Non disponible' }}
        </p>
        <p>
            <strong>cc:</strong> {{ isset($searchfournisseur['cc']) ? $searchfournisseur['cc'] : 'Non disponible' }}
        </p>
        <p>
            <strong>date_dfe:</strong> {{ isset($searchfournisseur['date_dfe']) ? $searchfournisseur['date_dfe'] : 'Non disponible' }}
        </p>
        <p>
            <strong>situation_geo:</strong> {{ isset($searchfournisseur['situation_geo']) ? $searchfournisseur['situation_geo'] : 'Non disponible' }}
        </p>
        <p>
            <strong>sous_domaine:</strong> {{ isset($searchfournisseur['sous_domaine']) ? $searchfournisseur['sous_domaine'] : 'Non disponible' }}
        </p>
        <p>
            <strong>produits_services:</strong> {{ isset($produits_services->produits_services) ? $produits_services->produits_services : 'Non disponible' }}
        </p>
        <p>
            <strong>validite_arf:</strong> {{ isset($searchfournisseur['validite_arf']) ? $searchfournisseur['validite_arf'] : 'Non disponible' }}
        </p>
        <p>
            <strong>validite_cnps:</strong> {{ isset($searchfournisseur['validite_cnps']) ? $searchfournisseur['validite_cnps'] : 'Non disponible' }}
        </p>
        <p>
            <strong>interlocuteur:</strong>
            <p>{{ $interlocuteur->interloc_nom }}</p>
            <p>{{ $interlocuteur->interloc_fonction }}</p>
            <p>{{ $interlocuteur->interloc_contact }}</p>
            <p>{{ $interlocuteur->interloc_email }}</p>
        </p>
        <p>
            <strong>status:</strong> {{ $searchfournisseur['status'] == 1 ? 'Vrai' : 'Faux' }}
        </p>

        @if (isset($searchfournisseur['id']))
            <input type="hidden" name="id" value="{{ $searchfournisseur['id'] }}">
            <input type="hidden" name="entreprise" value="{{ $searchfournisseur['entreprise'] }}">
            <input type="hidden" name="domaine_activites_1" value="{{ $searchfournisseur['domaine_activites_1'] }}">
            <input type="hidden" name="email" value="{{ $searchfournisseur['email'] }}">
            <input type="hidden" name="mobile" value="{{ $searchfournisseur['mobile'] }}">
            <input type="hidden" name="fixe" value="{{ $searchfournisseur['fixe'] }}">
            <input type="hidden" name="rccm" value="{{ $searchfournisseur['rccm'] }}">
            <input type="hidden" name="cc" value="{{ $searchfournisseur['cc'] }}">
            <input type="hidden" name="date_dfe" value="{{ $searchfournisseur['date_dfe'] }}">
            <input type="hidden" name="situation_geo" value="{{ $searchfournisseur['situation_geo'] }}">
            <input type="hidden" name="produits_services" value="{{ $searchfournisseur['produits_services'] }}">
            <input type="hidden" name="validite_arf" value="{{ $searchfournisseur['validite_arf'] }}">
            <input type="hidden" name="validite_cnps" value="{{ $searchfournisseur['validite_cnps'] }}">
            <input type="hidden" name="interloc_nom" value="{{ $interlocuteur->interloc_nom }}">
            <input type="hidden" name="interloc_fonction" value="{{ $interlocuteur->interloc_fonction }}">
            <input type="hidden" name="interloc_contact" value="{{ $interlocuteur->interloc_contact }}">
            <input type="hidden" name="interloc_email" value="{{ $interlocuteur->interloc_email }}">
            <input type="hidden" name="status" value="{{ $searchfournisseur['status'] }}">


        @else
            <input type="hidden" name="fournisseur" value="">
        @endif

        <button type="submit" class="btn btn-primary">
            Ajouter fournisseur
        </button>
    </form>
			</div>
            @endif

@if (!isset($searchfournisseur) && !session('success') && !session('error'))
    <p>Le fournisseur n'a pas été trouvé.</p>
@endif
			</div>
		</div>
@endsection
