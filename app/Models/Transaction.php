<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 * 
 * @property int $id
 * @property string $transactionId
 * @property string $transactionable_type
 * @property int $transactionable_id
 * @property string|null $paymentable_type
 * @property int|null $paymentable_id
 * @property float $amount
 * @property string $currency
 * @property Carbon $date
 * @property string $country
 * @property string $email
 * @property string $phoneNumber
 * @property string $name
 * @property string $session
 * @property string $semester
 * @property string $gateway
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Transaction extends Model
{
	protected $table = 'transactions';

	protected $casts = [
		'transactionable_id' => 'int',
		'paymentable_id' => 'int',
		'amount' => 'float',
		'date' => 'datetime',
		'status' => 'bool'
	];

	protected $fillable = [
		'transactionId',
		'transactionable_type',
		'transactionable_id',
		'paymentable_type',
		'paymentable_id',
		'amount',
		'currency',
		'date',
		'country',
		'email',
		'phoneNumber',
		'name',
		'session',
		'semester',
		'gateway',
		'status'
	];
}
