@extends('base.dashboard')


@section('content')
<style>
        /* Styles pour la carte */
        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9; /* Couleur de fond de la carte */
        }

        /* Styles pour les éléments du formulaire */
        .card p {
            margin: 10px 0;
        }

        .card strong {
            font-weight: bold;
        }

        /* Styles pour le bouton */
        .card button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
<div id="page-wrapper" style=>
		<div class="main-page">

			<div class="row" style="padding-top:15px;background:#ddd;  margin-bottom:20px; margin-top:50px;">


			</div>


			<div class="row" style="background:#ddd; margin-bottom:20px;">

				<br>
				<form method="GET" action="{{route('recherche')}}">

					@csrf
					<div class="col-md-6">
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

			</div>



		</div>

		<div class="container">

			@if(session('error'))
				<div style=" color: red;">{{ session('error') }}</div>
			@endif

			@if(session('success'))
				<div style=" color: green;">{{ session('success') }}</div>
			@endif

			<h1>Détails du fournisseur</h1>

			@if (isset($searchfournisseur) && !session('error'))
				<h3>Ajouter un fournisseur</h3>

				<!-- <form action="{{route('ajouterfournisseurs')}}" method="POST">
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
						<strong>rccm:</strong> {{ isset($searchfournisseur['mobilrccme']) ? $searchfournisseur['rccm'] : 'Non disponible' }}
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
                        <p>{{$interlocuteur->interloc_nom}}</p>
                        <p>{{$interlocuteur->interloc_fonction}}</p>
                        <p>{{$interlocuteur->interloc_contact}}</p>
                        <p>{{$interlocuteur->interloc_email}}</p>

					</p>
                    <p>
						<strong>status:</strong> {{ $searchfournisseur['status']==1? 'Vrai': 'Faux'  }}
					</p>

					@if (isset($searchfournisseur['id']))
						<input type="hidden" name="fournisseur" value="{{ $searchfournisseur['id'] }}">
					@else
						<input type="hidden" name="fournisseur" value="">
					@endif

					<button type="submit" style="background-color: #007BFF; color: #fff; border: none; padding: 10px 20px; cursor: pointer;">
							Ajouter fournisseur
					</button>


				</form> -->

                <div class="card">
        <form action="{{ route('ajouterfournisseurs') }}" method="POST">
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
                <input type="hidden" name="fournisseur" value="{{ $searchfournisseur['id'] }}">
            @else
                <input type="hidden" name="fournisseur" value="">
            @endif

            <button type="submit">
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
