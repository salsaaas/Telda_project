<?php
namespace App\Models;
use App\Models\OTC;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'price'
    ];
    protected $casts = [
        'price' => 'decimal:2'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    public function otcs()
    {
        return $this->belongsToMany(OTC::class, 'product_otc', 'product_id', 'otc_id');
    }
    // Method eksplisit sesuai logika ((harga + ppn) x durasi) + (otc x durasi)
    public function calculateTotalPrice($otcId, $duration = 1, $ppnRate = 0.11)
    {
        $otc = OTC::find($otcId);
        if (!$otc) {
            return null;
        }
        $productPriceWithPPN = $this->price * (1 + $ppnRate);
        $priceWithDuration = $productPriceWithPPN * $duration;
        $otcWithDuration = $otc->price_OTC * $duration;
        $totalPrice = $priceWithDuration + $otcWithDuration;
        return [
            'price_with_ppn' => $productPriceWithPPN,
            'price_duration' => $priceWithDuration,
            'otc_duration' => $otcWithDuration,
            'total_price' => $totalPrice
        ];
    }
}