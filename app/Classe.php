<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
class Classe extends Model
{
    protected $table = 'classe';
    public $timestamps = false;
    protected $casts = ['id'=> 'string'];

    public function lessons()
    {
        return $this->hasMany('App\FullLessons', 'classe_id', 'id');
    }

    public function news()
    {
        return $this->belongsToMany('App\News', 'classe_news', 'classe_id', 'news_id');
    }

}
