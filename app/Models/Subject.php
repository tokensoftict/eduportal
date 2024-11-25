<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subject
 * 
 * @property int $id
 * @property string $name
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Course[] $courses
 *
 * @package App\Models
 */
class Subject extends Model
{
	protected $table = 'subjects';

	protected $casts = [
		'status' => 'bool'
	];

	protected $fillable = [
		'name',
		'status'
	];

	public function courses()
	{
		return $this->belongsToMany(Course::class, 'course_subjects')
					->withPivot('id', 'compulsory', 'elective')
					->withTimestamps();
	}
}
