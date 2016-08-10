<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
class Date extends Model
{
    protected $table = 'date';
    public $timestamps = false;
}
