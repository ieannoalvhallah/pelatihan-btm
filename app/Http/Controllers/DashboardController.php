<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $totalKategori = Kategori::count();
        $totalStok = Barang::sum('stok');
        $barangs = Barang::latest()->get();
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('dashboard', compact('totalBarang', 'totalKategori', 'totalStok', 'barangs', 'kategoris'));
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
