<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\DayOfWeek
 *
 * @property integer $id
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\DayOfWeek whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DayOfWeek whereName($value)
 * @mixin \Eloquent
 */
class DayOfWeek extends Model
{
    protected $table = 'day_of_week';
}