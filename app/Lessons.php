<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Lessons
 *
 * @property string $teacher_id
 * @property integer $day_id
 * @property integer $hour_id
 * @property string $subject_id
 * @property string $room_id
 * @property string $class_id
 * @property string $weeks
 * @method static \Illuminate\Database\Query\Builder|\App\Lessons whereTeacherId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Lessons whereDayId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Lessons whereHourId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Lessons whereSubjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Lessons whereRoomId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Lessons whereClassId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Lessons whereWeeks($value)
 * @mixin \Eloquent
 * @property integer $id
 * @method static \Illuminate\Database\Query\Builder|\App\Lessons whereId($value)
 * @property-read \App\Classe $classe
 * @property-read \App\Teacher $teacher
 * @property-read \App\Room $room
 * @property-read \App\Subject $subject
 */
class Lessons extends Model
{
    protected $table = 'lesson';
    public $timestamps = false;

    public function classe()
    {
        return $this->hasOne('App\Classe', 'id', 'class_id');
    }

    public function teacher()
    {
        return $this->hasOne('App\Teacher', 'id', 'teacher_id');
    }

    public function room()
    {
        return $this->hasOne('App\Room', 'id', 'room_id');
    }

    public function subject()
    {
        return $this->hasOne('App\Subject', 'id', 'subject_id');
    }
}
