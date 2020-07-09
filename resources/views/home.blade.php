@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @auth
                    You are logged in!
                @else
                    You are not logged in!
                @endauth
            </div>
        </div>
    </div>
@endsection
