<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Missions') }}
        </h2>
    </x-slot>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier la mission</h2>
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

    <form action="{{ route('missions.update',$mission->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="titre" value="{{ $mission->titre }}" class="form-control" placeholder="Titre">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $mission->description }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nom de code:</strong>
                    <input type="text" name="nomdecode" value="{{ $mission->nomdecode }}" class="form-control" placeholder="Enter Title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Pays:</strong>
                    <input type="text" name="pays" value="{{ $mission->pays }}" class="form-control" placeholder="Enter Title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Agent(s):</strong>
                    <br>
                    <select class="form-control" name="agents[]" id="agents[]" multiple="multiple">
                        <option value="">Choissisez un agent</option>
                        @foreach ($agentdata as $key => $value)
                            <option value="Agent {{$value->nom}} {{$value->prenom}}">Agent {{$value->nom}} ({{$value->codeidentification}})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Contacts:</strong>
                    <br>
                    <select name="contacts[]" id="contacts[]" multiple="multiple">
                        <option value="">Choissisez un contact</option>
                        @foreach ($contactdata as $key => $value)
                            <option value="Contact : {{$value->nom}} {{$value->prenom}}">{{$value->nom}} {{$value->prenom}} ({{$value->nomdecode}})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Cibles:</strong>
                    <br>
                    <select name="cibles[]" id="cibles[]"  multiple="multiple">
                        <option value="">Choissisez une cible</option>
                        @foreach ($cibledata as $key => $value)
                            <option value="Cible : {{$value->nom}} {{$value->prenom}}">{{$value->nom}} {{$value->prenom}} ({{$value->nomdecode}})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Type de mission:</strong>
                    <input type="text" name="type" value="{{ $mission->type }}" class="form-control" placeholder="Enter Title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Statut:</strong>
                    <input type="text" name="statut" value="{{ $mission->statut }}" class="form-control" placeholder="Enter Title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Planque:</strong>
                    <br>
                    <select name="planque[]" id="planque[]" multiple="multiple">
                        <option selected value="">Choissisez une planque</option>
                        @foreach ($planquedata as $key => $value)
                            <option value="Planque {{$value->code}}">Planque {{$value->code}} ({{$value->pays}})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Spécialité:</strong>
                    <input type="text" name="specialite" value="{{ $mission->specialite }}" class="form-control" placeholder="Enter Title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date début:</strong>
                    <input type="date" name="datedebut" value="{{ $mission->datedebut }}" class="form-control" placeholder="Enter Title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date de fin:</strong>
                    <input type="date" name="datefin" value="{{ $mission->datefin }}" class="form-control" placeholder="Enter Title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
</x-app-layout>
