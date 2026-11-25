<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualans';

    protected $fillable = [
        'no_transaksi',
        'barang_id',
        'nama_pelanggan',
        'jumlah',
        'harga_satuan',
        'total_harga',
        'tanggal_penjualan',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_penjualan' => 'date',
            'harga_satuan' => 'decimal:2',
            'total_harga' => 'decimal:2',
            'jumlah' => 'integer',
        ];
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
