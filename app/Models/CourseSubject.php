<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CourseSubject
 * 
 * @property int $id
 * @property int $course_id
 * @property int $subject_id
 * @property bool $compulsory
 * @property bool $elective
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Course $course
 * @property Subject $subject
 *
 * @package App\Models
 */
class CourseSubject extends Model
{
	protected $table = 'course_subjects';

	protected $casts = [
		'course_id' => 'int',
		'subject_id' => 'int',
		'compulsory' => 'bool',
		'elective' => 'bool'
	];

	protected $fillable = [
		'course_id',
		'subject_id',
		'compulsory',
		'elective'
	];

	public function course()
	{
		return $this->belongsTo(Course::class);
	}

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}
}
