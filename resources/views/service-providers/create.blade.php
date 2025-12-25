@extends('layouts.app')

@section('title', 'Tambah Service Provider')

@section('content')
<div class="mb-6">
    <a href="{{ route('service-providers.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">← Kembali</a>
</div>

<div class="bg-white rounded-lg shadow-sm p-6">
    <h1 class="text-xl font-semibold text-gray-800 mb-6">Tambah Service Provider Baru</h1>

    <form method="POST" action="{{ route('service-providers.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Nama *</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-gray-700 font-medium mb-2">Kategori *</label>
            <select id="category_id" name="category_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-gray-700 font-medium mb-2">Telepon</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <div class="mb-4">
            <label for="address" class="block text-gray-700 font-medium mb-2">Alamat</label>
            <textarea id="address" name="address" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-y">{{ old('address') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
            <textarea id="description" name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-y">{{ old('description') }}</textarea>
        </div>

        <div class="mb-6">
            <label for="photo" class="block text-gray-700 font-medium mb-2">Foto</label>
            <input type="file" id="photo" name="photo" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <p class="text-sm text-gray-500 mt-1">Maksimal 2MB. Format: JPEG, PNG, JPG, GIF</p>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Simpan</button>
            <a href="{{ route('service-providers.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">Batal</a>
        </div>
    </form>
</div>
@endsection
