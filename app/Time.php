<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


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
class Time extends Model
{
    protected $table = 'time';
    public $timestamps = false;

    public function dayOfWeek()
    {
        return $this->hasMany('App\DayOFWeek', 'id', 'day_id');
    }

}
