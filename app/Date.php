<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Date
 *
 * @property integer $id
 * @property string $first_day_week
 * @method static \Illuminate\Database\Query\Builder|\App\Date whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Date whereFirstDayWeek($value)
 * @mixin \Eloquent
 */
class Date extends Model
{
    protected $table = 'date';
    public $timestamps = false;
    public $casts = ['first_day_week' => 'date'];


    public function setFirstDayWeekAttribute($attribute)
    {
        $this->attributes['first_day_week'] = \DateTime::createFromFormat('Ymd', trim($attribute));
    }
}
