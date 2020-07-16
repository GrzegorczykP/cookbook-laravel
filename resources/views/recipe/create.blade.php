@extends('layouts.app')

@section('content')
    <h2 class="my-2">Nowy przepis</h2>
    <div class="justify-content-center">
        {{ Form::model($recipe, ['route' => 'recipes.store']) }}

        <div class="form-group">
            {{ Form::label('name', 'Nazwa dania: ') }}
            {{ Form::text('name', old('name'), ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('description', 'Opis: ') }}
            {{ Form::textarea('description', old('description'), ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('category', 'Kategoria: ') }}
            {{ Form::select('category', \App\RecipeCategory::all()->pluck('name', 'id'), old('category'), ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            <ingredient-picker :ingredients-list='{{\App\Ingredient::all()}}'
                               :units-list='{{\App\MeasureUnit::all()}}'></ingredient-picker>
        </div>
        {{ Form::submit('Dodaj przepis', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@endsection
