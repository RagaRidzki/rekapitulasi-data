@extends('layouts.template')

@section('content')
    <div class="jumbotron py-4 px-5">
        @if (Session::get('alreadyAccess'))
            <div class="alert alert-danger">{{ Session::get('alreadyAccess') }}</div>
        @endif
        <h1 class="display-4">
            Dashboard {{ Auth::user()->name }}!
        </h1>
        <hr class="my-4">

        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Peserta Didik</h5>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Rombel</h5>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Rayon</h5>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Administrator</h5>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pembimbing Siswa</h5>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
