<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productpots extends Model
{
    use HasFactory;

    // PENTING: gunakan tabel pots (ganti sesuai nama tabel kamu)
    protected $table = 'productpots'; // <- sebelumnya 'products'

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'category_id',
        'nama_product',
        'price',
        // tambahkan kolom lain bila ada, mis. 'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    // ---------- RELATIONS ----------
    public function category()
    {
        // categories: PK = category_id (sesuai validasi exists:categories,category_id)
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function otcs()
    {
        // Pivot default: product_otc(product_id, otc_id)
        return $this->belongsToMany(OTC::class, 'product_otc', 'product_id', 'otc_id');
    }

    // ---------- SCOPES (untuk query bersih di controller) ----------
    public function scopeForCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeSearch($query, ?string $term)
    {
        if (!empty($term)) {
            $query->where('nama_product', 'like', "%{$term}%");
        }
        return $query;
    }

    public function scopeActive($query)
    {
        // pakai jika ada kolom is_active di tabel
        if (schema_has_column($this->getTable(), 'is_active')) {
            $query->where('is_active', 1);
        }
        return $query;
    }

    // ---------- BUSINESS LOGIC ----------
    /**
     * Hitung total harga: ((harga + ppn) x durasi) + (otc x durasi)
     * Return: float (angka), null jika OTC tidak ditemukan
     */
    public function calculateTotalPrice($otcId, int $duration = 1, float $ppnRate = 0.11): ?float
    {
        $otc = OTC::find($otcId);
        if (!$otc) {
            return null;
        }

        $productPriceWithPPN = (float)$this->price * (1 + $ppnRate);
        $priceWithDuration   = $productPriceWithPPN * $duration;
        $otcWithDuration     = (float)$otc->price_OTC * $duration;

        return $priceWithDuration + $otcWithDuration;
    }
}
