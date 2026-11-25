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

                <div class="flex items-center gap-3">
                    <a href="http://localhost:5173" target="_blank" class="hidden md:inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-blue-900 bg-blue-50 hover:bg-blue-100 rounded-lg border border-blue-200 transition">
                        <span>Buka Frontend (React)</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                    <div class="text-right hidden sm:block">
                        <div class="text-sm font-semibold text-slate-800">{{ auth()->user()->name }}</div>
                        <div class="text-xs text-slate-500">{{ auth()->user()->email }}</div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition cursor-pointer">
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

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
                <div class="p-5 rounded-xl border border-slate-200 bg-white shadow-xs">
                    <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Data Barang</div>
                    <div class="text-2xl font-bold text-slate-900">{{ $totalBarang ?? 0 }} <span class="text-xs font-normal text-slate-500">Item</span></div>
                </div>

                <div class="p-5 rounded-xl border border-slate-200 bg-white shadow-xs">
                    <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Kategori</div>
                    <div class="text-2xl font-bold text-slate-900">{{ $totalKategori ?? 0 }} <span class="text-xs font-normal text-slate-500">Kategori</span></div>
                </div>

                <div class="p-5 rounded-xl border border-slate-200 bg-white shadow-xs">
                    <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Akumulasi Stok</div>
                    <div class="text-2xl font-bold text-blue-900">{{ $totalStok ?? 0 }} <span class="text-xs font-normal text-slate-500">Unit</span></div>
                </div>
            </div>

            <!-- Recent Barang Table Preview -->
            <div class="mt-6">
                <h3 class="text-base font-bold text-slate-800 mb-3">Ringkasan Barang Terbaru</h3>
                <div class="overflow-x-auto border border-slate-200 rounded-xl">
                    <table class="w-full text-left text-sm text-slate-700">
                        <thead class="bg-slate-50 border-b border-slate-200 text-xs font-semibold uppercase text-slate-500">
                            <tr>
                                <th class="px-4 py-3">Kode</th>
                                <th class="px-4 py-3">Nama Barang</th>
                                <th class="px-4 py-3">Kategori</th>
                                <th class="px-4 py-3">Stok</th>
                                <th class="px-4 py-3">Harga Jual</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($recentBarangs ?? [] as $b)
                                <tr class="hover:bg-slate-50/60 transition">
                                    <td class="px-4 py-3 font-mono font-medium text-blue-900">{{ $b->kode_barang }}</td>
                                    <td class="px-4 py-3 font-medium text-slate-800">{{ $b->nama_barang }}</td>
                                    <td class="px-4 py-3"><span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700">{{ $b->kategori }}</span></td>
                                    <td class="px-4 py-3 font-semibold {{ $b->stok > 0 ? 'text-emerald-600' : 'text-rose-600' }}">{{ $b->stok }} {{ $b->satuan }}</td>
                                    <td class="px-4 py-3">Rp {{ number_format($b->harga_jual, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-slate-400">Belum ada data barang.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
