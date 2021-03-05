<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cibles') }}
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
            <th>Nom</th>
            <th>Prénom</th>
            <th>Nationalité</th>
            <th>Actions</th>
        </thead>
        <tbody>

                @foreach ($data as $key => $value)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $value->nom }}</td>
                    <td>{{ $value->prenom }}</td>
                    <td>{{ $value->nationalite }}</td>
                    <td>
                        <form action="{{ route('cibles.destroy',$value->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('cibles.show',$value->id) }}">Détails</a>
                            <a class="btn btn-primary" href="{{route('cibles.edit',$value->id) }}">Modifier</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach

        </tbody>
    </table>
    <a href="{{ route('cibles.create') }}" class="btn btn-success">Ajouter une cible</a>
</x-app-layout>
