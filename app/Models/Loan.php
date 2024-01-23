<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ProductLoan;

/**
 * Class Loan
 * 
 * @property int $id
 * @property int $area_id
 * @property bool $status
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Area $area
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class Loan extends Model
{
	protected $table = 'loans';

	protected $casts = [
		'area_id' => 'int',
		'status' => 'bool'
	];

	protected $fillable = [
		'area_id',
		'status',
		'type'
	];

	public function area(): BelongsTo
	{
		return $this->belongsTo(
			related: Area::class,
			foreignKey: 'area_id'
		);
	}
	public function productLoan(): HasMany
	{
		return $this->hasMany(ProductLoan::class);
	}

	public function Products(): BelongsToMany
	{
		return $this->belongsToMany(
			related: Product::class,
			table: 'product_loan'
	 	)
			->withPivot('quantity')
	 		->withTimestamps();
	 }
}
