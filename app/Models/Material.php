<?php

namespace App\Models;

use App\Models\KardexBalance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    /** @use HasFactory<\Database\Factories\MaterialFactory> */
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'pu',
        'um',
        'order_id',
        'quantity',
        'category_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            related: Category::class,
            foreignKey: 'category_id',
        );
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(
            related: OrderParchuse::class,
            foreignKey: 'order_id',
        );
    }
    public function balance(): HasMany
    {
        return $this->hasMany(
            related: KardexBalance::class,
            foreignKey: 'material_id'
        );
    }
}
