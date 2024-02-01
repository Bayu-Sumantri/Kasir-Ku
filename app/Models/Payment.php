<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $table="payments";

    protected $fillable = [
        "id_user",
        "nama_produk",
        "harga_total",
        "harga_discount",
        "persen_discount",
        "jumlah_semua_pembelian",
        "methode_pembayaran",
        "dana",
        "bank",
        "COD"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
