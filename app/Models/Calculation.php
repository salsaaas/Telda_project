<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'items',
        'grand_total'
    ];

    protected $casts = [
        'items' => 'array',
        'grand_total' => 'decimal:2'
    ];

    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->grand_total, 0, ',', '.');
    }

    public function getItemsCountAttribute()
    {
        return is_array($this->items) ? count($this->items) : 0;
    }
}