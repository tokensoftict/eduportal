<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Course
 * 
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $prefix
 * @property array|null $compulsory
 * @property int $counter
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Subject[] $subjects
 * @property Collection|Student[] $students
 *
 * @package App\Models
 */
class Course extends Model
{
	protected $table = 'courses';

	protected $casts = [
		'compulsory' => 'json',
		'counter' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'prefix',
		'compulsory',
		'counter'
	];

	public function subjects()
	{
		return $this->belongsToMany(Subject::class, 'course_subjects')
					->withPivot('id', 'compulsory', 'elective')
					->withTimestamps();
	}

	public function students()
	{
		return $this->hasMany(Student::class);
	}
}
