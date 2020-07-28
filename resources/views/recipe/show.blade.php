@extends('layouts.app')

@section('content')
    <h2>{{ $recipe->name }}</h2>
    <div class="row text-center p-3">
        <div class="col-4">
            <div>Porcje:</div>{{ $recipe->serves }}</div>
        <div class="col-4">
            <div>Czas przygotowania:</div>{{ $recipe->prepare_time }} minut
        </div>
        <div class="col-4">
            <div>Trudność:</div>{{ \App\Recipe::DIFFICULTY[$recipe->difficulty] }}</div>
    </div>
    <div class="row p-3">
        <div class="col-md-4">
            <h4>Składniki</h4>
            <ul>
                @foreach($recipe->recipeIngredients as $ingredient)
                    <li>{{ $ingredient->quantity . $ingredient->measure_unit->name . ' ' . $ingredient->ingredient->name }}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-8 text-justify">
            <h4>Opis</h4>
            <p>{{ $recipe->description }}</p>
        </div>
    </div>
    <div>
        <h4>Przygotowanie</h4>
        <ul class="text-justify">
            @foreach($recipe->steps as $step)
                @if(!is_null($step->picture))
                    <img width="128" height="128" src="{{asset('storage/'.$step->picture)}}" alt="zzdjęcie">
                @endif
                <li>{{ $step->instructions }}</li>
            @endforeach
        </ul>
    </div>
@endsection
