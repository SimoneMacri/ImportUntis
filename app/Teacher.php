<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Teacher
 *
 * @property string $id
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Teacher whereName($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\FullLessons[] $lessons
 */
class Teacher extends Model
{
    protected $table = 'teacher';
    public $timestamps = false;
    protected $casts = ['id'=> 'string'];

    public function lessons()
    {
        return $this->hasMany('App\FullLessons', 'teacher_id', 'id');
    }
}
