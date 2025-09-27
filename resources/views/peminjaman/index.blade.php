@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Daftar Peminjaman</h2>
            <a href="{{ route('peminjaman.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-300">
                + Ajukan Peminjaman
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sarpras</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Peminjaman</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($peminjamans as $peminjaman)
                    <tr>
                        <td class="py-4 px-6 whitespace-nowrap text-sm font-medium text-gray-900">{{ $peminjaman->user->name ?? 'User Dihapus' }}</td>
                        <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-500">{{ $peminjaman->sarpras->nama_sarpras ?? 'Sarpras Dihapus' }}</td>
                        <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->format('d M Y') }}</td>
                        <td class="py-4 px-6 whitespace-nowrap text-sm">
                            @php
                                $statusClass = '';
                                switch ($peminjaman->status_peminjaman) {
                                    case 'Disetujui':
                                        $statusClass = 'bg-green-100 text-green-800';
                                        break;
                                    case 'Ditolak':
                                        $statusClass = 'bg-red-100 text-red-800';
                                        break;
                                    case 'Selesai':
                                        $statusClass = 'bg-gray-100 text-gray-800';
                                        break;
                                    default:
                                        $statusClass = 'bg-yellow-100 text-yellow-800';
                                }
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                {{ $peminjaman->status_peminjaman }}
                            </span>
                        </td>
                        <td class="py-4 px-6 whitespace-nowrap text-center text-sm font-medium">
                            <a href="{{ route('peminjaman.show', $peminjaman->id) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">
                            Belum ada data peminjaman.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $peminjamans->links() }}
        </div>

    </div>
</div>
@endsection

