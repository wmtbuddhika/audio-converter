@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="panel panel-primary">
            <br>
            <div class="panel-heading"><h2>Converter History</h2></div>
            <hr>

            <div class="panel-body">

            </div>
        </div>
    </div>


</div>

@endsection
