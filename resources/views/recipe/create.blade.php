@extends('layouts.app')

@section('content')
    {{--    {{dd(old('ingredients'))}}--}}

    <h2 class="my-2">Nowy przepis</h2>
    <div class="justify-content-center">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{ Form::model($recipe, ['route' => 'recipes.store', 'enctype' => 'multipart/form-data']) }}

        <div class="form-row">
            <div class="form-group col-md-6">
                {{ Form::label('name', 'Nazwa dania: ') }}
                {{ Form::text('name', old('name'), ['class' => 'form-control']) }}
                @error('name')
                <p class=" alert alert-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('recipe_category_id', 'Kategoria: ') }}
                {{ Form::select('recipe_category_id', \App\RecipeCategory::all()->pluck('name', 'id'), old('recipe_category_id'), ['class' => 'form-control']) }}
                @error('recipe_category_id')
                <p class=" alert alert-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('description', 'Opis: ') }}
            {{ Form::textarea('description', old('description'), ['class' => 'form-control']) }}
            @error('description')
            <p class=" alert alert-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group col-md-3 col-sm-6">
                {{ Form::label('prepare_time', 'Czas przygotowania: ') }}
                {{ Form::number('prepare_time', old('prepare_time'), ['class' => 'form-control']) }}
                @error('prepare_time')
                <p class=" alert alert-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-md-3 col-sm-6">
                {{ Form::label('serves', 'Porcje: ') }}
                {{ Form::number('serves', old('serves'), ['class' => 'form-control']) }}
                @error('serves')
                <p class=" alert alert-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-md-3 col-sm-6">
                {{ Form::label('difficulty', 'Trudność: ') }}
                {{ Form::select('difficulty', \App\Recipe::DIFFICULTY, old('difficulty'), ['class' => 'form-control']) }}
                @error('difficulty')
                <p class=" alert alert-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-md-3 col-sm-6">
                {{ Form::label('picture', 'Zdjęcie: ') }}
                {{ Form::file('picture', ['class' => 'form-control-file', 'accept' => 'image/jpeg, image/jpg, image/png']) }}
                @error('picture')
                <p class=" alert alert-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    @error('ingredients.*')
                    <p class=" alert alert-danger">{{ $message }}</p>
                    @enderror
                    <ingredient-picker :ingredients-list='{{\App\Ingredient::all()}}'
                                       :units-list='{{\App\MeasureUnit::all()}}'
                                       @if (old('recipe_ingredients'))
                                       :ingredients-old="{{collect(old('recipe_ingredients'))}}"@endif>
                    </ingredient-picker>
                </div>
            </div>
            <div class="col-8">
                <div class="form-group">
                    @error('steps.*')
                    <p class=" alert alert-danger">{{ $message }}</p>
                    @enderror
                    <step-editor @if (old('recipe_steps'))
                                 :steps-old="{{collect(old('recipe_steps'))}}"@endif>
                    </step-editor>
                </div>
            </div>
        </div>

        {{ Form::submit('Dodaj przepis', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@endsection
