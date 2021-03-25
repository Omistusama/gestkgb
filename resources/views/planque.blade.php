<?php
    //var_dump($planques);
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Planques') }}
        </h2>
    </x-slot>

<div class="container">
    <a class="btn btn-success" href="javascript:void(0)" id="createNewplanque"> Create New planque</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>code</th>
                <th>adresse</th>
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
                <form id="planqueForm" name="planqueForm" class="form-horizontal">
                   <input type="hidden" name="planque_id" id="planque_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Code</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="code" name="code" placeholder="Entrez le Code" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Adresse</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Entrez l'adresse" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Pays</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="pays" name="pays" placeholder="Entrez le Pays" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Type</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="type" name="type" placeholder="Entrez le Type" value="" required="">
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
        ajax: "{{ route('planques.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'code', name: 'code'},
            {data: 'adresse', name: 'adresse'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createNewplanque').click(function () {
        $('#saveBtn').val("create-planque");
        $('#planque_id').val('');
        $('#planqueForm').trigger("reset");
        $('#modelHeading').html("Create New planque");
        $('#ajaxModel').modal('show');
    });
    $('body').on('click', '.editplanque', function () {
      var planque_id = $(this).data('id');
      $.get("{{ route('planques.index') }}" +'/' + planque_id +'/edit', function (data) {
          $('#modelHeading').html("Edit planque");
          $('#saveBtn').val("edit-planque");
          $('#ajaxModel').modal('show');
          $('#planque_id').val(data.id);
          $('#code').val(data.code);
          $('#adresse').val(data.adresse);
          $('#pays').val(data.pays);
          $('#type').val(data.type);
      })
   });
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Save');
        console.log($('#planque_id').val());
        console.log($('#code').val());
        console.log($('#adresse').val());
        console.log($('#pays').val());
        console.log($('#type').val());
        console.log($('#planqueForm').serialize());
        $.ajax({
          data: $('#planqueForm').serialize(),
          url: "{{ route('planques.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#planqueForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();

          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });



    $('body').on('click', '.deleteplanque', function () {

        var planque_id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "{{ route('planques.store') }}"+'/'+planque_id,
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
</x-app-layout>

