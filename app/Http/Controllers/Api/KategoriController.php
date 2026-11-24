<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    // Menampilkan semua kategori dengan fitur pencarian
    public function index(Request $request)
    {
        $query = Kategori::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_kategori', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }

        // Jika request all=true, return semua tanpa pagination (cocok untuk dropdown)
        if ($request->boolean('all')) {
            return response()->json($query->orderBy('nama_kategori')->get());
        }

        $kategoris = $query->latest()->paginate(10);

        return response()->json($kategoris);
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategoris,nama_kategori',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori = Kategori::create($validated);

        return response()->json([
            'message' => 'Kategori berhasil ditambahkan',
            'data' => $kategori,
        ], 201);
    }

    // Menampilkan detail kategori
    public function show($id)
    {
        $kategori = Kategori::findOrFail($id);

        return response()->json([
            'data' => $kategori,
        ]);
    }

    // Mengubah kategori
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $validated = $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'max:100',
                Rule::unique('kategoris', 'nama_kategori')->ignore($kategori->id),
            ],
            'deskripsi' => 'nullable|string',
        ]);

        $kategori->update($validated);

        return response()->json([
            'message' => 'Kategori berhasil diperbarui',
            'data' => $kategori->fresh(),
        ]);
    }

    // Menghapus kategori
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return response()->json([
            'message' => 'Kategori berhasil dihapus',
        ]);
    }
}
