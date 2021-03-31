<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Missions') }}
        </h2>
    </x-slot>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Détail de la mission : </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('missions.index') }}"> Retour</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Titre :</strong>
                {{ $mission[0]->titre }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description :</strong>
                {{ $mission[0]->description }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nom de code de la mission :</strong>
                {{ $mission[0]->nomdecode }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Pays :</strong>
                {{ $mission[0]->pays }}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Agent(s)</label>
            <div class="col-sm-12">
                <ul id="agentslist_show">
                    @foreach ($mission as $key => $value)
                        <li>{{$value->nomAgent}} {{$value->prenomAgent}}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Contact(s)</label>
            <div class="col-sm-12">
                <ul id="contactslist_show">
                    @foreach ($mission as $key => $value)
                        <li>{{$value->nomContact}} {{$value->prenomContact}}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Cible(s)</label>
            <div class="col-sm-12">
                <ul id="cibleslist_show">
                    @foreach ($mission as $key => $value)
                        <li>{{$value->nomCible}} {{$value->prenomCible}}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Planque(s)</label>
            <div class="col-sm-12">
                <ul id="planqueslist_show">
                    @foreach ($mission as $key => $value)
                        <li>{{$value->code}} ({{$value->type}})</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Type :</strong>
                {{ $mission[0]->type }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Statut :</strong>
                {{ $mission[0]->statut }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Spécialité :</strong>
                {{ $mission[0]->specialite }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Date de début :</strong>
                {{ $mission[0]->datedebut }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Date de fin :</strong>
                {{ $mission[0]->datefin }}
            </div>
        </div>
    </div>
</x-app-layout>
