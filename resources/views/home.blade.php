@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-primary col-md-12" href="{{ url('/file-upload') }}">
                                    Convert </a>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <a type="button" class="btn btn-secondary col-md-12" href="{{ url('/file-history') }}">
                                    History </a>
                            </div>

                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
