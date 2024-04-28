<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id',
        'kode_stok_produk',
        'status',
        'tanggal_masuk',
        'tanggal_distribusi',
        'tanggal_transaksi',
        'harga_jual',
        'modal',

        'outlet_id',
        'sale_id'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sales::class);
    }
}
