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
 * @property integer $date_id
 * @property integer $hour_id
 * @property string $start_hour
 * @property string $finish_hour
 * @property integer $day_id
 * @property string $first_day_week
 * @property string $start
 * @property string $finish
 * @property mixed $detail
 * @property-read \App\Classe $classe
 * @property-read \App\Teacher $teacher
 * @property-read \App\Room $room
 * @property-read \App\Subject $subject
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereTeacherId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereTeacherName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereClasseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereClasseName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereRoomId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereRoomName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereSubjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereSubjectName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereDateId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereHourId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereStartHour($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereFinishHour($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereDayId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereFirstDayWeek($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereStart($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereFinish($value)
 * @mixin \Eloquent
 */
class FullLessons extends Lessons
{
    protected $table = 'full_lessons';
    public $timestamps = false;
    public $casts = ['teacher_id' => 'string', 'classe_id' => 'string'];
    protected $appends = ['detail'];
    public $detail;

    public function getDetailAttribute()
    {
        return $this->detail;
    }

    public function setDetailAttribute($value)
    {
        $this->detail = $value;
    }
}
