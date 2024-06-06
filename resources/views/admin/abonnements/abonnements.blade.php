


@extends('layouts.admin')

@section('content')
<div class="pd-20 card-box mb-30">
					<div class="clearfix mb-20">
						<div class="pull-left">
							<h4 class="text-blue h4">Abonnements</h4>

						</div>

					</div>
                    <div class="col d-flex justify-content-end align-items-end ">
                       <span class="col text-success success"></span>
                       <span class="col text-danger error"></span>
                    </div>
                    <div class="col d-flex justify-content-end align-items-end ">
                        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal">
                            Ajouter
                        </button>
                    </div>
                    @include('admin.abonnements.form')
					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Entreprise</th>
								<th scope="col">Debut</th>
                                <th scope="col">Fin</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
                            @foreach($abonnements as $abonnement)
							<tr>
								<th scope="row">{{$abonnement->id}}</th>
								<td>{{$abonnement->entreprise->nom}}</td>
								<td>{{$abonnement->start_date}}</td>
                                <td>{{$abonnement->end_date}}</td>
                                <td>
                                <div class="row ">
                            <button onclick="openModalForEdit({{ $abonnement->id }})" class="btn btn-warning mr-2"><i class="fa fa-edit"></i></button>
                            <form action="{{route('abonnements.destroy',['abonnement'=>$abonnement->id])}}" method="post">
                              @method('delete')
                              @csrf
                              <button type="submit"  class="btn btn-danger"><i class="fa fa-trash" ></i></button>
                            </form>


                            </div>


                          </td>
							</tr>
                            @endforeach

						</tbody>
					</table>
				</div>
                 <!-- Ajouter la pagination -->
    <div class="d-flex justify-content-center">
        {!! $abonnements->links() !!}
    </div>
@endsection
