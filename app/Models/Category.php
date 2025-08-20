<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // eksplisitkan nama tabel biar tidak ambil tebak-tebakan
    protected $table = 'categories';

    // primary key kustom
    protected $primaryKey = 'category_id';
    public $incrementing = true;
    protected $keyType = 'int';

    // timestamps aktif (sesuai migration)
    public $timestamps = true;

    // kolom yang boleh diisi mass-assignment
    protected $fillable = ['nama_category'];

    // relasi: satu kategori punya banyak produk
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}
