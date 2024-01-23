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
 * Class Tool
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $status
 * @property int $quantity
 * @property string $order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Asiggment[] $asiggments
 * @property Collection|Movement[] $movements
 *
 * @package App\Models
 */
class Tool extends Model
{
	protected $table = 'tools';

	protected $casts = [
		'quantity' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'status',
		'quantity',
		'order'
	];

	public function asiggments(): HasMany
	{
		return $this->hasMany(
			related: Asiggment::class,
			foreignKey: 'tool_id'
		);
	}


	public function movements(): HasMany
	{
		return $this->hasMany(
			related: Movement::class,
			foreignKey: 'tool_id'
		);
	}
}
