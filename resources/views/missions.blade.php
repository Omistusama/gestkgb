<?php
    //var_dump($missions);
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Missions') }}
        </h2>
    </x-slot>

<div class="container overflow-x:auto;">
    <a class="btn btn-success" href="javascript:void(0)" id="createNewmission"> Create New mission</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nom</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Pays</th>
                <th>Statut</th>
                <th>Actions</th>
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
                <form id="missionForm" name="missionForm" class="form-horizontal">
                   <input type="hidden" name="mission_id" id="mission_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Titre</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="titre" name="titre" placeholder="Entrez le titre" value="" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-12">
                            <textarea id="description" name="description" required="" placeholder="Entrez une description" class="form-control"></textarea>                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nom de code</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nomdecode" name="nomdecode" placeholder="Entrez le nom de code" value="" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pays</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="pays" name="pays" placeholder="Entrez le pays " value="" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Agent(s)</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="agents[]" id="agents" multiple="multiple">
                                <option value="">Choissisez un agent</option>
                                @foreach ($agentdata as $key => $value)
                                    <option value="{{$value->id}}">Agent {{$value->nom}} ({{$value->codeidentification}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Contact(s)</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="contacts[]" id="contacts" multiple="multiple">
                                <option value="">Choissisez un contact</option>
                                @foreach ($contactdata as $key => $value)
                                    <option value="{{$value->id}}">{{$value->nom}} ({{$value->nomdecode}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Cible(s)</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="cibles[]" id="cibles" multiple="multiple">
                                <option value="">Choissisez une cible</option>
                                @foreach ($cibledata as $key => $value)
                                    <option value="{{$value->id}}">{{$value->nom}} ({{$value->nomdecode}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Planque(s)</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="planque[]" id="planque" multiple="multiple">
                                <option value="Aucune">Choissisez une planque</option>
                                @foreach ($planquedata as $key => $value)
                                    <option value="{{$value->id}}">{{$value->code}} ({{$value->type}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Type</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="type" name="type" placeholder="Entrez le Type " value="" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Statut</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="statut" id="statut" multiple="multiple">
                                <option value="">Choissisez un statut</option>
                                <option value="En Préparation">En préparation</option>
                                <option value="En cours">En cours</option>
                                <option value="Terminé">Terminé</option>
                                <option value="Echec">Echec</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Spécialité</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="specialite" name="specialite" placeholder="Entrez la specialite " value="" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Date de début</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="datedebut" name="datedebut" placeholder="Entrez la date de naissance" value="" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Date de fin</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="datefin" name="datefin" placeholder="Entrez la date de naissance" value="" required="">
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

<div class="modal fade" id="ajaxShowModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelShowHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="missiondForm" name="missiondForm" class="form-horizontal">
                   <input type="hidden" name="missiond_id" id="missiond_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Titre</label>
                        <div class="col-sm-12">
                            {{-- <input type="text" class="form-control" id="titre_show" name="titre_show" placeholder="Entrez le titre" value="" required=""> --}}
                            <p id="titre_show" name="titre_show"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-12">
                            {{-- <textarea id="description_show" name="description_show" required="" placeholder="Entrez une description" class="form-control"></textarea>                         --}}
                            <p id="description_show" name="description_show"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nom de code</label>
                        <div class="col-sm-12">
                            {{-- <input type="text" class="form-control" id="nomdecode_show" name="nomdecode_show" placeholder="Entrez le nom de code" value="" required=""> --}}
                            <p id="nomdecode_show" name="nomdecode_show"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pays</label>
                        <div class="col-sm-12">
                            {{-- <input type="text" class="form-control" id="pays" name="pays" placeholder="Entrez le pays " value="" required=""> --}}
                            <p id="pays_show" name="pays_show"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Agent(s)</label>
                        <div class="col-sm-12">
                            <ul id="agentslist_show"></ul>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Contact(s)</label>
                        <div class="col-sm-12">
                            <ul id="contactslist_show"></ul>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Cible(s)</label>
                        <div class="col-sm-12">
                            <ul id="cibleslist_show"></ul>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Planque(s)</label>
                        <div class="col-sm-12">
                            <ul id="planqueslist_show"></ul>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Type</label>
                        <div class="col-sm-12">
                            <p id="type_show" name="type_show"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Statut</label>
                        <div class="col-sm-12">
                            <p id="statut_show" name="statut_show"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Spécialité</label>
                        <div class="col-sm-12">
                            <p id="specialite_show" name="specialite_show"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Date de début</label>
                        <div class="col-sm-12">
                            {{-- <input type="date" class="form-control" id="datedebut" name="datedebut" placeholder="Entrez la date de naissance" value="" required=""> --}}
                            <p id="datedebut_show" name="datedebut_show"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Date de fin</label>
                        <div class="col-sm-12">
                            {{-- <input type="date" class="form-control" id="datefin" name="datefin" placeholder="Entrez la date de naissance" value="" required=""> --}}
                            <p id="datefin_show" name="datefin_show"></p>
                        </div>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>

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
        ajax: "{{ route('missions.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'titre', name: 'titre'},
            {data: 'datedebut', name: 'datedebut'},
            {data: 'datefin', name: 'datefin'},
            {data: 'pays', name: 'pays'},
            {data: 'statut', name: 'statut'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createNewmission').click(function () {
        $('#saveBtn').val("create-mission");
        $('#mission_id').val('');
        $("input").prop('disabled', false);
        $("select").prop('disabled', false);
        $("textarea").prop('disabled', false);
        $('#missionForm').trigger("reset");
        $('#modelHeading').html("Create New mission");
        $('#ajaxModel').modal('show');
    });
    $('body').on('click', '.editmission', function () {
      var mission_id = $(this).data('id');
      $.get("{{ route('missions.index') }}" +'/' + mission_id +'/edit', function (data) {
          $('#modelHeading').html("Edit mission");
          $("input").prop('disabled', false);
          $("select").prop('disabled', false);
          $("textarea").prop('disabled', false);
          $('#saveBtn').val("edit-mission");
          $('#ajaxModel').modal('show');
          $('#mission_id').val(data.id);
          $('#nom').val(data.titre);
          $('#prenom').val(data.description);
          $('#datedenaissance').val(data.nomdecode);
          $('#nomdecode').val(data.pays);
          $('#nationalite').val(data.agents);
      })
   });
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Save');

        $.ajax({
          data: $('#missionForm').serialize(),
          url: "{{ route('missions.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#missionForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();

          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });
    $('body').on('click', '.detailmission', function () {
      var mission_id = $(this).data('id');
      $.get("{{ route('missions.index') }}" + '/' + mission_id, function (data) {
          $('#modelShowHeading').html("Show mission");
          $("input").prop('disabled', true);
          $("select").prop('disabled', true);
          $("textarea").prop('disabled', true);
          $('#saveBtn').val("show-mission");
          $('#ajaxShowModel').modal('show');
          $('#mission_id').val(data.id);
          $('#titre_show').html(data[0].titre);
          $('#description_show').html(data[0].description);
          $('#nomdecode_show').html(data[0].nomdecode);
          $('#pays_show').html(data[0].pays);
          $('#datedebut_show').html(data[0].datedebut);
          $('#datefin_show').html(data[0].datefin);
          $('#type_show').html(data[0].type);
          $('#statut_show').html(data[0].statut);
          $('#specialite_show').html(data[0].specialite);
          var ulagent = $('#agentslist_show');
          Object.keys(data).forEach(function(k){
                const li = document.createElement('li');
                li.innerHTML = '- Agent ' + data[k].nom + ' ' + data[k].prenom;
                ulagent.append(li);
            });
            var ulcontact = $('#contactslist_show');
          Object.keys(data).forEach(function(k){
                const li = document.createElement('li');
                li.innerHTML = '- ' + data[k].nomContact + ' ' + data[k].prenomContact;
                ulcontact.append(li);
            });
            var ulcible = $('#cibleslist_show');
          Object.keys(data).forEach(function(k){
                const li = document.createElement('li');
                li.innerHTML = '- ' + data[k].nomCible + ' ' + data[k].prenomCible;
                ulcible.append(li);
            });

            var ulplanque = $('#planqueslist_show');
          Object.keys(data).forEach(function(k){
                const li = document.createElement('li');
                li.innerHTML = '- ' + data[k].nomCible + ' ' + data[k].prenomCible;
                ulplanque.append(li);
            });

          console.log(data);
      })

   });
    $('body').on('click', '.deletemission', function () {

        var mission_id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "{{ route('missions.index') }}"+ '/' + mission_id,
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

