<?php

namespace App\Http\Controllers;

use App\Executors\ArticleExecutor;
use App\Http\Requests\Article\ArticleIndexRequest;
use App\Http\Requests\Article\ArticleStoreRequest;
use App\Http\Requests\Article\ArticleUpdateRequest;
use App\Http\Resources\Article\ArticleResource;

class ArticleController extends Controller
{
    public function __construct(public ArticleExecutor $executor)
    {
    }

    public function index(ArticleIndexRequest $request)
    {
        $result = $this->executor->index($request->validated());
        return $this->responseSuccess('Article data', ArticleResource::collection($result));
    }

    public function show($id)
    {
        $result = $this->executor->show($id);
        if (!$result) return $this->responseNotFound('Article not found');
        return $this->responseSuccess('Article data', new ArticleResource($result));
    }

    public function store(ArticleStoreRequest $request)
    {
        $result = $this->executor->store($request->validated());
        if (!$result) return $this->responseUnauthorized('Invalid credentials');
        return $this->responseSuccess('Article created successfully', new ArticleResource($result));
    }

    public function update(ArticleUpdateRequest $request, $id)
    {
        $result = $this->executor->update($id, $request->validated());
        if (!$result) return $this->responseUnauthorized('Invalid credentials');
        return $this->responseSuccess('Article updated successfully', new ArticleResource($result));
    }

    public function destroy($id)
    {
        $success = $this->executor->destroy($id);
        if (!$success) return $this->responseUnauthorized('Invalid credentials');
        return $this->responseSuccess('Article deleted successfully');
    }
}
