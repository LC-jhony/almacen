<?php

namespace App\Models;

use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KardexBalance extends Model
{
    /** @use HasFactory<\Database\Factories\KardexBalanceFactory> */
    use HasFactory;
    protected $casts = [
        'material_id' => 'int',
        'quantity' => 'float',
    ];

    protected $fillable = [
        'material_id',
        'quantity',

    ];

    public function material(): BelongsTo
    {
        return $this->belongsTo(
            related: Material::class,
            foreignKey: 'material_id'
        );
    }
}
