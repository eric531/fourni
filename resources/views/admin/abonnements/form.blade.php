<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Abonnement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="entrepriseForm" method="POST" action="{{ route('entreprises.store') }}" enctype="multipart/form-data">
          @csrf

          <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Debut</label>
            <div class="col-sm-12 col-md-10">
              <input class="form-control" type="date" name="start_date" id="start_date">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Fin</label>
            <div class="col-sm-12 col-md-10">
              <input class="form-control" type="date"  name="end_date" id="end_date">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Entreprise</label>
            <div class="col-sm-12 col-md-10">
              <select class="form-control" name="entreprise_id" id="entreprise">
                @foreach($entreprises as $entreprise)
                  <option value="{{ $entreprise->id }}">{{ $entreprise->nom }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="saveChanges()">Save changes</button>
      </div>
    </div>
  </div>
</div>

<style>
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
    url: `abonnements/${entrepriseId}/edit`,
    success: function(data) {
      document.getElementById('start_date').value = data.abonnement.start_date;
      document.getElementById('end_date').value = data.abonnement.end_date;

      $('#exampleModal').modal('show');
    },
    error: function(data) {
      console.error("ERROR...", data);
    },
  });
}

function saveChanges() {
  let startDateInput = document.getElementById('start_date');
  let endDateInput = document.getElementById('end_date');
  let entrepriseInput = document.getElementById('entreprise');

  let startDate = startDateInput.value;
  let endDate = endDateInput.value;
  let entrepriseId = entrepriseInput.value;

  let formData = new FormData();
  formData.append('start_date', startDate);
  formData.append('end_date', endDate);
  formData.append('entreprise_id', entrepriseId);
  formData.append('_method', editingEntrepriseId ? 'PUT' : 'POST');

  let url = editingEntrepriseId ? `abonnements/${editingEntrepriseId}` : "{{ route('abonnements.store') }}";

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

        startDateInput.value = '';
        endDateInput.value = '';
        entrepriseInput.value = '';
        startDateInput.classList.remove('error-input');
        endDateInput.classList.remove('error-input');
        entrepriseInput.classList.remove('error-input');

        editingEntrepriseId = null;

        document.querySelector('.success').innerHTML = "Enregistré avec succès";

        // updateTable(data.abonnements);
        window.location.reload()
      } else {
        startDateInput.classList.add('error-input');
        endDateInput.classList.add('error-input');
        entrepriseInput.classList.add('error-input');

        document.querySelector('.error').innerHTML = "Erreur d'enregistrement";
      }
    },
    error: function(data) {
      startDateInput.classList.add('error-input');
      endDateInput.classList.add('error-input');
      entrepriseInput.classList.add('error-input');
      console.error("ERROR...", data);
    },
  });
}

function updateTable(data) {
  var tbody = document.querySelector('.table tbody');
  tbody.innerHTML = '';

  data.forEach(abonnement => {
    var row = document.createElement('tr');
    row.innerHTML = `
      <th scope="row">${abonnement.id}</th>
      <td>${abonnement.start_date}</td>
      <td>${abonnement.end_date}</td>
      <td>${abonnement.entreprise.nom}</td>
      <td>
        <button onclick="openModalForEdit(${abonnement.id})" class="btn btn-warning"><i class="fa fa-edit"></i></button>
        <form action="{{ url('abonnements.destroy') }}/${abonnement.id}" method="post" style="display:inline;">
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
