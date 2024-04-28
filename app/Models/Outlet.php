<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_outlet',
        'nama_outlet',
        'nama_pemilik',
        'alamat_outlet',
        'telepon_pemilik',

        'cabang_id'
    ];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
}
