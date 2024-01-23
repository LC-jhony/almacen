<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductLoan
 * 
 * @property int $id
 * @property int $loan_id
 * @property int $product_id
 * @property string $code
 * @property string $quantity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Loan $loan
 * @property Product $product
 *
 * @package App\Models
 */
class ProductLoan extends Model
{
	protected $table = 'product_loan';

	protected $casts = [
		'loan_id' => 'int',
		'product_id' => 'int'
	];

	protected $fillable = [
		'loan_id',
		'product_id',
		'code',
		'quantity'
	];

	 public function loan()
	 {
	 	return $this->belongsTo(Loan::class);
	 }

	 public function product()
	 {
	 	return $this->belongsTo(Product::class);
	 }
}
