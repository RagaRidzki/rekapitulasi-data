@extends('layouts.template')

@section('content')
    <form action="{{ route('rayons.update', $rayons['id']) }}" method="POST" class="card p-5">
        @csrf
        @method('PATCH')

        @if ($errors->any())
            <ul class="alert alert-danger p-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
            @endforeach
            </ul>
        @endif

    <div class="mb-3 row">
        <label for="rayon" class="col-sm-2 col-form-label">Rayon:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="rayon" name="rayon" value="{{ $rayons['rayon'] }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="type" class="col-sm-2 col-form-label">Role :</label>
        <div class="col-sm-10">
            <select class="form-select" name="user_id" id="type">
                <option selected disabled hidden>--Pilih--</option>
                <option value="admin" {{ $rayons['user_id'] == 'admin' ? 'selected' : '' }}>admin</option>
                <option value="ps" {{ $rayons['user_id'] == 'ps' ? 'selected' : '' }}>ps</option> 
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
</form>
@endsection

