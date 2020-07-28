@extends('layouts.app')

@section('content')
    <h2 class="my-2">Przepisy - {{$categoryName}}</h2>
    <div class="justify-content-center">
        @can('create recipe')
            <a class="btn btn-primary my-1" href="{{route('recipes.create')}}">Utwórz przepis</a>
        @endcan

        <table class="table">
            <thead class="thead">
            <tr>
                <th>Zdjęcie</th>
                <th>Nazwa</th>
                <th>Opis</th>
                <th>Czas przygotowania (min)</th>
                <th>Trudność</th>
                <th>Porcje</th>
                @can('edit all recipes')
                    <th>Edytuj</th>
                @endcan
                @can('delete all recipes')
                    <th>Usuń</th>
                @endcan
            </tr>
            </thead>
            <tbody>
            @foreach ($recipes as $recipe)
                <tr>
                    <td>@if(!is_null($recipe->picture))<img src="{{ asset('storage/'.$recipe->picture) }}" alt="zdjęcie"
                                                            width="64" height="64">@endif</td>
                    <td><a href="{{route('recipes.show', $recipe->id)}}">{{ $recipe->name }}</a></td>
                    <td>{{ $recipe->description }}</td>
                    <td>{{ $recipe->prepare_time }}</td>
                    <td>{{ $recipe->difficulty }}</td>
                    <td>{{ $recipe->serves }}</td>
                    @can('edit all recipes')
                        <td><a class="btn btn-warning" href="{{route('recipes.edit', $recipe->id)}}">Edytuj</a></td>
                    @endcan
                    @can('delete all recipes')
                        <td>
                            <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <input type="submit" class="btn btn-danger" value="Usuń"
                                       onclick="return confirm('Czy na pewno chcesz usunąć przepis \'{{$recipe->name}}\'?')">
                            </form>
                        </td>
                    @endcan
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $recipes->render() }}
@endsection
