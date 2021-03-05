<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contacts') }}
        </h2>
    </x-slot>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier un contact</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('contacts.index') }}"> Retour</a>
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

    <form action="{{ route('contacts.update',$contact->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nom de famille:</strong>
                    <input type="text" name="nom" value="{{ $contact->nom }}" class="form-control" placeholder="Entrez un Nom">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Prénom:</strong>
                    <input type="text" class="form-control" value="{{ $contact->prenom }}" name="prenom" placeholder="Entrez un Prénom">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date de naissance:</strong>
                    <input type="date" name="datedenaissance" value="{{ $contact->datedenaissance }}" class="form-control" placeholder="Entrez une date de naissance">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nom de code :</strong>
                    <input type="text" class="form-control" value="{{ $contact->nomdecode }}" name="nomdecode" placeholder="Entrez un Code">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nationalité :</strong>
                    <input type="text" name="nationalite" value="{{ $contact->nationalite }}" class="form-control" placeholder="Entrez une nationalité">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </div>
        </div>

    </form>
</x-app-layout>
