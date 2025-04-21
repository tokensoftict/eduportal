<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Campus
 * 
 * @property int $id
 * @property string $name
 * @property float $fees
 * @property int $noOfInstalments
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Campus extends Model
{
	protected $table = 'campuses';

	protected $casts = [
		'fees' => 'float',
		'noOfInstalments' => 'int'
	];

	protected $fillable = [
		'name',
		'fees',
		'noOfInstalments'
	];
}
