<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ArticleRepository;
use App\Article;

class ArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ArticleRepository $articles)
    {
        $this->article = $articles;
    }


    /**
     * Fetch all articles from database
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $article['data'] = Article::all();

        return response()->json($article, 200);
    }


    /**
     * Fetch specific article from database
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) {
        try {
            $article['data'] = Article::findOrFail($id);
        } catch(\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 501);
        }

        return response()->json($article, 200);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $data = [
            'user_id' => $request->input('user_id'),
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'published' => $request->input('published'),
        ];

        try {
            Article::create($data);
        } catch(\Exception $ex) {
            return response(["error" => $ex->getMessage()], 503);
        }

        return response()->json([], 201);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) {
        try {
            $article = Article::findOrFail($id);
            $article->title = $request->input('title');
            $article->body = $request->input('body');
            $article->published = $request->input('published');

            $article->update();
        } catch(\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 501);
        }

        return response()->json([], 200);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) {
        try {
            Article::destroy($id);
        } catch(\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 501);
        }

        return response()->json([], 410);
    }


}
