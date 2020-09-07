@extends('layouts.app')

@section('content')
    <h2>{{ $recipe->name }}</h2>
    @if(!is_null($recipe->picture))
        <img src="{{asset('storage/'.$recipe->picture)}}" alt="zdjęcie">
    @endif
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
                    <li>{{ $ingredient->quantity . $ingredient->measureUnit->name . ' ' . $ingredient->ingredient->name }}</li>
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
            @foreach($recipe->recipeSteps as $step)
                <li>{{ $step->instruction }}</li>
                @if(!is_null($step->picture))
                    <img width="256" height="256" src="{{asset('storage/'.$step->picture)}}" alt="zdjęcie">
                @endif
            @endforeach
        </ul>
    </div>
@endsection
