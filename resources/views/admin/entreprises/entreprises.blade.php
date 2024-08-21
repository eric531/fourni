


@extends('layouts.admin')

@section('content')
<div class="main-container">
<div class="pd-20 card-box mb-30">
					<div class="clearfix mb-20">
						<div class="pull-left">
							<h4 class="text-blue h4">Entreprises</h4>

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
                    @include('admin.entreprises.form')
					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Nom</th>
								<th scope="col">Adresse</th>
                                <th scope="col">Email</th>
								<th scope="col">Telephone</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
                            @foreach($entreprises as $entreprise)
							<tr>
								<th scope="row">{{$entreprise->id}}</th>
								<td>{{$entreprise->nom}}</td>
								<td>{{$entreprise->adresse}}</td>
                                <td>{{$entreprise->email}}</td>
                                <td>{{$entreprise->telephone}}</td>
                                <td>
                                <div class="row ">
                            <button onclick="openModalForEdit({{ $entreprise->id }})" class="btn btn-warning mr-2"><i class="fa fa-edit"></i></button>
                            <form action="{{route('entreprises.destroy',['entreprise'=>$entreprise->id])}}" method="post">
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
        {!! $entreprises->links() !!}
    </div>
</div>
@endsection
