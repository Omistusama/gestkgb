<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contacts') }}
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
                        <form action="{{ route('contacts.destroy',$value->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('contacts.show',$value->id) }}">Détails</a>
                            <a class="btn btn-primary" href="{{route('contacts.edit',$value->id) }}">Modifier</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach

        </tbody>
    </table>
    <a href="{{ route('contacts.create') }}" class="btn btn-success">Ajouter un contact</a>
</x-app-layout>
