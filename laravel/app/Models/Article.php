<?php

namespace App\Models;

use App\Filters\ArticleFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Oooiik\LaravelQueryFilter\Traits\Model\Filterable;

/**
 * @property string title
 * @property string image_path
 * @property string content
 * @property int created_user_id
 * @property User createdByUser
 */
class Article extends Model
{
    use HasFactory, SoftDeletes, Filterable;

    protected $fillable = [
        'title',
        'image_path',
        'content',
        'created_user_id'
    ];

    public $defaultFilter = ArticleFilter::class;
    public function createdByUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }
}
