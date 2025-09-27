@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Daftar Sarana & Prasarana</h2>
                <a href="#" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-300">
                    + Tambah Sarpras Baru
                </a>
            </div>

            <!-- Tabel untuk menampilkan data -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Sarpras</th>
                            <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                            <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                            <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($sarprasList as $sarpras)
                        <tr>
                            <td class="py-4 px-6 whitespace-nowrap text-sm font-medium text-gray-900">{{ $sarpras->nama_sarpras }}</td>
                            <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-500">{{ $sarpras->jenis_sarpras }}</td>
                            <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-500">
                                {{ $sarpras->kode_ruangan ?? $sarpras->kode_proyektor }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-sm">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $sarpras->status_sarpras == 'Tersedia' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $sarpras->status_sarpras }}
                                </span>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-center text-sm font-medium">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                <a href="#" class="text-green-600 hover:text-green-900 ml-4">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-900 ml-4">Hapus</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">
                                Belum ada data sarpras.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $sarprasList->links() }}
            </div>

        </div>
    </div>
@endsection

