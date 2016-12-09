<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App {
    /**
     * App\Classe
     *
     * @property string $id
     * @property string $name
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\FullLessons[] $lessons
     * @method static \Illuminate\Database\Query\Builder|\App\Classe whereId($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Classe whereName($value)
     * @mixin \Eloquent
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\News[] $news
     */
    class Classe extends \Eloquent
    {
    }
}

namespace App {
    /**
     * App\Date
     *
     * @property integer $id
     * @property string $first_day_week
     * @method static \Illuminate\Database\Query\Builder|\App\Date whereId($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Date whereFirstDayWeek($value)
     * @mixin \Eloquent
     */
    class Date extends \Eloquent
    {
    }
}

namespace App {
    /**
     * App\DayOfWeek
     *
     * @property integer $id
     * @property string $name
     * @method static \Illuminate\Database\Query\Builder|\App\DayOfWeek whereId($value)
     * @method static \Illuminate\Database\Query\Builder|\App\DayOfWeek whereName($value)
     * @mixin \Eloquent
     */
    class DayOfWeek extends \Eloquent
    {
    }
}

namespace App {
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
    class FullLessons extends \Eloquent
    {
    }
}

namespace App {
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
    class Lessons extends \Eloquent
    {
    }
}

namespace App {
    /**
     * App\News
     *
     * @property integer $id
     * @property string $title
     * @property string $description
     * @property string $start_date
     * @property string $finish_date
     * @property boolean $important
     * @property string $imgFilePath
     * @property string $imgPosition
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Classe[] $classi
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Teacher[] $teacher
     * @method static \Illuminate\Database\Query\Builder|\App\News whereId($value)
     * @method static \Illuminate\Database\Query\Builder|\App\News whereTitle($value)
     * @method static \Illuminate\Database\Query\Builder|\App\News whereDescription($value)
     * @method static \Illuminate\Database\Query\Builder|\App\News whereStartDate($value)
     * @method static \Illuminate\Database\Query\Builder|\App\News whereFinishDate($value)
     * @method static \Illuminate\Database\Query\Builder|\App\News whereImportant($value)
     * @method static \Illuminate\Database\Query\Builder|\App\News whereImgFilePath($value)
     * @method static \Illuminate\Database\Query\Builder|\App\News whereImgPosition($value)
     * @mixin \Eloquent
     */
    class News extends \Eloquent
    {
    }
}

namespace App {
    /**
     * App\Room
     *
     * @property string $id
     * @property string $name
     * @method static \Illuminate\Database\Query\Builder|\App\Room whereId($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Room whereName($value)
     * @mixin \Eloquent
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\FullLessons[] $lessons
     */
    class Room extends \Eloquent
    {
    }
}

namespace App {
    /**
     * App\Subject
     *
     * @property string $id
     * @property string $name
     * @method static \Illuminate\Database\Query\Builder|\App\Subject whereId($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Subject whereName($value)
     * @mixin \Eloquent
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\FullLessons[] $lessons
     */
    class Subject extends \Eloquent
    {
    }
}

namespace App {
    /**
     * App\Teacher
     *
     * @property string $id
     * @property string $name
     * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereId($value)
     * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereName($value)
     * @mixin \Eloquent
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\FullLessons[] $lessons
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\News[] $news
     */
    class Teacher extends \Eloquent
    {
    }
}

namespace App {
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
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\DayOfWeek[] $dayOfWeek
     */
    class Time extends \Eloquent
    {
    }
}

namespace App {
    /**
     * App\User
     *
     * @property integer $id
     * @property string $username
     * @property string $password
     * @property string $remember_token
     * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
     * @method static \Illuminate\Database\Query\Builder|\App\User whereUsername($value)
     * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
     * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
     */
    class User extends \Eloquent
    {
    }
}

