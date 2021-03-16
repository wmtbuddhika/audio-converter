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
            <div class="panel-heading"><h2>Audio to MP3 Converter</h2></div>
            <hr>

            <div class="panel-body">
                <form id="upload-form" action="{{ route('upload.file') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td class="h4">File Name *</td>
                                <td><input type="text" class="form-control" name="fileName" required></td>
                            </tr>
                            <tr>
                                <td class="h4">File *</td>
                                <td><input id="file" type="file" name="file" class="form-control" required></td>
                            </tr>
                            <tr>
                                <td><button type="submit" class="btn btn-success">Upload and Convert</button></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="progress-div" class="row" style="display: none">
                        <div class="col-md-12">
                            <div id="uploading-progress-div" style="visibility: hidden">
                                <label id="uploading">Uploading Progress</label>
                                <div id="uploading-progress-bar"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="download-div" style="display: none">
                                Converting ... <img width="50px" id="loading" src="loading.gif"/>

                                <div class="alert alert-success alert-block" style="display: none">
                                    <a href="{{ Session::get('out-url') }}">Download MP3</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>

@endsection
