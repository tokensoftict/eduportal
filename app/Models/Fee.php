<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Fee
 * 
 * @property int $id
 * @property string $name
 * @property float $amount
 * @property bool $compulsory
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Fee extends Model
{
	protected $table = 'fees';

	protected $casts = [
		'amount' => 'float',
		'compulsory' => 'bool',
		'status' => 'bool'
	];

	protected $fillable = [
		'name',
		'amount',
		'compulsory',
		'status'
	];
}
