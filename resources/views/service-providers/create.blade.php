@extends('layouts.app')

@section('title', 'Tambah Service Provider')

@section('content')
<div class="mb-6">
    <a href="{{ route('service-providers.index') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="card">
    <h1 class="text-xl mb-6">Tambah Service Provider Baru</h1>

    <form method="POST" action="{{ route('service-providers.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Nama *</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="category_id">Kategori *</label>
            <select id="category_id" name="category_id" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="phone">Telepon</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}">
        </div>

        <div class="form-group">
            <label for="address">Alamat</label>
            <textarea id="address" name="address">{{ old('address') }}</textarea>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="photo">Foto</label>
            <input type="file" id="photo" name="photo" accept="image/*">
            <small style="color: #6b7280;">Maksimal 2MB. Format: JPEG, PNG, JPG, GIF</small>
        </div>

        <div class="form-group" style="margin-top: 1.5rem;">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('service-providers.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
