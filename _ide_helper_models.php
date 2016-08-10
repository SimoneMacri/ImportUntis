<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Classe
 *
 * @property string $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\FullLessons[] $lessons
 * @method static \Illuminate\Database\Query\Builder|\App\Classe whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Classe whereName($value)
 * @mixin \Eloquent
 */
	class Classe extends \Eloquent {}
}

namespace App{
/**
 * App\Date
 *
 * @property integer $id
 * @property string $data_type_1
 * @property string $data_type_2
 * @method static \Illuminate\Database\Query\Builder|\App\Date whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Date whereDataType1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Date whereDataType2($value)
 * @mixin \Eloquent
 */
	class Date extends \Eloquent {}
}

namespace App{
/**
 * App\FullLessons
 *
 * @mixin \Eloquent
 * @property string $teacher_id
 * @property integer $day_id
 * @property integer $hour_id
 * @property string $subject_id
 * @property string $room_id
 * @property string $class_id
 * @property string $weeks
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereTeacherId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereDayId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereHourId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereSubjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereRoomId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereClassId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FullLessons whereWeeks($value)
 */
	class FullLessons extends \Eloquent {}
}

namespace App{
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
	class Lessons extends \Eloquent {}
}

namespace App{
/**
 * App\Room
 *
 * @property string $id
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\Room whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Room whereName($value)
 * @mixin \Eloquent
 */
	class Room extends \Eloquent {}
}

namespace App{
/**
 * App\Subject
 *
 * @property string $id
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\Subject whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Subject whereName($value)
 * @mixin \Eloquent
 */
	class Subject extends \Eloquent {}
}

namespace App{
/**
 * App\Teacher
 *
 * @property string $id
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereName($value)
 * @mixin \Eloquent
 */
	class Teacher extends \Eloquent {}
}

namespace App{
/**
 * App\Time
 *
 * @property integer $day_id
 * @property integer $hour_id
 * @property string $start_hour
 * @property string $finish_hour
 * @method static \Illuminate\Database\Query\Builder|\App\Time whereDayId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Time whereHourId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Time whereStartHour($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Time whereFinishHour($value)
 * @mixin \Eloquent
 */
	class Time extends \Eloquent {}
}

