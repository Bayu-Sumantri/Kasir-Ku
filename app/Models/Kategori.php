<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $table="kategoris";

    protected $fillable = [
        "nama_kategori",
    ];

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id_kategori');
    }
}
