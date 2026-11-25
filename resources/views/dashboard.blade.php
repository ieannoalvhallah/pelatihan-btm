<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Persediaan</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="min-h-screen bg-slate-50 font-sans text-slate-800">
    <nav class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-900 text-white flex items-center justify-center font-bold text-lg shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-base font-bold text-slate-800 leading-tight">Sistem Persediaan</h1>
                        <p class="text-xs text-slate-500">Manajemen Barang & Kategori</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <div class="text-sm font-semibold text-slate-800">{{ auth()->user()->name }}</div>
                        <div class="text-xs text-slate-500">{{ auth()->user()->email }}</div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8">
            <h2 class="text-xl font-bold text-slate-800 mb-2">Selamat Datang, {{ auth()->user()->name }}!</h2>
            <p class="text-slate-600 mb-6">Anda telah berhasil masuk ke Sistem Informasi Persediaan.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="p-5 rounded-xl border border-slate-200 bg-slate-50 hover:bg-slate-100 transition">
                    <div class="text-sm font-medium text-slate-500 mb-1">Status Login</div>
                    <div class="text-lg font-bold text-emerald-600 flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        Aktif / Terotentikasi
                    </div>
                </div>

                <div class="p-5 rounded-xl border border-slate-200 bg-slate-50 hover:bg-slate-100 transition">
                    <div class="text-sm font-medium text-slate-500 mb-1">Waktu Sesi</div>
                    <div class="text-lg font-bold text-slate-800">{{ now()->format('d M Y, H:i') }}</div>
                </div>

                <div class="p-5 rounded-xl border border-slate-200 bg-slate-50 hover:bg-slate-100 transition">
                    <div class="text-sm font-medium text-slate-500 mb-1">Role / Akun</div>
                    <div class="text-lg font-bold text-blue-900">{{ auth()->user()->email }}</div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
