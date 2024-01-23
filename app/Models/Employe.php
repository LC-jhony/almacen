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
 * Class Employe
 * 
 * @property int $id
 * @property string $full_name
 * @property string $first_name
 * @property string $last_name
 * @property string $dni
 * @property string $cargo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Asiggment[] $asiggments
 *
 * @package App\Models
 */
class Employe extends Model
{
	protected $table = 'employes';

	protected $fillable = [
		'full_name',
		'first_name',
		'last_name',
		'dni',
		'cargo'
	];

	public function asiggments(): HasMany
	{
		return $this->hasMany(
			related: Asiggment::class,
			foreignKey: 'employe_id'
		);
	}
}
