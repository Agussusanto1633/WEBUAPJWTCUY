@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Kategori</h1>
    <a href="{{ route('categories.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">+ Tambah Kategori</a>
</div>

<div class="bg-white rounded-lg shadow-sm p-6">
    @if($categories->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 border-b">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 border-b">Nama</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 border-b">Deskripsi</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 border-b">Jumlah Service Provider</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $index => $category)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 border-b border-gray-100">{{ ($categories->currentPage() - 1) * $categories->perPage() + $index + 1 }}</td>
                            <td class="px-4 py-3 border-b border-gray-100 font-medium">{{ $category->name }}</td>
                            <td class="px-4 py-3 border-b border-gray-100 text-gray-600">{{ $category->description ?? '-' }}</td>
                            <td class="px-4 py-3 border-b border-gray-100">
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">{{ $category->serviceProviders->count() }}</span>
                            </td>
                            <td class="px-4 py-3 border-b border-gray-100">
                                <div class="flex gap-2">
                                    <a href="{{ route('categories.show', $category->uuid) }}" class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">Lihat</a>
                                    <a href="{{ route('categories.edit', $category->uuid) }}" class="px-3 py-1 bg-green-500 text-white text-sm rounded hover:bg-green-600 transition">Edit</a>
                                    <form action="{{ route('categories.destroy', $category->uuid) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600 transition" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center">
            {{ $categories->appends(request()->query())->links() }}
        </div>
    @else
        <p class="text-center text-gray-500 py-8">Belum ada kategori.</p>
    @endif
</div>
@endsection
