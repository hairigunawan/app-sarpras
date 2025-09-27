<!-- resources/views/components/sidebar-nav.blade.php -->
<aside class="w-64 flex flex-col justify-between bg-white shadow-lg">
    <div>
        <div class="px-6 py-4">
            <div class="flex items-center gap-3 py-4 font-bold text-xl text-gray-900 border-b">
                <div class="w-7 h-7 bg-gray-800 rounded"></div>
                <span>SARPRAS.</span>
            </div>
        </div>

        <nav class="mt-4 px-3 space-y-2">
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-4 px-4 py-2.5 text-sm {{ request()->routeIs('dashboard') ? 'bg-green-100 text-green-600 font-semibold' : 'text-gray-500 hover:bg-gray-100' }} rounded-lg transition">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('sarpras.index') }}"
               class="flex items-center gap-4 px-4 py-2.5 text-sm {{ request()->routeIs('sarpras.*') ? 'bg-green-100 text-green-600 font-semibold' : 'text-gray-500 hover:bg-gray-100' }} rounded-lg transition">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M21.44,11.23l-8.48-4.85a2,2,0,0,0-2,0L2.56,11.23a2,2,0,0,0-1,1.73V18a2,2,0,0,0,2,2H20.4a2,2,0,0,0,2-2V12.96A2,2,0,0,0,21.44,11.23Z M12,12.5,4,7.8,12,3l8,4.8Z"></path></svg>
                <span>Sarpras</span>
            </a>

            <a href="{{ route('peminjaman.index') }}"
               class="flex items-center gap-4 px-4 py-2.5 text-sm {{ request()->routeIs('peminjaman.*') ? 'bg-green-100 text-green-600 font-semibold' : 'text-gray-500 hover:bg-gray-100' }} rounded-lg transition">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                <span>Peminjaman</span>
            </a>

            <a href="{{ route('laporan.index') }}"
               class="flex items-center gap-4 px-4 py-2.5 text-sm {{ request()->routeIs('laporan.*') ? 'bg-green-100 text-green-600 font-semibold' : 'text-gray-500 hover:bg-gray-100' }} rounded-lg transition">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                <span>Laporan</span>
            </a>

             <a href="{{ route('users.index') }}"
               class="flex items-center gap-4 px-4 py-2.5 text-sm {{ request()->routeIs('users.*') ? 'bg-green-100 text-green-600 font-semibold' : 'text-gray-500 hover:bg-gray-100' }} rounded-lg transition">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                <span>Manajemen Akun</span>
            </a>
        </nav>
    </div>
    <div class="px-6 py-2 border-t">
        <p class="text-xs text-gray-400">© 2025 SARPRAS.</p>
    </div>
</aside>
