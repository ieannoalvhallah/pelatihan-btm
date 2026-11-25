<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $totalKategori = Kategori::count();
        $totalStok = Barang::sum('stok');
        $totalPenjualan = Penjualan::count();
        $totalPendapatan = Penjualan::sum('total_harga');

        $barangs = Barang::latest()->get();
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $penjualans = Penjualan::with('barang')->latest()->get();

        $activeMenu = request('menu', 'dashboard');

        return view('dashboard', compact(
            'totalBarang',
            'totalKategori',
            'totalStok',
            'totalPenjualan',
            'totalPendapatan',
            'barangs',
            'kategoris',
            'penjualans',
            'activeMenu'
        ));
    }

    public function storePenjualan(Request $request)
    {
        $validated = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'nama_pelanggan' => 'nullable|string|max:100',
            'tanggal_penjualan' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        $barang = Barang::findOrFail($validated['barang_id']);

        if ($barang->stok < $validated['jumlah']) {
            return redirect()->route('dashboard', ['menu' => 'penjualan'])
                ->withErrors(['jumlah' => "Stok '{$barang->nama_barang}' tidak mencukupi! Tersisa {$barang->stok} {$barang->satuan}."])
                ->withInput();
        }

        DB::transaction(function () use ($validated, $barang) {
            $hargaSatuan = $barang->harga_jual;
            $totalHarga = $hargaSatuan * $validated['jumlah'];

            $todayCount = Penjualan::whereDate('created_at', today())->count();
            $noTransaksi = 'PJL-' . date('Ymd') . '-' . str_pad($todayCount + 1, 4, '0', STR_PAD_LEFT);

            Penjualan::create([
                'no_transaksi' => $noTransaksi,
                'barang_id' => $barang->id,
                'nama_pelanggan' => $validated['nama_pelanggan'] ?: 'Pelanggan Umum',
                'jumlah' => $validated['jumlah'],
                'harga_satuan' => $hargaSatuan,
                'total_harga' => $totalHarga,
                'tanggal_penjualan' => $validated['tanggal_penjualan'],
                'catatan' => $validated['catatan'] ?? null,
            ]);

            $barang->decrement('stok', $validated['jumlah']);
        });

        return redirect()->route('dashboard', ['menu' => 'penjualan'])
            ->with('success', "Transaksi penjualan berhasil disimpan dan stok {$barang->nama_barang} otomatis berkurang {$validated['jumlah']} {$barang->satuan}!");
    }

    public function storeBarang(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|string|max:50|unique:barangs,kode_barang',
            'nama_barang' => 'required|string|max:150',
            'kategori' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|string|max:30',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('barangs', 'public');
        }

        Barang::create($validated);

        return redirect()->route('dashboard')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function storeKategori(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategoris,nama_kategori',
            'deskripsi' => 'nullable|string',
        ]);

        Kategori::create($validated);

        return redirect()->route('dashboard')->with('success', 'Kategori berhasil ditambahkan!');
    }
}
