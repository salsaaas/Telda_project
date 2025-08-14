<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\OTC;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'category_id',
        'nama_product',
        'price',
    ];

    // Kolom `price` di migration = unsignedBigInteger,
    // jadi cast ke integer (atau float kalau ingin pecahan).
    protected $casts = [
        'id'          => 'integer',
        'category_id' => 'integer',
        'price'       => 'integer', // ganti ke 'float' jika butuh desimal
    ];

    // ---------- RELATIONS ----------
    public function category()
    {
        // PK categories = category_id
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function otcs()
    {
        // Pivot default: product_otc(product_id, otc_id)
        return $this->belongsToMany(OTC::class, 'product_otc', 'product_id', 'otc_id');
    }

    // ---------- BUSINESS LOGIC ----------
    /**
     * Hitung total: ((harga + PPN) x durasi) + (OTC x durasi)
     *
     * @param  int   $otcId
     * @param  int   $duration  minimal 1
     * @param  float $ppnRate   0.11 = 11%
     * @return array{
     *   price_with_ppn: float,
     *   price_duration: float,
     *   otc_duration:   float,
     *   total_price:    float
     * }
     */
    public function calculateTotalPrice(int $otcId, int $duration = 1, float $ppnRate = 0.11): array
    {
        $duration = max(1, $duration);

        $otc = OTC::find($otcId);
        $otcPrice = $otc?->price_OTC ?? 0;

        $base            = (float) $this->price;
        $priceWithPPN    = $base * (1 + $ppnRate);
        $priceDuration   = $priceWithPPN * $duration;
        $otcDuration     = (float) $otcPrice * $duration;
        $total           = $priceDuration + $otcDuration;

        return [
            'price_with_ppn' => $priceWithPPN,
            'price_duration' => $priceDuration,
            'otc_duration'   => $otcDuration,
            'total_price'    => $total,
        ];
    }
}
