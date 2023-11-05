<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class ArticleObserver
{
    public function saved(Article $article): void
    {
        if ($article->isDirty('image_path')) {
            $oldImagePath = $article->getOriginal('image_path');
            if ($oldImagePath) {
                Storage::disk('public')->delete($oldImagePath);
            }
        }
    }

    /**
     * Handle the Article "created" event.
     */
    public function created(Article $article): void
    {
        //
    }

    /**
     * Handle the Article "updated" event.
     */
    public function updated(Article $article): void
    {
        //
    }

    /**
     * Handle the Article "deleted" event.
     */
    public function deleted(Article $article): void
    {
        if ($article->image_path) {
            Storage::disk('public')->delete($article->image_path);
        }
    }

    /**
     * Handle the Article "restored" event.
     */
    public function restored(Article $article): void
    {
        //
    }

    /**
     * Handle the Article "force deleted" event.
     */
    public function forceDeleted(Article $article): void
    {
        if ($article->image_path) {
            Storage::disk('public')->delete($article->image_path);
        }
    }
}
