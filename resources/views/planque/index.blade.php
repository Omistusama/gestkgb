<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Planque') }}
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
            <th>Code</th>
            <th>Pays</th>
            <th>Actions</th>
        </thead>
        <tbody>

                @foreach ($data as $key => $value)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $value->code }}</td>
                    <td>{{ $value->pays }}</td>
                    <td>
                        <form action="{{ route('planques.destroy',$value->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('planques.show',$value->id) }}">Détails</a>
                            <a class="btn btn-primary" href="{{route('planques.edit',$value->id) }}">Modifier</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach

        </tbody>
    </table>
    <a href="{{ route('planques.create') }}" class="btn btn-success">Ajouter une planque</a>
</x-app-layout>
