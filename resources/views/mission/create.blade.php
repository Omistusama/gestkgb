<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Missions') }}
        </h2>
    </x-slot>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ajouter une mission</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('missions.index') }}"> Retour</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Il y a quelques problèmes avec vos input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('missions.store') }}" method="POST">
        @csrf

        <div class="row">
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
        </div>

    </form>
</x-app-layout>
