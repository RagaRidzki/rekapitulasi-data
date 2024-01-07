@extends('layouts.template')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif

    <div class="d-flex">
        <div class="p-2">
            <a href="{{ route('lates.create') }}" class="btn btn-secondary">Tambah</a>
        </div>
        <div class="p-2">
            <a href="{{ route('lates.export-excel') }}" target="_blank" class="btn btn-secondary">Export Data Keterlambatan</a>
        </div>
    </div>
    <div class="container">
        <ol class="breadcrumb bg-white">
            <li class="breadcrumb-item"><a href="{{ route('lates.index') }}">Keseluruhan Data</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lates.rekap') }}">Rekapitulasi Data</a></li>
        </ol>
        <table class="table table-striped table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nis</th>
                    <th>Jumlah Keterlambatan</th>
                    <th>Detail Foto</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                    $uniqueNames = [];
                    $countNames = collect($lates)
                        ->groupBy('student.name')
                        ->map->count();
                @endphp
                @foreach ($lates as $item)
                    @if (!in_array($item['student']['name'], $uniqueNames))
                        @php $uniqueNames[] = $item['student']['name']; @endphp
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item['student']['name'] }}</td>
                            <td>{{ $item['student']['nis'] }}</td>
                            <td>{{ $countNames[$item['student']['name']] }}</td>
                            <td class="breadcrumb-item"><a href="{{ route('lates.detail', $item->student) }}">Detail</a></td>
                            <td><a href="{{ route('lates.download', $item['id']) }}" target="_blank" class="btn btn-primary me-3">Cek Surat Pernyataan</a></td>
                        </tr>
                    @endif
                @endforeach
        </table>
    </div>
@endsection
