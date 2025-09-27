@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Laporan Peminjaman</h2>

        <!-- Form Filter -->
        <form action="{{ route('laporan.index') }}" method="GET" class="mb-6 bg-gray-50 p-4 rounded-lg flex flex-col md:flex-row items-center gap-4">
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date" value="{{ $startDate }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                <input type="date" name="end_date" id="end_date" value="{{ $endDate }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div class="flex items-end h-full">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Filter</button>
            </div>
            <div class="flex items-end h-full">
                <a href="{{ route('laporan.downloadPDF', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600" target="_blank">Unduh PDF</a>
            </div>
        </form>

        <!-- Tabel Riwayat -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-6 text-left">Peminjam</th>
                        <th class="py-3 px-6 text-left">Sarpras</th>
                        <th class="py-3 px-6 text-left">Tgl Pinjam</th>
                        <th class="py-3 px-6 text-left">Tgl Kembali</th>
                        <th class="py-3 px-6 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                     @forelse ($peminjamans as $peminjaman)
                    <tr>
                        <td class="py-4 px-6">{{ $peminjaman->user->name ?? 'N/A' }}</td>
                        <td class="py-4 px-6">{{ $peminjaman->sarpras->nama_sarpras ?? 'N/A' }}</td>
                        <td class="py-4 px-6">{{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->format('d M Y') }}</td>
                        <td class="py-4 px-6">{{ \Carbon\Carbon::parse($peminjaman->tanggal_pengembalian)->format('d M Y') }}</td>
                        <td class="py-4 px-6">{{ $peminjaman->status_peminjaman }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">
                            Tidak ada data untuk periode yang dipilih.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $peminjamans->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
