<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Room
 *
 * @property string $id
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\Room whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Room whereName($value)
 * @mixin \Eloquent
 */
class Room extends Model
{
    protected $table = 'room';
    public $timestamps = false;
    protected $casts = ['id'=> 'string'];
}
