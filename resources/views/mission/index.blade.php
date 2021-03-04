<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Missions') }}
        </h2>
    </x-slot>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-striped">
        <thead>
            <th>#</th>
            <th>Nom de la mission</th>
            <th>Pays</th>
            <th>Type</th>
            <th>Début de la mission</th>
            <th>Fin de la mission</th>
            <th>Statut</th>
            <th>Actions</th>
        </thead>
        <tbody>

                @foreach ($data as $key => $value)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $value->titre }}</td>
                    <td>{{ $value->pays }}</td>
                    <td>{{ $value->type }}</td>
                    <td>{{ $value->datedebut }}</td>
                    <td>{{ $value->datefin }}</td>
                    <td>{{ $value->statut }}</td>
                    <td>
                        <form action="{{ route('missions.destroy',$value->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('missions.show',$value->id) }}">Détails</a>
                            <a class="btn btn-primary" href="{{route('missions.edit',$value->id) }}">Modifier</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach

        </tbody>
    </table>
    <a href="{{ route('missions.create') }}" class="btn btn-success">Ajouter une mission</a>
</x-app-layout>
