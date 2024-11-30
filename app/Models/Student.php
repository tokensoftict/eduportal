<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Notifications\VerifyEmailNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class Student
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string $phone
 * @property Carbon|null $phone_verified_at
 * @property int|null $country_id
 * @property int|null $state_id
 * @property int|null $gender_id
 * @property int|null $religion_id
 * @property int|null $local_govt_id
 * @property string|null $place_of_birth
 * @property string|null $contact_address
 * @property Carbon|null $dob
 * @property string|null $disability
 * @property string|null $nature_disability
 * @property string|null $nin
 * @property string|null $blood_group
 * @property string|null $guardian_name
 * @property string|null $guardian_address
 * @property string|null $guardian_phone
 * @property string|null $guardian_email
 * @property string|null $guardian_relationship
 * @property string|null $kin_name
 * @property string|null $kin_address
 * @property string|null $kin_phone_no
 * @property string|null $kin_email
 * @property string|null $kin_relationship
 * @property array|null $first_sitting_grade
 * @property array|null $second_sitting_grade
 * @property string|null $remember_token
 * @property int|null $course_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Country|null $country
 * @property Course|null $course
 * @property Gender|null $gender
 * @property LocalGovt|null $local_govt
 * @property Religion|null $religion
 * @property State|null $state
 *
 * @package App\Models
 */
class Student extends  Authenticatable implements MustVerifyEmail, CanResetPassword
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use Notifiable;


	protected $casts = [
		'email_verified_at' => 'datetime',
		'phone_verified_at' => 'datetime',
		'country_id' => 'int',
		'state_id' => 'int',
		'gender_id' => 'int',
		'religion_id' => 'int',
		'local_govt_id' => 'int',
		'dob' => 'datetime',
		'first_sitting_grade' => 'json',
		'second_sitting_grade' => 'json',
        'document_uploaded' => 'json',
        'a_level_subjects' => 'json',
		'course_id' => 'int',
        'no_of_sittings' => 'int',
        'password' => 'hashed',
        'status' => 'int',
        'application_fee_transaction_id' => 'int',
        'acceptance_fee_transaction_id' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'firstname',
        'lastname',
        'middlename',
		'email',
		'email_verified_at',
		'password',
		'phone',
		'phone_verified_at',
		'country_id',
		'state_id',
		'gender_id',
		'religion_id',
		'local_govt_id',
		'place_of_birth',
		'contact_address',
		'dob',
		'disability',
		'nature_disability',
		'nin',
		'blood_group',
		'guardian_name',
		'guardian_address',
		'guardian_phone',
		'guardian_email',
		'guardian_relationship',
		'kin_name',
		'kin_address',
		'kin_phone_no',
		'kin_email',
		'kin_relationship',
		'first_sitting_grade',
		'second_sitting_grade',
		'remember_token',
		'course_id',
        'no_of_sittings',
        'document_uploaded',
        'status',
        'application_fee_transaction_id',
        'acceptance_fee_transaction_id',
        'a_level_subjects'
	];


    public function getNameAttribute()
    {
        return "$this->firstname $this->lastname $this->middlename";
    }

	public function country()
	{
		return $this->belongsTo(Country::class);
	}

	public function course()
	{
		return $this->belongsTo(Course::class);
	}

	public function gender()
	{
		return $this->belongsTo(Gender::class);
	}

	public function local_govt()
	{
		return $this->belongsTo(LocalGovt::class);
	}

	public function religion()
	{
		return $this->belongsTo(Religion::class);
	}

	public function state()
	{
		return $this->belongsTo(State::class);
	}

    public final function sendEmailVerificationNotification() : void
    {
        $this->notify(new VerifyEmailNotification);
    }
}
