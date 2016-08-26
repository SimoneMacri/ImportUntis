<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Event
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $start_date
 * @property string $finish_date
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereStartDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereFinishDate($value)
 * @mixin \Eloquent
 */
class News extends Model
{
    protected $table = 'news';
    public $timestamps = false;

    public function classi()
    {
        return $this->belongsToMany('App\Classe', 'classe_news', 'news_id', 'classe_id');
    }

    public function teacher()
    {
        return $this->belongsToMany('App\Teacher', 'teacher_news', 'news_id', 'teacher_id');
    }

}