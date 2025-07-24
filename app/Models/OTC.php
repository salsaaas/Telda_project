<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class OTC extends Model
{
    use HasFactory;
    protected $table = 'otc'; // atau 'otcs' sesuai migrationmu
    protected $primaryKey = 'id_OTC';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['category_OTC', 'price_OTC'];
    protected $casts = ['price_OTC' => 'decimal:2'];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_otc', 'otc_id', 'product_id');
    }
}