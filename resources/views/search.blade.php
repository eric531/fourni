@extends('base.dashboard')

@section('content')

@if(session('error'))
    <div style="color: red;">{{ session('error') }}</div>
@endif

@if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

<div id="page-wrapper">

    <div class="main-page">
        <div class="tables">
        
        <div class="table-responsive bs-example widget-shadow" style="background-color:#fff; border-radius:10px">
            <h4>Réchercher un fournisseur</h4><br>
            <div style="height: auto;background-color:#8080806b; color: #000; padding:5px; border-radius:10px">
            <form method="GET" action="{{ route('recherche') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6" style="background-color: #e94e02;border-radius:10px">
                            <center style="font-size: 18px; text-align: center; padding-top: 3px; color:#fff">
                                Rechercher un fournisseur agrée
                            </center>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group" style="border-radius:10px">
                                <input type="text" name="code_fournisseur" class="form-control" placeholder="code: FCIxxxxx0">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <button type="submit" class="btn" style="background-color: #4f52ba; color:#fff; border-radius:10px">Rechercher</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
                
                
</div>

                

                
            </div>
            
        </div>
    </div>
</div>






@if (isset($searchfournisseur) && !session('error'))
<div id="page-wrapper">
    @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <h1>Détails du fournisseur</h1>
    <div class="row">
            <div class="col-md-6 md:items-center ">
            <div class="notations">

            <table class="table table-striped table-paginate bordered table-responsive">
            <tr>
            <td><strong>RCCM : N° </strong> {{$searchfournisseur['rccm']}}</td>

            </tr>
            <tr>
            <td><strong>C/C : N° </strong>{{$searchfournisseur['cc']}}</td>

            </tr>
            <tr>
            <td><strong>DFE / Date création : </strong>{{$searchfournisseur['date_dfe']}}</td>

            </tr>
            <tr>
            <td><strong>Date de validité ARF :</strong>{{$searchfournisseur['validite_arf']}}</td>

            </tr>
            <tr>
            <td><strong>Date de validité CNPS :</strong>{{$searchfournisseur['validite_cnps']}}</td>

            </tr>
            <tr>
            <td><strong>Domaine activité :</strong>{{$searchfournisseur['domaine_activites_1']}}</td>

            </tr>
            <tr>
            <td><strong>Sous domaine activité :</strong>{{$searchfournisseur['sous_domaine']}}</td>

            </tr>
            <tr>
            <td><strong>Produits et services :</strong>{{$searchfournisseur['produits_services']}}</td>

            </tr>
        </table>

        </div>
        </div>


        <div class="col-md-6 gap-4 md:flex-row md:items-center md:justify-between">
        <div class="statut-content border-3 py-4 px-4">
            <h2 class="text-xl font-semibold leading-tight text-center ">Statut agrément {{date('Y')}}</h2>
            <hr>
            <div class="bloc-score">
                <div class="text-score">
                <strong>Score agrément : </strong>
            </div>
            <!-- <div id="progress-pie-chart" data-percent="25">
            <div class="ppc-progress">
            <div class="ppc-progress-fill"></div>
            </div>
            <div class="ppc-percents">
            <div class="pcc-percents-wrapper">
                <span class="my-value">%</span>
                </div>
            </div>
            </div> -->
            </div>
            <p> <strong>Statut :</strong>
                                        </p>
                                <p><strong>Label BSC : </strong> </p>

                            </div>
                            <p class="mt-4"> <strong>NB</strong> : Les statut délivré par BSC n'exclut pas vos propres contrôles et validations selon vos procédures internes. Les documents du fournisseur sont disponibles ci-dessous</p>


                            <p><strong>Email: </strong> {{ $searchfournisseur['email'] ?? 'Non disponible' }}</p>
                           <p><strong>Tel fixe: </strong>{{$searchfournisseur["fixe"] ?? 'Non disponible'}} </p>
                           <p><strong>Tel mobile: </strong>{{$searchfournisseur["mobile"] ?? 'Non disponible'}} </p>
                           <div class="col-md-12">
                                        @if($interlocuteurs)
                                            <table class="table table-striped table-bordered nowrap interloc" style="width:100%" id="tableau">
                                                <thead>
                                                      <th>Nom</th>
                                                      <th>Email</th>
                                                      <th>Contact</th>
                                                      <th>Fonction</th>
                                                </thead>
                                                <tbody>
                                                    @foreach($interlocuteurs as $interlocuteur)
                                                    <tr>
                                                        <td>{{$interlocuteur->interloc_nom}} </td>
                                                        <td>{{$interlocuteur->interloc_email}}  </td>
                                                        <td>{{$interlocuteur->interloc_contact}}  </td>
                                                        <td>{{$interlocuteur->interloc_fonction}}  </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    </div>


                        </div>
                        </div>


                        <form action="{{ route('draft_add') }}" method="POST">
                        @csrf
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

                            <button type="submit" class="btn btn-primary">Ajouter fournisseur</button>
                            </form>
                            @if (!isset($searchfournisseur) && !session('success') && !session('error'))
    <p>Le fournisseur n'a pas été trouvé.</p>
@endif
</div>

@endif


@endsection

