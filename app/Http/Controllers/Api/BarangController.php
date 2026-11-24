<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BarangController extends Controller
{
    // Menampilkan semua barang
    public function index(Request $request)
    {
        $query = Barang::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where(
                    'nama_barang',
                    'like',
                    '%' . $request->search . '%'
                )->orWhere(
                    'kode_barang',
                    'like',
                    '%' . $request->search . '%'
                );
            });
        }

        $barangs = $query
            ->latest()
            ->paginate(10);

        $barangs->through(function ($barang) {
            return $this->formatBarang($barang);
        });

        return response()->json($barangs);
    }

    // Menyimpan barang
    public function store(Request $request)
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
            $validated['gambar'] = $request
                ->file('gambar')
                ->store('barangs', 'public');
        }

        $barang = Barang::create($validated);

        return response()->json([
            'message' => 'Barang berhasil ditambahkan',
            'data' => $this->formatBarang($barang)
        ], 201);
    }

    // Menampilkan detail barang
    public function show($id)
    {
        $barang = Barang::findOrFail($id);

        return response()->json([
            'data' => $this->formatBarang($barang)
        ]);
    }

    // Mengubah barang
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $validated = $request->validate([
            'kode_barang' => [
                'required',
                'string',
                'max:50',
                Rule::unique('barangs', 'kode_barang')
                    ->ignore($barang->id)
            ],
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

            // Hapus gambar lama
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }

            // Simpan gambar baru
            $validated['gambar'] = $request
                ->file('gambar')
                ->store('barangs', 'public');
        }

        $barang->update($validated);

        return response()->json([
            'message' => 'Barang berhasil diperbarui',
            'data' => $this->formatBarang($barang->fresh())
        ]);
    }

    // Menghapus barang
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }

        $barang->delete();

        return response()->json([
            'message' => 'Barang berhasil dihapus'
        ]);
    }

    // Format data response
    private function formatBarang($barang)
    {
        return [
            'id' => $barang->id,
            'kode_barang' => $barang->kode_barang,
            'nama_barang' => $barang->nama_barang,
            'kategori' => $barang->kategori,
            'deskripsi' => $barang->deskripsi,
            'harga_beli' => $barang->harga_beli,
            'harga_jual' => $barang->harga_jual,
            'stok' => $barang->stok,
            'satuan' => $barang->satuan,
            'gambar' => $barang->gambar,
            'gambar_url' => $barang->gambar
                ? asset('storage/' . $barang->gambar)
                : null,
            'created_at' => $barang->created_at,
            'updated_at' => $barang->updated_at
        ];
    }
}
