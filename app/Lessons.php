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
 */
class Lessons extends Model
{
    protected $table = 'lesson';
    public $timestamps = false;

   /* public function setClassIdAttribute($value)
    {
        if (count(trim($value)) < 1)
            $this->class_id = null;
    }

    public function setRoomIdAttribute($value)
    {
        if (count(trim($value)) < 1)
            $this->room_id = null;
    }*/
}
