<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



/**
 * App\FullLessons
 *
 * @property string $teacher_id
 * @property string $teacher_name
 * @property string $classe_id
 * @property string $classe_name
 * @property string $room_id
 * @property string $room_name
 * @property string $subject_id
 * @property string $subject_name
 * @property string $start
 * @property string $finish
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereTeacherId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereTeacherName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereClasseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereClasseName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereRoomId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereRoomName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereSubjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereSubjectName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereStart($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereFinish($value)
 * @mixin \Eloquent
 */
class FullLessons extends Model
{
    protected $table = 'full_lessons';
    public $timestamps = false;
    public $casts = ['teacher_id' => 'string', 'classe_id' => 'string'];
}
