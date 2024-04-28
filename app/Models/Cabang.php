<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_cabang',
        'kode_cabang',
    ];

    // Relasi one to many dengan tabel outlet
    public function outlet()
    {
        return $this->hasMany(Outlet::class);
    }

    // Relasi one to many dengan tabel stok
    public function stok()
    {
        return $this->hasMany(Stok::class);
    }

    // Relasi one to many dengan tabel sales
    public function sales()
    {
        return $this->hasMany(Sales::class);
    }
}
