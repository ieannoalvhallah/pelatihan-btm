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
<body class="min-h-screen bg-slate-50 font-sans text-slate-800 antialiased">
    <!-- Navbar -->
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-900 text-white flex items-center justify-center font-bold text-lg shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-base font-bold text-slate-900 leading-tight">Sistem Persediaan</h1>
                        <p class="text-xs text-slate-500">Manajemen Barang & Kategori</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="http://localhost:5173" target="_blank" class="hidden md:inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-blue-900 bg-blue-50 hover:bg-blue-100 rounded-lg border border-blue-200 transition">
                        <span>Buka Frontend React</span>
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

    <!-- Main Container -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-2.5 text-sm font-medium">
                    <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 text-lg leading-none cursor-pointer">&times;</button>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 shadow-xs">
                <div class="flex items-start gap-2.5 text-sm">
                    <svg class="w-5 h-5 text-rose-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div>
                        <span class="font-semibold">Terjadi kesalahan validasi:</span>
                        <ul class="list-disc list-inside mt-1 text-xs text-rose-700 space-y-0.5">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Action Bar & Greeting -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Dashboard Persediaan</h2>
                <p class="text-sm text-slate-500 mt-0.5">Ringkasan stok barang dan master data kategori.</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3">
                <button
                    type="button"
                    onclick="openModal('modalKategori')"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white text-sm font-semibold rounded-xl shadow-xs transition duration-150 cursor-pointer"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Tambah Kategori</span>
                </button>

                <button
                    type="button"
                    onclick="openModal('modalBarang')"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-900 hover:bg-blue-800 active:bg-blue-950 text-white text-sm font-semibold rounded-xl shadow-xs transition duration-150 cursor-pointer"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Tambah Barang</span>
                </button>
            </div>
        </div>

        <!-- Metric KPI Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
            <div class="p-5 rounded-2xl border border-slate-200/90 bg-white shadow-xs">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Barang</span>
                    <span class="p-2 rounded-xl bg-blue-50 text-blue-900">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </span>
                </div>
                <div class="text-3xl font-bold text-slate-900">{{ $totalBarang ?? 0 }}</div>
                <p class="text-xs text-slate-500 mt-1">Item terdaftar dalam sistem</p>
            </div>

            <div class="p-5 rounded-2xl border border-slate-200/90 bg-white shadow-xs">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Kategori</span>
                    <span class="p-2 rounded-xl bg-emerald-50 text-emerald-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </span>
                </div>
                <div class="text-3xl font-bold text-slate-900">{{ $totalKategori ?? 0 }}</div>
                <p class="text-xs text-slate-500 mt-1">Kategori barang aktif</p>
            </div>

            <div class="p-5 rounded-2xl border border-slate-200/90 bg-white shadow-xs">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Akumulasi Stok</span>
                    <span class="p-2 rounded-xl bg-indigo-50 text-indigo-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </span>
                </div>
                <div class="text-3xl font-bold text-blue-900">{{ number_format($totalStok ?? 0, 0, ',', '.') }}</div>
                <p class="text-xs text-slate-500 mt-1">Total unit stok saat ini</p>
            </div>
        </div>

        <!-- Tabbed Master Data Card -->
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden">
            <!-- Tab Headers -->
            <div class="border-b border-slate-200 px-6 pt-4 flex gap-6">
                <button
                    type="button"
                    onclick="switchTab('tabBarang')"
                    id="btnTabBarang"
                    class="pb-3 text-sm font-semibold text-blue-900 border-b-2 border-blue-900 transition flex items-center gap-2 cursor-pointer"
                >
                    <span>📦 Data Barang</span>
                    <span class="px-2 py-0.5 rounded-full text-xs bg-blue-100 text-blue-900 font-bold">{{ count($barangs ?? []) }}</span>
                </button>
                <button
                    type="button"
                    onclick="switchTab('tabKategori')"
                    id="btnTabKategori"
                    class="pb-3 text-sm font-semibold text-slate-500 hover:text-slate-700 border-b-2 border-transparent transition flex items-center gap-2 cursor-pointer"
                >
                    <span>🏷️ Data Kategori</span>
                    <span class="px-2 py-0.5 rounded-full text-xs bg-slate-100 text-slate-700 font-bold">{{ count($kategoris ?? []) }}</span>
                </button>
            </div>

            <!-- Content Tab: Barang -->
            <div id="tabBarang" class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-bold text-slate-900">Daftar Barang</h3>
                    <button
                        type="button"
                        onclick="openModal('modalBarang')"
                        class="text-xs font-semibold text-blue-900 hover:text-blue-700 underline cursor-pointer"
                    >
                        + Tambah Barang Baru
                    </button>
                </div>
                <div class="overflow-x-auto border border-slate-200 rounded-xl">
                    <table class="w-full text-left text-sm text-slate-700">
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
                                    <td colspan="7" class="px-4 py-8 text-center text-slate-400">
                                        Belum ada data barang. Silakan klik tombol <b>Tambah Barang</b> di atas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Content Tab: Kategori -->
            <div id="tabKategori" class="p-6 hidden">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-bold text-slate-900">Daftar Kategori</h3>
                    <button
                        type="button"
                        onclick="openModal('modalKategori')"
                        class="text-xs font-semibold text-emerald-700 hover:text-emerald-900 underline cursor-pointer"
                    >
                        + Tambah Kategori Baru
                    </button>
                </div>
                <div class="overflow-x-auto border border-slate-200 rounded-xl">
                    <table class="w-full text-left text-sm text-slate-700">
                        <thead class="bg-slate-50 border-b border-slate-200 text-xs font-semibold uppercase text-slate-500">
                            <tr>
                                <th class="px-4 py-3">No</th>
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
                                    <td colspan="4" class="px-4 py-8 text-center text-slate-400">
                                        Belum ada data kategori. Silakan klik tombol <b>Tambah Kategori</b> di atas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- ================= MODAL TAMBAH BARANG ================= -->
    <div id="modalBarang" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4">
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
                            placeholder="Contoh: BRG003"
                            required
                            class="w-full h-9 px-3 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none"
                        >
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Barang *</label>
                        <input
                            type="text"
                            name="nama_barang"
                            placeholder="Contoh: Kertas A4"
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
    <div id="modalKategori" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl border border-slate-200 max-w-md w-full p-6 transition-all">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-emerald-700 text-white flex items-center justify-center font-bold text-sm">
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
                        class="w-full h-9 px-3 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none"
                    >
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Deskripsi</label>
                    <textarea
                        name="deskripsi"
                        rows="3"
                        placeholder="Keterangan opsional tentang kategori ini..."
                        class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none"
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
                        class="px-5 py-2 text-xs font-semibold text-white bg-emerald-700 hover:bg-emerald-800 active:bg-emerald-900 rounded-lg shadow-xs transition cursor-pointer"
                    >
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Interactive Scripts -->
    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.remove('hidden');
            }
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.add('hidden');
            }
        }

        function switchTab(tabId) {
            const tabBarang = document.getElementById('tabBarang');
            const tabKategori = document.getElementById('tabKategori');
            const btnTabBarang = document.getElementById('btnTabBarang');
            const btnTabKategori = document.getElementById('btnTabKategori');

            if (tabId === 'tabBarang') {
                tabBarang.classList.remove('hidden');
                tabKategori.classList.add('hidden');

                btnTabBarang.className = 'pb-3 text-sm font-semibold text-blue-900 border-b-2 border-blue-900 transition flex items-center gap-2 cursor-pointer';
                btnTabKategori.className = 'pb-3 text-sm font-semibold text-slate-500 hover:text-slate-700 border-b-2 border-transparent transition flex items-center gap-2 cursor-pointer';
            } else {
                tabBarang.classList.add('hidden');
                tabKategori.classList.remove('hidden');

                btnTabBarang.className = 'pb-3 text-sm font-semibold text-slate-500 hover:text-slate-700 border-b-2 border-transparent transition flex items-center gap-2 cursor-pointer';
                btnTabKategori.className = 'pb-3 text-sm font-semibold text-emerald-800 border-b-2 border-emerald-800 transition flex items-center gap-2 cursor-pointer';
            }
        }

        // Close modal when clicking backdrop
        window.addEventListener('click', function(e) {
            if (e.target.id === 'modalBarang') closeModal('modalBarang');
            if (e.target.id === 'modalKategori') closeModal('modalKategori');
        });
    </script>
</body>
</html>
