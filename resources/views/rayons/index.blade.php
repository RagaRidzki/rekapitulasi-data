@extends('layouts.template')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::has('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif

    <div class="d-flex flex-row-reverse">
        <div class="p-2">
            <a href="{{ route('rayons.create') }}" class="btn btn-secondary">Tambah pengguna</a>
        </div>
    </div>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Rayon</th>
                <th>Pembimbing Rayon</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($rayons as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['rayon'] }}</td>
                    <td>
                        @if ($item->user)
                            {{ $item->user->name }}
                        @else
                            Pembimbing tidak tersedia
                        @endif
                    </td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('rayons.edit', $item->id) }}" class="btn btn-primary me-3">Edit</a>
                        <form action="{{ route('rayons.delete', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Kamu Yakin Mau Menghapus?');">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
