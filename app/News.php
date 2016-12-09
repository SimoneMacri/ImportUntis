<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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