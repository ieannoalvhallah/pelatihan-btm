<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Sistem Informasi Persediaan</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>

<body class="min-h-screen bg-slate-100 flex items-center justify-center p-3 pb-16 sm:pb-4 font-sans text-slate-800 antialiased selection:bg-blue-900 selection:text-white">

    <div class="w-full max-w-[380px] my-auto">
        <!-- Main Card -->
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/70 border border-slate-200/90 p-5 sm:p-6">

            <!-- Logo & Brand Header (Horizontal Compact) -->
            <div class="flex items-center gap-3 mb-4 pb-3 border-b border-slate-100">
                <div class="w-10 h-10 bg-blue-900 rounded-xl flex items-center justify-center shrink-0 shadow-sm shadow-blue-900/20 text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-base font-bold text-slate-900 leading-tight">
                        Sistem Persediaan
                    </h1>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Silakan masuk menggunakan akun Anda
                    </p>
                </div>
            </div>

            <!-- Error Notification -->
            @if ($errors->any())
                <div class="mb-3 p-2.5 rounded-lg bg-red-50 border border-red-200 text-red-600 text-xs flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            @if (session('status'))
                <div class="mb-3 p-2.5 rounded-lg bg-blue-50 border border-blue-200 text-blue-700 text-xs flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('login.process') }}" method="POST" class="space-y-3">
                @csrf

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-700 mb-1">
                        Email
                    </label>
                    <div class="relative">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="nama@gmail.com"
                            required
                            autofocus
                            autocomplete="username"
                            class="w-full h-9 px-3 text-sm bg-white border {{ $errors->has('email') ? 'border-red-400 ring-1 ring-red-400' : 'border-slate-300' }} rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
                        >
                    </div>
                </div>

                <!-- Password Input -->
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label for="password" class="block text-xs font-semibold text-slate-700">
                            Password
                        </label>
                        <a href="#" class="text-[11px] text-blue-700 hover:text-blue-900 hover:underline">
                            Lupa password?
                        </a>
                    </div>
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            required
                            autocomplete="current-password"
                            class="w-full h-9 pl-3 pr-10 text-sm bg-white border {{ $errors->has('password') ? 'border-red-400 ring-1 ring-red-400' : 'border-slate-300' }} rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
                        >
                        <!-- Toggle Password Visibility -->
                        <button
                            type="button"
                            id="togglePassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none cursor-pointer"
                            title="Tampilkan / sembunyikan password"
                        >
                            <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eyeOffIcon" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <label class="flex items-center gap-2 text-xs text-slate-600 cursor-pointer select-none">
                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                            value="1"
                            class="w-3.5 h-3.5 rounded text-blue-900 border-slate-300 focus:ring-blue-600 cursor-pointer"
                        >
                        <span>Ingat saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full h-9 bg-blue-900 hover:bg-blue-800 active:bg-blue-950 text-white text-sm font-semibold rounded-lg shadow-sm hover:shadow transition duration-150 flex items-center justify-center cursor-pointer"
                >
                    Masuk ke Sistem
                </button>
            </form>

            <!-- Quick Demo Credentials Helper -->
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-500">
                <span>Demo: <span class="font-mono text-slate-700 font-medium">admin@example.com</span></span>
                <button
                    type="button"
                    id="fillDemoBtn"
                    class="text-blue-700 hover:text-blue-900 font-semibold cursor-pointer underline"
                >
                    Isi Akun
                </button>
            </div>

        </div>

        <!-- Footer -->
        <div class="mt-3 text-center">
            <p class="text-[11px] text-slate-400">
                &copy; {{ date('Y') }} Sistem Informasi Persediaan. All Rights Reserved.
            </p>
        </div>
    </div>

    <!-- Interactive Scripts -->
    <script>
        // Toggle Password Visibility
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');

        if (toggleBtn && passwordInput) {
            toggleBtn.addEventListener('click', function () {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                eyeIcon.classList.toggle('hidden', isPassword);
                eyeOffIcon.classList.toggle('hidden', !isPassword);
            });
        }

        // Fill Demo Account
        const fillDemoBtn = document.getElementById('fillDemoBtn');
        if (fillDemoBtn) {
            fillDemoBtn.addEventListener('click', function () {
                const emailInput = document.getElementById('email');
                if (emailInput && passwordInput) {
                    emailInput.value = 'admin@example.com';
                    passwordInput.value = 'password';
                    emailInput.focus();
                }
            });
        }
    </script>
</body>
</html>
