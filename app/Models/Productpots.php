<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Productpots extends Model
{
    use HasFactory;

    // Tabel & PK
    protected $table = 'productpots';
    protected $primaryKey = 'id';       // GANTI ke 'product_id' kalau di migration PK-nya product_id
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'category_id',
        'nama_product',
        'price',
        // tambahkan kolom lain bila ada (mis. is_active)
    ];

    // Simpan rupiah sebagai integer (tanpa desimal)
    protected $casts = [
        'price' => 'integer', // pakai 'decimal:2' jika kamu simpan angka dengan koma
    ];

    /* ===========================
     * RELATIONS
     * =========================== */

    // -> ke tabel categorypots (bukan categories)
    public function category()
    {
        return $this->belongsTo(Categorypots::class, 'category_id', 'category_id');
    }

    // Pivot OTC.
    // Pastikan nama tabel & kolom sesuai migration pivot-mu.
    // Rekomendasi pivot: productpots_otc(product_id, otc_id)
    public function otcs()
    {
        return $this->belongsToMany(
            OTC::class,       // model tujuan
            'productpots_otc',// NAMA TABEL PIVOT (ubah jika kamu pakai nama lain)
            'product_id',     // FK ke productpots.id (ubah jika PK kamu berbeda)
            'otc_id'          // FK ke otcs.id
        );
    }

    /* ===========================
     * SCOPES
     * =========================== */

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
        // Hanya filter jika kolom is_active memang ada
        if (Schema::hasColumn($this->getTable(), 'is_active')) {
            $query->where('is_active', 1);
        }
        return $query;
    }

    /* ===========================
     * BUSINESS LOGIC
     * =========================== */

    /**
     * Hitung total: (price * (1 + ppn) * duration) + (otc * duration)
     * Return float/null bila OTC tidak ketemu.
     */
    public function calculateTotalPrice($otcId, int $duration = 1, float $ppnRate = 0.11): ?float
    {
        $otc = OTC::find($otcId);
        if (!$otc) {
            return null;
        }

        $productPriceWithPPN = (float) $this->price * (1 + $ppnRate);
        $priceWithDuration   = $productPriceWithPPN * $duration;
        $otcWithDuration     = (float) $otc->price_OTC * $duration;

        return $priceWithDuration + $otcWithDuration;
    }
}
