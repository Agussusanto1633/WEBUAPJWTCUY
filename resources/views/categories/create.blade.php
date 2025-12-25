@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="mb-6">
    <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">← Kembali</a>
</div>

<div class="bg-white rounded-lg shadow-sm p-6">
    <h1 class="text-xl font-semibold text-gray-800 mb-6">Tambah Kategori Baru</h1>

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Nama Kategori *</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <div class="mb-6">
            <label for="description" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
            <textarea id="description" name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-y">{{ old('description') }}</textarea>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Simpan</button>
            <a href="{{ route('categories.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">Batal</a>
        </div>
    </form>
</div>
@endsection
