<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Création d'une entreprise</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('entreprises.store') }}" enctype="multipart/form-data">
          @csrf
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
            <label class="col-sm-12 col-md-2 col-form-label">Logo</label>
            <div class="col-sm-12 col-md-10">
              <input class="form-control" type="file" name="logo" id="logo">
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
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-primary" onclick="saveChanges()">Enregister</button>
      </div>
    </div>
  </div>
</div>

<style>
  /* Ajoutez une classe pour styliser l'input en rouge */
  .error-input {
    border: 1px solid red;
  }
</style>

<script>
  let editingEntrepriseId = null;

function openModalForEdit(entrepriseId) {
  editingEntrepriseId = entrepriseId;

  $.ajax({
    type: 'GET',
    dataType: "json",
    url: `entreprises/${entrepriseId}/edit`,
    success: function(data) {
      document.getElementById('nom').value = data.entreprise.nom;
      document.getElementById('adresse').value = data.entreprise.adresse;
      document.getElementById('email').value = data.entreprise.email;
      document.getElementById('telephone').value = data.entreprise.telephone;

      $('#exampleModal').modal('show');
    },
    error: function(data) {
      console.error("ERROR...", data);
    },
  });
}

function saveChanges() {

  let nomInput = document.getElementById('nom');
  let adresseInput = document.getElementById('adresse');
  let emailInput = document.getElementById('email');
  let telephoneInput = document.getElementById('telephone');
  let logoInput = document.getElementById('logo');
  let userInput = document.getElementById('acheteur');


  let nom = nomInput.value;
  let adresse = adresseInput.value;
  let email = emailInput.value;
  let telephone = telephoneInput.value;
  let logo = logoInput.files[0]; 
  let user = userInput.value;

  let formData = new FormData();
  formData.append('nom', nom);
  formData.append('adresse', adresse);
  formData.append('email', email);
  formData.append('telephone', telephone);
  formData.append('logo', logo);
  formData.append('user_id', user);

  formData.append('_method', editingEntrepriseId ? 'PUT' : 'POST');

  let url = editingEntrepriseId ? "entreprises/" + editingEntrepriseId : "{{ route('entreprises.store') }}";

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
  });

  $.ajax({
    type: "POST",
    dataType: "json",
    url: url,
    data: formData,
    contentType: false,
    processData: false,
    timeout: 5000,
    success: function(data) {
      if (!data.error) {
        $('#exampleModal').modal('hide');

        nomInput.value = '';
        adresseInput.value = '';
        emailInput.value = '';
        telephoneInput.value = '';
        userInput.value = '';
        nomInput.classList.remove('error-input');
        adresseInput.classList.remove('error-input');
        emailInput.classList.remove('error-input');
        telephoneInput.classList.remove('error-input');
        userInput.classList.remove('error-input');

        editingEntrepriseId = null;

        document.querySelector('.success').innerHTML = "Enregistré avec succès";

        updateTable(data.entreprises.data);
      } else {
        nomInput.classList.add('error-input');
        adresseInput.classList.add('error-input');
        emailInput.classList.add('error-input');
        telephoneInput.classList.add('error-input');

        document.querySelector('.error').innerHTML = "Erreur d'enregistrement";
      }
    },
    error: function(data) {
      nomInput.classList.add('error-input');
      adresseInput.classList.add('error-input');
      emailInput.classList.add('error-input');
      telephoneInput.classList.add('error-input');
      console.error("ERROR...", data);
    },
  });
}

function updateTable(data) {
  var tbody = document.querySelector('.table tbody');
  tbody.innerHTML = '';

  data.forEach(entreprise => {
    var row = document.createElement('tr');
    row.innerHTML = `
      <th scope="row">${entreprise.id}</th>
      <td>${entreprise.nom}</td>
      <td>${entreprise.adresse}</td>
      <td>${entreprise.email}</td>
      <td>${entreprise.telephone}</td>
      <td>
        <button onclick="openModalForEdit(${entreprise.id})" class="btn btn-warning"><i class="fa fa-edit"></i></button>
        <form action="{{ url('entreprises.destroy') }}/${entreprise.id}" method="post" style="display:inline;">
          @method('delete')
          @csrf
          <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
      </td>
    `;
    tbody.appendChild(row);
  });
}

</script>
