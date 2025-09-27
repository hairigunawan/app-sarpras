<!-- resources/views/components/header.blade.php -->
<header class="flex justify-end items-center w-full px-8 py-4 bg-white border-b border-gray-100">
    <div class="flex items-center gap-4">
        <!-- Anda bisa membuat data user ini dinamis nantinya -->
        <img src="https://placehold.co/40x40/E2E8F0/4A5568?text=A" alt="User Avatar" class="w-10 h-10 rounded-full object-cover">
        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800">
            <p class="font-semibold text-sm text-gray-800">Admin</p>
            <p class="text-xs text-gray-500">admin@sistem.com</p>
        </a>
    </div>
</header>
