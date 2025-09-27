@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div>
    <!-- Kartu Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h3 class="text-sm font-medium text-gray-500">Peminjaman Diajukan</h3>
            <p class="mt-2 text-3xl font-bold text-gray-900">{{ $peminjamanDiajukan }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h3 class="text-sm font-medium text-gray-500">Peminjaman Disetujui</h3>
            <p class="mt-2 text-3xl font-bold text-gray-900">{{ $peminjamanDisetujui }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h3 class="text-sm font-medium text-gray-500">Sarpras Tersedia</h3>
            <p class="mt-2 text-3xl font-bold text-gray-900">{{ $sarprasTersedia }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Kolom Kiri: Peminjaman Terbaru -->
        <div class="lg:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Peminjaman Terbaru</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sarpras</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($peminjamanTerbaru as $peminjaman)
                            <tr>
                                <td class="py-4 px-6 whitespace-nowrap text-sm font-medium text-gray-900">{{ $peminjaman->user->name ?? 'N/A' }}</td>
                                <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-500">{{ $peminjaman->sarpras->nama_sarpras ?? 'N/A' }}</td>
                                <td class="py-4 px-6 whitespace-nowrap text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $peminjaman->status_peminjaman == 'Disetujui' ? 'bg-green-100 text-green-800' : ($peminjaman->status_peminjaman == 'Ditolak' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ $peminjaman->status_peminjaman }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-gray-500">
                                    Belum ada data peminjaman.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Grafik -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
            <div class="p-6 h-96">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Peminjaman (7 Hari Terakhir)</h3>
                <canvas id="peminjamanChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch('{{ route("dashboard.chartData") }}')
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById('peminjamanChart').getContext('2d');
                const peminjamanChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Jumlah Peminjaman',
                            data: data.data,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            tension: 0.3
                        }]
                    },
                    options: {
                        scales: { y: { beginAtZero: true } },
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            });
    });
</script>
@endpush

