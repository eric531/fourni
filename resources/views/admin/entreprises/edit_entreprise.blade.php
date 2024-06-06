@extends('layouts.admin')

@section('content')

<div class="pd-20 card-box mb-30">

<form method="POST" action="{{ route('entreprises.store') }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
          <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Nom de l'entreprise</label>
            <div class="col-sm-12 col-md-10">
              <input class="form-control" type="text" placeholder="Nom de l'entreprise" name="nom" id="nom">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Adresse</label>
            <div class="col-sm-12 col-md-10">
              <input class="form-control" type="text" placeholder="Adresse" name="adresse" id="adresse">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Email</label>
            <div class="col-sm-12 col-md-10">
              <input class="form-control" type="email" placeholder="Email" name="email" id="email">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Telepehone</label>
            <div class="col-sm-12 col-md-10">
              <input class="form-control" type="number" placeholder="Telepehone" name="telephone" id="telephone">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Acheteur</label>
            <div class="col-sm-12 col-md-10">
            <select class="form-control" name="user_id" id="acheteur">
            @foreach($acheteurs as $acheteur)
                <option value="{{ $acheteur->id }}">{{ $acheteur->username }} - {{ $acheteur->username }}</option>
            @endforeach
        </select>
            </div>
          </div>

          <button type="submit" class="btn btn-primary me-2">Envoyer</button>
                    <button class="btn btn-light"><a href="{{route('products.index')}}">Annuler</a></button>

        </form>



@endsection




