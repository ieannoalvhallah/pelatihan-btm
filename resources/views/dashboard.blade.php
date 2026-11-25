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
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Instrument Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-slate-100 font-sans text-slate-800 antialiased">

    <!-- ================= SIDEBAR SEBELAH KIRI ================= -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-56 sm:w-60 bg-slate-900 border-r border-slate-800 flex flex-col justify-between shadow-xl">
        <div>
            <!-- Sidebar Header / Branding -->
            <div class="h-16 flex items-center gap-3 px-4 sm:px-5 border-b border-slate-800/80 bg-slate-950/60">
                <div class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-base shadow-sm shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <h1 class="text-sm font-bold text-white tracking-tight truncate">Sistem Persediaan</h1>
                    <p class="text-[10px] text-slate-400 truncate">Inventory & Penjualan</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="px-3 py-4 space-y-1.5">
                <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-2">Menu Navigasi</p>

                <!-- Menu Dashboard -->
                <button
                    type="button"
                    onclick="navigateToMenu('dashboard')"
                    id="nav-dashboard"
                    class="nav-link w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition cursor-pointer text-white bg-blue-600 shadow-sm"
                >
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                        <span>Dashboard</span>
                    </div>
                </button>

                <!-- Menu Data Barang -->
                <button
                    type="button"
                    onclick="navigateToMenu('barang')"
                    id="nav-barang"
                    class="nav-link w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-medium text-slate-300 hover:text-white hover:bg-slate-800 transition cursor-pointer"
                >
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 shrink-0 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <span>Data Barang</span>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-800 text-slate-300">{{ count($barangs ?? []) }}</span>
                </button>

                <!-- Menu Data Kategori -->
                <button
                    type="button"
                    onclick="navigateToMenu('kategori')"
                    id="nav-kategori"
                    class="nav-link w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-medium text-slate-300 hover:text-white hover:bg-slate-800 transition cursor-pointer"
                >
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 shrink-0 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <span>Data Kategori</span>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-800 text-slate-300">{{ count($kategoris ?? []) }}</span>
                </button>

                <!-- Menu Penjualan Barang -->
                <button
                    type="button"
                    onclick="navigateToMenu('penjualan')"
                    id="nav-penjualan"
                    class="nav-link w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-medium text-slate-300 hover:text-white hover:bg-slate-800 transition cursor-pointer"
                >
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 shrink-0 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="font-semibold text-emerald-300">Penjualan Barang</span>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-950 text-emerald-400 border border-emerald-800/60">{{ count($penjualans ?? []) }}</span>
                </button>
            </div>
        </div>

        <!-- Sidebar Footer / User Profile & Logout -->
        <div class="p-3.5 pb-16 sm:pb-4 border-t border-slate-800 bg-slate-950/70">
            <div class="flex items-center gap-2.5 mb-3 min-w-0">
                <div class="w-8 h-8 rounded-lg bg-blue-900 text-blue-200 flex items-center justify-center font-bold text-xs shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <div class="text-xs font-semibold text-white truncate">{{ auth()->user()->name }}</div>
                    <div class="text-[10px] text-slate-400 truncate">{{ auth()->user()->email }}</div>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button
                    type="submit"
                    class="w-full flex items-center justify-center gap-2 py-2 px-3 text-xs font-semibold text-rose-300 bg-rose-950/40 hover:bg-rose-900/60 border border-rose-900/50 rounded-lg transition cursor-pointer"
                >
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Keluar Sistem</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- ================= MAIN CONTENT AREA (SEBELAH KANAN) ================= -->
    <div class="pl-56 sm:pl-60 flex flex-col min-h-screen">

        <!-- Top Header Bar -->
        <header class="h-16 bg-white border-b border-slate-200 sticky top-0 z-20 flex items-center justify-between px-4 sm:px-6 shadow-xs">
            <div>
                <h2 id="topbar-title" class="text-base sm:text-lg font-bold text-slate-900 leading-tight">Dashboard Persediaan</h2>
                <p id="topbar-desc" class="text-[11px] text-slate-500">Sistem Informasi Persediaan & Transaksi</p>
            </div>

            <!-- Header Right Quick Actions -->
            <div class="flex items-center gap-2.5">
                <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ now()->format('d M Y') }}</span>
                </span>

                <button
                    type="button"
                    onclick="openModal('modalBarang')"
                    id="topbar-btn-barang"
                    class="hidden items-center gap-1.5 px-3.5 py-1.5 bg-blue-900 hover:bg-blue-800 text-white text-xs font-semibold rounded-lg shadow-sm transition cursor-pointer"
                >
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Tambah Barang</span>
                </button>

                <button
                    type="button"
                    onclick="openModal('modalKategori')"
                    id="topbar-btn-kategori"
                    class="hidden items-center gap-1.5 px-3.5 py-1.5 bg-indigo-700 hover:bg-indigo-800 text-white text-xs font-semibold rounded-lg shadow-sm transition cursor-pointer"
                >
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Tambah Kategori</span>
                </button>

                <button
                    type="button"
                    onclick="openModal('modalPenjualan')"
                    id="topbar-btn-penjualan"
                    class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white text-xs font-semibold rounded-lg shadow-sm transition cursor-pointer"
                >
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Catat Penjualan</span>
                </button>
            </div>
        </header>

        <!-- Main Workspace -->
        <main class="flex-1 p-4 sm:p-8">

            <!-- Flash Notifications -->
            @if (session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-xs">
                    <div class="flex items-center gap-2.5 text-xs sm:text-sm font-medium">
                        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 text-xl leading-none cursor-pointer">&times;</button>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 shadow-xs">
                    <div class="flex items-start gap-2.5 text-xs sm:text-sm">
                        <svg class="w-5 h-5 text-rose-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>
                            <span class="font-semibold">Terjadi kesalahan:</span>
                            <ul class="list-disc list-inside mt-1 text-xs text-rose-700 space-y-0.5">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- ================= PANEL 1: DASHBOARD ================= -->
            <div id="panel-dashboard" class="content-panel space-y-6">
                <!-- KPI Stat Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
                    <!-- Total Barang -->
                    <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-xs">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Barang</span>
                            <span class="p-2 rounded-xl bg-blue-50 text-blue-900">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </span>
                        </div>
                        <div class="text-2xl font-bold text-slate-900">{{ $totalBarang ?? 0 }} <span class="text-xs font-normal text-slate-500">Item</span></div>
                        <p class="text-[11px] text-slate-500 mt-1">Produk dalam database</p>
                    </div>

                    <!-- Total Kategori -->
                    <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-xs">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</span>
                            <span class="p-2 rounded-xl bg-indigo-50 text-indigo-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </span>
                        </div>
                        <div class="text-2xl font-bold text-slate-900">{{ $totalKategori ?? 0 }} <span class="text-xs font-normal text-slate-500">Kategori</span></div>
                        <p class="text-[11px] text-slate-500 mt-1">Pengelompokan barang</p>
                    </div>

                    <!-- Total Stok -->
                    <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-xs">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Akumulasi Stok</span>
                            <span class="p-2 rounded-xl bg-amber-50 text-amber-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </span>
                        </div>
                        <div class="text-2xl font-bold text-slate-900">{{ number_format($totalStok ?? 0, 0, ',', '.') }} <span class="text-xs font-normal text-slate-500">Unit</span></div>
                        <p class="text-[11px] text-slate-500 mt-1">Total fisik semua stok</p>
                    </div>

                    <!-- Total Penjualan & Omzet -->
                    <div class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-xs">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Penjualan</span>
                            <span class="p-2 rounded-xl bg-emerald-50 text-emerald-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </span>
                        </div>
                        <div class="text-xl font-bold text-emerald-700">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</div>
                        <p class="text-[11px] text-slate-500 mt-1">{{ $totalPenjualan ?? 0 }} Transaksi Berhasil</p>
                    </div>
                </div>

                <!-- Two-Column Overview -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Recent Sales Preview -->
                    <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-xs">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                                <span>🛒 Transaksi Penjualan Terbaru</span>
                            </h3>
                            <button type="button" onclick="navigateToMenu('penjualan')" class="text-xs font-semibold text-emerald-700 hover:underline cursor-pointer">Lihat Semua &rarr;</button>
                        </div>
                        <div class="overflow-x-auto border border-slate-100 rounded-xl">
                            <table class="w-full text-left text-xs text-slate-700">
                                <thead class="bg-slate-50 text-slate-500 uppercase font-semibold">
                                    <tr>
                                        <th class="px-3.5 py-2.5">No Faktur</th>
                                        <th class="px-3.5 py-2.5">Barang</th>
                                        <th class="px-3.5 py-2.5">Qty</th>
                                        <th class="px-3.5 py-2.5">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse ($penjualans->take(5) as $pj)
                                        <tr class="hover:bg-slate-50/60">
                                            <td class="px-3.5 py-2.5 font-mono font-medium text-emerald-800">{{ $pj->no_transaksi }}</td>
                                            <td class="px-3.5 py-2.5 font-medium text-slate-800">{{ $pj->barang ? $pj->barang->nama_barang : 'Barang Terhapus' }}</td>
                                            <td class="px-3.5 py-2.5 font-semibold text-slate-900">{{ $pj->jumlah }}</td>
                                            <td class="px-3.5 py-2.5 font-bold text-slate-900">Rp {{ number_format($pj->total_harga, 0, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-4 py-6 text-center text-slate-400">Belum ada transaksi penjualan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Recent Stock Overview -->
                    <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-xs">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                                <span>📦 Ringkasan Stok Barang</span>
                            </h3>
                            <button type="button" onclick="navigateToMenu('barang')" class="text-xs font-semibold text-blue-900 hover:underline cursor-pointer">Kelola Barang &rarr;</button>
                        </div>
                        <div class="overflow-x-auto border border-slate-100 rounded-xl">
                            <table class="w-full text-left text-xs text-slate-700">
                                <thead class="bg-slate-50 text-slate-500 uppercase font-semibold">
                                    <tr>
                                        <th class="px-3.5 py-2.5">Kode</th>
                                        <th class="px-3.5 py-2.5">Nama Barang</th>
                                        <th class="px-3.5 py-2.5">Stok</th>
                                        <th class="px-3.5 py-2.5">Harga Jual</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse ($barangs->take(5) as $b)
                                        <tr class="hover:bg-slate-50/60">
                                            <td class="px-3.5 py-2.5 font-mono font-medium text-blue-900">{{ $b->kode_barang }}</td>
                                            <td class="px-3.5 py-2.5 font-medium text-slate-800">{{ $b->nama_barang }}</td>
                                            <td class="px-3.5 py-2.5 font-bold {{ $b->stok > 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                                {{ $b->stok }} {{ $b->satuan }}
                                            </td>
                                            <td class="px-3.5 py-2.5 font-semibold text-slate-900">Rp {{ number_format($b->harga_jual, 0, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-4 py-6 text-center text-slate-400">Belum ada data barang.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================= PANEL 2: DATA BARANG ================= -->
            <div id="panel-barang" class="content-panel hidden space-y-4">
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs sm:text-sm text-slate-700 whitespace-nowrap">
                            <thead class="bg-slate-50 border-b border-slate-200 text-xs font-semibold uppercase text-slate-500">
                                <tr>
                                    <th class="px-4 py-3">Kode</th>
                                    <th class="px-4 py-3">Nama Barang</th>
                                    <th class="px-4 py-3">Kategori</th>
                                    <th class="px-4 py-3">Harga Beli</th>
                                    <th class="px-4 py-3">Harga Jual</th>
                                    <th class="px-4 py-3">Stok</th>
                                    <th class="px-4 py-3">Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($barangs ?? [] as $b)
                                    <tr class="hover:bg-slate-50/70 transition">
                                        <td class="px-4 py-3 font-mono font-bold text-blue-900 text-xs">{{ $b->kode_barang }}</td>
                                        <td class="px-4 py-3 font-semibold text-slate-900">{{ $b->nama_barang }}</td>
                                        <td class="px-4 py-3">
                                            <span class="px-2.5 py-0.5 rounded-md text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                                {{ $b->kategori ?: '-' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-slate-600">Rp {{ number_format($b->harga_beli, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 font-medium text-slate-900">Rp {{ number_format($b->harga_jual, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3">
                                            <span class="font-bold {{ $b->stok > 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                                {{ $b->stok }}
                                            </span>
                                            <span class="text-xs text-slate-500 font-normal">{{ $b->satuan }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-xs text-slate-500 max-w-xs truncate" title="{{ $b->deskripsi }}">
                                            {{ $b->deskripsi ?: '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-10 text-center text-slate-400">
                                            Belum ada data barang. Silakan klik tombol <b>Tambah Barang</b> di atas.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ================= PANEL 3: DATA KATEGORI ================= -->
            <div id="panel-kategori" class="content-panel hidden space-y-4">
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs sm:text-sm text-slate-700 whitespace-nowrap">
                            <thead class="bg-slate-50 border-b border-slate-200 text-xs font-semibold uppercase text-slate-500">
                                <tr>
                                    <th class="px-4 py-3 w-16">No</th>
                                    <th class="px-4 py-3">Nama Kategori</th>
                                    <th class="px-4 py-3">Deskripsi</th>
                                    <th class="px-4 py-3">Tanggal Dibuat</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($kategoris ?? [] as $idx => $k)
                                    <tr class="hover:bg-slate-50/70 transition">
                                        <td class="px-4 py-3 text-xs text-slate-400 font-mono">{{ $idx + 1 }}</td>
                                        <td class="px-4 py-3 font-semibold text-slate-900">{{ $k->nama_kategori }}</td>
                                        <td class="px-4 py-3 text-xs text-slate-500">{{ $k->deskripsi ?: '-' }}</td>
                                        <td class="px-4 py-3 text-xs text-slate-500">{{ $k->created_at ? $k->created_at->format('d M Y, H:i') : '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-10 text-center text-slate-400">
                                            Belum ada data kategori. Silakan klik tombol <b>Tambah Kategori</b> di atas.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ================= PANEL 4: PENJUALAN BARANG ================= -->
            <div id="panel-penjualan" class="content-panel hidden space-y-4">
                <!-- Penjualan Stats Summary Banner -->
                <div class="p-5 rounded-2xl bg-gradient-to-r from-emerald-800 via-teal-800 to-slate-900 text-white shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <span class="text-xs font-semibold text-emerald-200 uppercase tracking-wider">Total Omzet Penjualan</span>
                        <div class="text-3xl font-bold mt-1">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</div>
                    </div>
                    <div class="flex items-center gap-4 text-xs">
                        <div class="bg-white/10 px-3.5 py-2 rounded-xl backdrop-blur-xs">
                            <span class="text-emerald-200 block">Total Transaksi</span>
                            <span class="text-lg font-bold">{{ $totalPenjualan ?? 0 }} Transaksi</span>
                        </div>
                    </div>
                </div>

                <!-- Table Penjualan -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs sm:text-sm text-slate-700 whitespace-nowrap">
                            <thead class="bg-slate-50 border-b border-slate-200 text-xs font-semibold uppercase text-slate-500">
                                <tr>
                                    <th class="px-4 py-3">No Transaksi</th>
                                    <th class="px-4 py-3">Tanggal</th>
                                    <th class="px-4 py-3">Pelanggan</th>
                                    <th class="px-4 py-3">Barang</th>
                                    <th class="px-4 py-3">Qty</th>
                                    <th class="px-4 py-3">Harga Satuan</th>
                                    <th class="px-4 py-3">Total Harga</th>
                                    <th class="px-4 py-3">Catatan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($penjualans ?? [] as $p)
                                    <tr class="hover:bg-slate-50/70 transition">
                                        <td class="px-4 py-3 font-mono font-bold text-emerald-800 text-xs">{{ $p->no_transaksi }}</td>
                                        <td class="px-4 py-3 text-slate-600 text-xs">{{ $p->tanggal_penjualan ? $p->tanggal_penjualan->format('d M Y') : '-' }}</td>
                                        <td class="px-4 py-3 font-medium text-slate-800">{{ $p->nama_pelanggan }}</td>
                                        <td class="px-4 py-3 font-semibold text-slate-900">
                                            {{ $p->barang ? $p->barang->nama_barang : 'Barang Terhapus' }}
                                        </td>
                                        <td class="px-4 py-3 font-bold text-slate-900">
                                            {{ $p->jumlah }} <span class="text-xs font-normal text-slate-500">{{ $p->barang ? $p->barang->satuan : '' }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-slate-600">Rp {{ number_format($p->harga_satuan, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 font-bold text-emerald-700">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-xs text-slate-500 max-w-xs truncate" title="{{ $p->catatan }}">{{ $p->catatan ?: '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-4 py-12 text-center text-slate-400">
                                            Belum ada transaksi penjualan tercatat. Silakan klik tombol <b>+ Catat Penjualan Baru</b>.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- ================= MODAL PENJUALAN BARANG ================= -->
    <div id="modalPenjualan" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl border border-slate-200 max-w-lg w-full max-h-[90vh] overflow-y-auto p-6 transition-all">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-emerald-600 text-white flex items-center justify-center font-bold text-sm">
                        🛒
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900">Catat Penjualan Barang</h3>
                        <p class="text-xs text-slate-500">Stok barang akan otomatis berkurang sesuai jumlah jual</p>
                    </div>
                </div>
                <button type="button" onclick="closeModal('modalPenjualan')" class="text-slate-400 hover:text-slate-600 text-2xl leading-none cursor-pointer">&times;</button>
            </div>

            <form action="{{ route('penjualans.store.web') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Pilih Barang -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Pilih Barang *</label>
                    <select
                        id="select_barang_id"
                        name="barang_id"
                        required
                        onchange="handleBarangChange(this)"
                        class="w-full h-10 px-3 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none bg-white"
                    >
                        <option value="">-- Pilih Barang yang Akan Dijual --</option>
                        @foreach ($barangs ?? [] as $brg)
                            <option
                                value="{{ $brg->id }}"
                                data-harga="{{ $brg->harga_jual }}"
                                data-stok="{{ $brg->stok }}"
                                data-satuan="{{ $brg->satuan }}"
                                {{ $brg->stok <= 0 ? 'disabled' : '' }}
                            >
                                {{ $brg->kode_barang }} - {{ $brg->nama_barang }} (Stok: {{ $brg->stok }} {{ $brg->satuan }}) - Rp {{ number_format($brg->harga_jual, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Info Box Barang Terpilih -->
                <div id="infoBarangBox" class="hidden p-3 rounded-xl bg-slate-50 border border-slate-200 text-xs space-y-1">
                    <div class="flex justify-between">
                        <span class="text-slate-500">Stok Tersedia:</span>
                        <span id="infoStokTersedia" class="font-bold text-slate-900">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Harga Jual Satuan:</span>
                        <span id="infoHargaSatuan" class="font-bold text-emerald-700">Rp 0</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <!-- Jumlah Terjual -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Jumlah Jual (Qty) *</label>
                        <input
                            type="number"
                            id="inputJumlahJual"
                            name="jumlah"
                            value="1"
                            min="1"
                            required
                            oninput="calculateTotalPenjualan()"
                            class="w-full h-9 px-3 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none"
                        >
                    </div>

                    <!-- Tanggal Penjualan -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal Transaksi *</label>
                        <input
                            type="date"
                            name="tanggal_penjualan"
                            value="{{ date('Y-m-d') }}"
                            required
                            class="w-full h-9 px-3 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none bg-white"
                        >
                    </div>
                </div>

                <!-- Nama Pelanggan -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Pembeli / Pelanggan</label>
                    <input
                        type="text"
                        name="nama_pelanggan"
                        placeholder="Contoh: Bpk. Ahmad / Pelanggan Umum"
                        value="Pelanggan Umum"
                        class="w-full h-9 px-3 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none"
                    >
                </div>

                <!-- Estimasi Total Harga -->
                <div class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-between">
                    <span class="text-xs font-semibold text-emerald-800">Total Pembayaran:</span>
                    <span id="textTotalHarga" class="text-base font-bold text-emerald-900">Rp 0</span>
                </div>

                <!-- Catatan -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Catatan Tambahan</label>
                    <textarea
                        name="catatan"
                        rows="2"
                        placeholder="Catatan transaksi penjualan..."
                        class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none"
                    ></textarea>
                </div>

                <!-- Modal Actions -->
                <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-slate-100">
                    <button
                        type="button"
                        onclick="closeModal('modalPenjualan')"
                        class="px-4 py-2 text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition cursor-pointer"
                    >
                        Batal
                    </button>
                    <button
                        type="submit"
                        class="px-5 py-2 text-xs font-semibold text-white bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 rounded-lg shadow-sm transition cursor-pointer"
                    >
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ================= MODAL TAMBAH BARANG ================= -->
    <div id="modalBarang" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl border border-slate-200 max-w-lg w-full max-h-[90vh] overflow-y-auto p-6 transition-all">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-blue-900 text-white flex items-center justify-center font-bold text-sm">
                        📦
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900">Tambah Barang Baru</h3>
                        <p class="text-xs text-slate-500">Masukkan rincian data barang persediaan</p>
                    </div>
                </div>
                <button type="button" onclick="closeModal('modalBarang')" class="text-slate-400 hover:text-slate-600 text-2xl leading-none cursor-pointer">&times;</button>
            </div>

            <form action="{{ route('barangs.store.web') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Kode Barang *</label>
                        <input
                            type="text"
                            name="kode_barang"
                            placeholder="Contoh: BRG004"
                            required
                            class="w-full h-9 px-3 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none"
                        >
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Barang *</label>
                        <input
                            type="text"
                            name="nama_barang"
                            placeholder="Contoh: Spidol Permanen"
                            required
                            class="w-full h-9 px-3 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none"
                        >
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Kategori</label>
                        <select
                            name="kategori"
                            class="w-full h-9 px-3 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none bg-white"
                        >
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategoris ?? [] as $k)
                                <option value="{{ $k->nama_kategori }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Satuan *</label>
                        <select
                            name="satuan"
                            required
                            class="w-full h-9 px-3 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none bg-white"
                        >
                            <option value="pcs">pcs</option>
                            <option value="box">box</option>
                            <option value="unit">unit</option>
                            <option value="kg">kg</option>
                            <option value="pack">pack</option>
                            <option value="rim">rim</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Stok Awal *</label>
                        <input
                            type="number"
                            name="stok"
                            value="0"
                            min="0"
                            required
                            class="w-full h-9 px-3 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none"
                        >
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Harga Beli (Rp) *</label>
                        <input
                            type="number"
                            name="harga_beli"
                            placeholder="0"
                            min="0"
                            step="0.01"
                            required
                            class="w-full h-9 px-3 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none"
                        >
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Harga Jual (Rp) *</label>
                        <input
                            type="number"
                            name="harga_jual"
                            placeholder="0"
                            min="0"
                            step="0.01"
                            required
                            class="w-full h-9 px-3 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none"
                        >
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Deskripsi</label>
                    <textarea
                        name="deskripsi"
                        rows="2"
                        placeholder="Deskripsi singkat barang..."
                        class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none"
                    ></textarea>
                </div>

                <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-slate-100">
                    <button
                        type="button"
                        onclick="closeModal('modalBarang')"
                        class="px-4 py-2 text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition cursor-pointer"
                    >
                        Batal
                    </button>
                    <button
                        type="submit"
                        class="px-5 py-2 text-xs font-semibold text-white bg-blue-900 hover:bg-blue-800 active:bg-blue-950 rounded-lg shadow-xs transition cursor-pointer"
                    >
                        Simpan Barang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ================= MODAL TAMBAH KATEGORI ================= -->
    <div id="modalKategori" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl border border-slate-200 max-w-md w-full p-6 transition-all">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-indigo-700 text-white flex items-center justify-center font-bold text-sm">
                        🏷️
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900">Tambah Kategori Baru</h3>
                        <p class="text-xs text-slate-500">Masukkan nama kategori untuk pengelompokan barang</p>
                    </div>
                </div>
                <button type="button" onclick="closeModal('modalKategori')" class="text-slate-400 hover:text-slate-600 text-2xl leading-none cursor-pointer">&times;</button>
            </div>

            <form action="{{ route('kategoris.store.web') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Kategori *</label>
                    <input
                        type="text"
                        name="nama_kategori"
                        placeholder="Contoh: Alat Tulis Kantor"
                        required
                        class="w-full h-9 px-3 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 outline-none"
                    >
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Deskripsi</label>
                    <textarea
                        name="deskripsi"
                        rows="3"
                        placeholder="Keterangan opsional tentang kategori ini..."
                        class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 outline-none"
                    ></textarea>
                </div>

                <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-slate-100">
                    <button
                        type="button"
                        onclick="closeModal('modalKategori')"
                        class="px-4 py-2 text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition cursor-pointer"
                    >
                        Batal
                    </button>
                    <button
                        type="submit"
                        class="px-5 py-2 text-xs font-semibold text-white bg-indigo-700 hover:bg-indigo-800 active:bg-indigo-900 rounded-lg shadow-xs transition cursor-pointer"
                    >
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ================= INTERACTIVE JAVASCRIPT ================= -->
    <script>
        let currentSelectedHarga = 0;

        function openModal(id) {
            const modal = document.getElementById(id);
            if (modal) modal.classList.remove('hidden');
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            if (modal) modal.classList.add('hidden');
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }

        function navigateToMenu(menuKey) {
            // Update URL tanpa reload
            const url = new URL(window.location);
            url.searchParams.set('menu', menuKey);
            window.history.pushState({}, '', url);

            // Hide all content panels
            document.querySelectorAll('.content-panel').forEach(panel => {
                panel.classList.add('hidden');
            });

            // Show selected panel
            const targetPanel = document.getElementById('panel-' + menuKey);
            if (targetPanel) {
                targetPanel.classList.remove('hidden');
            }

            // Update Topbar Title, Subtitle & Action Buttons
            const topbarTitle = document.getElementById('topbar-title');
            const topbarDesc = document.getElementById('topbar-desc');
            const btnBarang = document.getElementById('topbar-btn-barang');
            const btnKategori = document.getElementById('topbar-btn-kategori');
            const btnPenjualan = document.getElementById('topbar-btn-penjualan');

            if (menuKey === 'dashboard') {
                topbarTitle.innerText = 'Dashboard Persediaan';
                if (topbarDesc) topbarDesc.innerText = 'Sistem Informasi Persediaan & Transaksi';
                if (btnBarang) btnBarang.classList.add('hidden');
                if (btnKategori) btnKategori.classList.add('hidden');
                if (btnPenjualan) { btnPenjualan.classList.remove('hidden'); btnPenjualan.classList.add('inline-flex'); }
            } else if (menuKey === 'barang') {
                topbarTitle.innerText = 'Master Data Barang';
                if (topbarDesc) topbarDesc.innerText = 'Daftar dan kelola stok barang';
                if (btnBarang) { btnBarang.classList.remove('hidden'); btnBarang.classList.add('inline-flex'); }
                if (btnKategori) btnKategori.classList.add('hidden');
                if (btnPenjualan) btnPenjualan.classList.add('hidden');
            } else if (menuKey === 'kategori') {
                topbarTitle.innerText = 'Master Data Kategori';
                if (topbarDesc) topbarDesc.innerText = 'Daftar pengelompokan jenis barang';
                if (btnBarang) btnBarang.classList.add('hidden');
                if (btnKategori) { btnKategori.classList.remove('hidden'); btnKategori.classList.add('inline-flex'); }
                if (btnPenjualan) btnPenjualan.classList.add('hidden');
            } else if (menuKey === 'penjualan') {
                topbarTitle.innerText = 'Transaksi Penjualan Barang';
                if (topbarDesc) topbarDesc.innerText = 'Catat penjualan dan pantau stok keluar otomatis';
                if (btnBarang) btnBarang.classList.add('hidden');
                if (btnKategori) btnKategori.classList.add('hidden');
                if (btnPenjualan) { btnPenjualan.classList.remove('hidden'); btnPenjualan.classList.add('inline-flex'); }
            }

            // Update Sidebar Navigation Active States
            document.querySelectorAll('.nav-link').forEach(link => {
                link.className = 'nav-link w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-medium text-slate-300 hover:text-white hover:bg-slate-800/80 transition cursor-pointer';
            });

            const activeBtn = document.getElementById('nav-' + menuKey);
            if (activeBtn) {
                if (menuKey === 'penjualan') {
                    activeBtn.className = 'nav-link w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition cursor-pointer text-white bg-emerald-700 shadow-sm';
                } else {
                    activeBtn.className = 'nav-link w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition cursor-pointer text-white bg-blue-600/90 shadow-sm';
                }
            }
        }

        function handleBarangChange(select) {
            const selectedOption = select.options[select.selectedIndex];
            const infoBox = document.getElementById('infoBarangBox');

            if (!select.value) {
                infoBox.classList.add('hidden');
                currentSelectedHarga = 0;
                calculateTotalPenjualan();
                return;
            }

            const harga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
            const stok = parseInt(selectedOption.getAttribute('data-stok')) || 0;
            const satuan = selectedOption.getAttribute('data-satuan') || '';

            currentSelectedHarga = harga;
            document.getElementById('infoStokTersedia').innerText = stok + ' ' + satuan;
            document.getElementById('infoHargaSatuan').innerText = 'Rp ' + Number(harga).toLocaleString('id-ID');

            const inputJumlah = document.getElementById('inputJumlahJual');
            inputJumlah.setAttribute('max', stok);

            infoBox.classList.remove('hidden');
            calculateTotalPenjualan();
        }

        function calculateTotalPenjualan() {
            const qty = parseInt(document.getElementById('inputJumlahJual').value) || 0;
            const total = qty * currentSelectedHarga;
            document.getElementById('textTotalHarga').innerText = 'Rp ' + Number(total).toLocaleString('id-ID');
        }

        // Initialize active menu from URL param or default to dashboard
        document.addEventListener('DOMContentLoaded', function () {
            const params = new URLSearchParams(window.location.search);
            const menu = params.get('menu') || '{{ $activeMenu ?? "dashboard" }}';
            navigateToMenu(menu);
        });

        // Close modal when clicking backdrop
        window.addEventListener('click', function(e) {
            if (e.target.id === 'modalBarang') closeModal('modalBarang');
            if (e.target.id === 'modalKategori') closeModal('modalKategori');
            if (e.target.id === 'modalPenjualan') closeModal('modalPenjualan');
        });
    </script>
</body>
</html>
