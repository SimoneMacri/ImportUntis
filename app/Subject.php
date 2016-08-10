<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Subject
 *
 * @property string $id
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\Subject whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Subject whereName($value)
 * @mixin \Eloquent
 */
class Subject extends Model
{
    protected $table = 'subject';
    public $timestamps = false;
    protected $casts = ['id'=> 'string'];
}
