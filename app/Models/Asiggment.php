<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Asiggment
 * 
 * @property int $id
 * @property int $tool_id
 * @property int $employe_id
 * @property string $description
 * @property int $quantity
 * @property int $code
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Employe $employe
 * @property Tool $tool
 *
 * @package App\Models
 */
class Asiggment extends Model
{
	protected $table = 'asiggments';

	protected $casts = [
		'tool_id' => 'int',
		'employe_id' => 'int',
		'quantity' => 'int',
		//'code' => 'int',
		'status' => 'bool'
	];

	protected $fillable = [
		'tool_id',
		'employe_id',
		'description',
		'quantity',
		'code',
		'status'
	];

	public function employe(): BelongsTo
	{
		return $this->belongsTo(
			related: Employe::class,
			foreignKey: 'employe_id'
		);
	}

	public function tool(): BelongsTo
	{
		return $this->belongsTo(
			related: Tool::class,
			foreignKey: 'tool_id'
		);
	}
}
