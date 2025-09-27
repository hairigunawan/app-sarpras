<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center bg-white">
    <div class="w-[30%] max-w-md rounded-2xl shadow-2xl border border-gray-200">
        <div class="w-full max-w-md p-8 space-y-3 rounded-xl dark:bg-gray-800 dark:text-gray-800">
            <h1 class="text-2xl font-bold text-center">Login</h1>
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div class="space-y-1 text-sm">
                    <label for="email" class="block dark:text-gray-400">Username</label>
                    <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}"
                        required autocomplete="email" autofocus
                        class="w-full px-4 py-3 rounded-md dark:bg-gray-50 dark:text-gray-800">

                    @error('email')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1 text-sm">
                    <label for="password" class="block dark:text-gray-400">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" required
                        autocomplete="current-password"
                        class="w-full px-4 py-3 rounded-md dark:border-gray-300 dark:bg-gray-50 dark:text-gray-800 focus:dark:border-violet-600">

                    @error('password')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="block w-full p-3 text-center rounded-sm dark:text-gray-50 dark:bg-violet-600">Sign
                    in</button>
            </form>
            <div class="flex items-center pt-4 space-x-1">
                <div class="flex-1 h-px sm:w-16 dark:bg-gray-300"></div>
                <p class="px-3 text-sm dark:text-gray-300">Login with Google</p>
                <div class="flex-1 h-px sm:w-16 dark:bg-gray-300"></div>
            </div>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('login.google') }}" aria-label="Log in with Google" class="p-3 rounded-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-5 h-5 fill-current text-white">
                        <path
                            d="M16.318 13.714v5.484h9.078c-0.37 2.354-2.745 6.901-9.078 6.901-5.458 0-9.917-4.521-9.917-10.099s4.458-10.099 9.917-10.099c3.109 0 5.193 1.318 6.38 2.464l4.339-4.182c-2.786-2.599-6.396-4.182-10.719-4.182-8.844 0-16 7.151-16 16s7.156 16 16 16c9.234 0 15.365-6.49 15.365-15.635 0-1.052-0.115-1.854-0.255-2.651z">
                        </path>
                    </svg>
                </a>
            </div>
            <div class="text-center">
                <a href="{{ route('dashboard') }}" class="text-sm font-medium text-blue-500 hover:underline">
                    ← Kembali ke Halaman Utama
                </a>
            </div>
        </div>
</body>
</html>
