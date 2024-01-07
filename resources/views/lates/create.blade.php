@extends('layouts.template')

@section('content')
    <div class="jumbotron py-4 px-5">
        <h1 class="display-4">
            Siswa Terlambat !
        </h1>
        <hr class="my-4">

        <form action="{{ route('lates.store') }}" method="POST" class="card p-5" enctype="multipart/form-data">
            @csrf

            @if (Session::get('success'))
                <div class="alert alert-success mt-3">{{ Session::get('success') }}</div>
            @endif
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Siswa :</label>
                <div class="col-sm-10">
                    <select class="form-select" name="student_id" id="name">
                        <option selected disabled hidden>Pilih</option>
                        @foreach ($students as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="date_time_late" class="form-label">Tanggal</label>
                <input type="datetime-local" class="form-control" id="date_time_late" name="date_time_late">
            </div>
            <div class="mb-3">
                <label for="information"w class="form-label">Keterangan Keterlambatan</label>
                <textarea class="form-control" id="information" rows="3" name="information"></textarea>
            </div>
            <div class="mb-3">
                <label for="bukti" class="form-label">Bukti</label>
                <input class="form-control" type="file" id="bukti" name="bukti">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
        </form>
    </div>
@endsection
