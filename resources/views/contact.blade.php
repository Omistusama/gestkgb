<?php
    //var_dump($contacts);
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contacts') }}
        </h2>
    </x-slot>

<div class="container">
    <a class="btn btn-success" href="javascript:void(0)" id="createNewcontact"> Create New contact</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th width="300px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="contactForm" name="contactForm" class="form-horizontal">
                   <input type="hidden" name="contact_id" id="contact_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Nom</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez le nom" value="" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Prénom</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez le prénom" value="" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Date de naissance</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="datedenaissance" name="datedenaissance" placeholder="Entrez la date de naissance" value="" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nom de code</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nomdecode" name="nomdecode" placeholder="Entrez le nom de code" value="" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nationalité</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nationalite" name="nationalite" placeholder="Entrez la nationalité " value="" required="">
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('contacts.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nom', name: 'nom'},
            {data: 'prenom', name: 'prenom'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createNewcontact').click(function () {
        $('#saveBtn').val("create-contact");
        $('#contact_id').val('');
        $("input").prop('disabled', false);
        $('#contactForm').trigger("reset");
        $('#modelHeading').html("Create New contact");
        $('#ajaxModel').modal('show');
    });
    $('body').on('click', '.editcontact', function () {
      var contact_id = $(this).data('id');
      $.get("{{ route('contacts.index') }}" +'/' + contact_id +'/edit', function (data) {
          $('#modelHeading').html("Edit contact");
          $("input").prop('disabled', false);
          $('#saveBtn').val("edit-contact");
          $('#ajaxModel').modal('show');
          $('#contact_id').val(data.id);
          $('#nom').val(data.nom);
          $('#prenom').val(data.prenom);
          $('#datedenaissance').val(data.datedenaissance);
          $('#nomdecode').val(data.nomdecode);
          $('#nationalite').val(data.nationalite);
      })
   });
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Save');

        $.ajax({
          data: $('#contactForm').serialize(),
          url: "{{ route('contacts.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#contactForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();

          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });
    $('body').on('click', '.detailcontact', function () {
      var contact_id = $(this).data('id');
      $.get("{{ route('contacts.index') }}" + '/' + contact_id, function (data) {
          $('#modelHeading').html("Show contact");
          $("input").prop('disabled', true);
          $('#saveBtn').val("show-contact");
          $('#ajaxModel').modal('show');
          $('#contact_id').val(data.id);
          $('#nom').val(data.nom);
          $('#prenom').val(data.prenom);
          $('#datedenaissance').val(data.datedenaissance);
          $('#nomdecode').val(data.nomdecode);
          $('#nationalite').val(data.nationalite);
      })
   });
    $('body').on('click', '.deletecontact', function () {

        var contact_id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "{{ route('contacts.index') }}"+ '/' + contact_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });


  });
</script>
{{-- +'/myshow' --}}
</x-app-layout>

