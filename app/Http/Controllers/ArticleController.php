<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ArticleRepository;
use App\Article;
use App\Http\Requests\StoreArticleRequest;

class ArticleController extends Controller
{

    private $articleRepository;

    /**
     * ArticleController constructor.
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }


    /**
     * Fetch all articles from ArticleRepository
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $article['data'] = $this->articleRepository->getAll();
        return response()->json($article, 200);
    }


    /**
     * Fetch specific article from ArticleRepository
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) {
        $article = $this->articleRepository->getOne($id);
        return response()->json($article, 200);
    }


    /**
     * Stores an article into the ArticleRepository
     *
     * @param StoreArticleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreArticleRequest $request) {
        $article = $this->articleRepository->create($request);
        return response()->json($article, 201);
    }


    /**
     * Update an article in ArticleRepository
     *
     * @param StoreArticleRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreArticleRequest $request, $id) {
        $article = $this->articleRepository->update($request, $id);
        return response()->json($article, 200);
    }


    /**
     * Delete an article from ArticleRepository
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id) {
        $this->articleRepository->delete($id);
        return response()->json([], 410);
    }


}
