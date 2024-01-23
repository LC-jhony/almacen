<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Product
 * 
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property float $unit_price
 * @property string $unit_measure
 * @property int $parchuse_order
 * @property float $quantity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property float $code
 * 
 * @property Category $category
 * @property Collection|Loan[] $loans
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'products';

	protected $casts = [
		'category_id' => 'int',
		'unit_price' => 'float',
		'parchuse_order' => 'int',
		'quantity' => 'float',
		//'code' => 'float'
	];

	protected $fillable = [
		'category_id',
		'name',
		'unit_price',
		'unit_measure',
		'parchuse_order',
		'quantity',
		'code'
	];

	public function category(): BelongsTo
	{
		return $this->belongsTo(
			related: Category::class,
			foreignKey: 'category_id'
		);
	}
	public function productLoan(): HasMany
	{
		return $this->hasMany(ProductLoan::class);
	}

	 public function Loans(): BelongsToMany
	 {
		return $this->belongsToMany(
	 	related: Loan::class,
	 		table: 'product_loan'
		)
			->withPivot('quantity')
			->withTimestamps();
	}
}
