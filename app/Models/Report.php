<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Report
 * 
 * @property int $id
 * @property bool $show_logo
 * @property string|null $logo
 * @property string|null $header
 * @property string|null $subheader
 * @property string|null $terms
 * @property string|null $footer
 * @property string $accent_color
 * @property string $font
 * @property string $template
 * @property int $loan_id
 * @property int $asiggment_id
 * @property string $type
 * @property string $path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Asiggment $asiggment
 * @property Loan $loan
 *
 * @package App\Models
 */
class Report extends Model
{
	protected $table = 'reports';

	protected $casts = [
		'show_logo' => 'bool',
		'loan_id' => 'int',
		'asiggment_id' => 'int'
	];

	protected $fillable = [
		'show_logo',
		'logo',
		'header',
		'subheader',
		'terms',
		'footer',
		'accent_color',
		'font',
		'template',
		'loan_id',
		'asiggment_id',
		'type',
		'path'
	];

	public function asiggment()
	{
		return $this->belongsTo(Asiggment::class);
	}

	public function loan()
	{
		return $this->belongsTo(Loan::class);
	}
}
