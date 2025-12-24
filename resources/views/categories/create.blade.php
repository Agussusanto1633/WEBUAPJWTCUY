@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="mb-6">
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="card">
    <h1 class="text-xl mb-6">Tambah Kategori Baru</h1>

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nama Kategori *</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
        </div>

        <div class="form-group" style="margin-top: 1.5rem;">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
