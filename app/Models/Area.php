<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Area
 * 
 * @property int $id
 * @property string $name
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Loan[] $loans
 *
 * @package App\Models
 */
class Area extends Model
{
	protected $table = 'areas';

	protected $fillable = [
		'name',
		'status'
	];

	public function loans(): HasMany
	{
		return $this->hasMany(
			related: Loan::class,
			foreignKey: 'area_id'
		);
	}
}
