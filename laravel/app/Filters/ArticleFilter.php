<?php

namespace App\Filters;

use Oooiik\LaravelQueryFilter\Filters\QueryFilter;

class ArticleFilter extends QueryFilter
{
    public function title($title): void
    {
        $this->builder->where('title', 'like', "%$title%");
    }

    public function created_user_ids($created_user_ids): void
    {
        $this->builder->whereIn('created_user_id', $created_user_ids);
    }

    public function created_at_from($created_at_from): void
    {
        $this->builder->where('created_at', '>=', $created_at_from);
    }

    public function created_at_to($created_at_to): void
    {
        $this->builder->where('created_at', '<=', $created_at_to);
    }

}
