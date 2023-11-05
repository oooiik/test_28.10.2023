<?php

namespace App\Executors;

use App\Models\Article;

class ArticleExecutor
{
    public function index($filters)
    {
        return Article::filter($filters)->get();
    }

    public function show($id)
    {
        return Article::find($id);
    }

    public function store($data)
    {
        $image = $data['image'];
        unset($data['image']);
        $data['image_path'] = $image->store('images', 'public');

        $data['created_user_id'] = auth()->id();

        return Article::create($data);
    }

    public function update($id, $data)
    {
        $article = Article::find($id);
        if (!$article) return false;

        $image = $data['image'];
        unset($data['image']);
        $data['image_path'] = $image->store('articles', 'public');

        return $article->update($data);
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        if (!$article) return false;
        return $article->delete();
    }
}
