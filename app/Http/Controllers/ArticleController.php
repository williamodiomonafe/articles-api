<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ArticleRepository;
use Illuminate\Support\Facades\Auth;
use Firebase\JWT\JWT;

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
     * List all articles from ArticleRepository
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $article = $this->articleRepository->list();
        return response()->json($article, 200);
    }


    /**
     * Fetch specific article from ArticleRepository
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $article = $this->articleRepository->get($id);

            return response()->json($article, 200);
        }
        catch(\Exception $ex)
        {
            return response()->json(['error' => 'No result returned or Bad Request'], 400);
        }
    }


    /**
     * Stores an article into the ArticleRepository
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'required|min:5|max:100',
                'body' => 'required',
            ]);

            $article = $this->articleRepository->create($request);
        }
        catch(\Exception $ex)
        {
            return response(["error" => $ex->getMessage()], 503);
        }
        return response()->json($article, 201);
    }


    /**
     * Update an article in ArticleRepository
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $article = $this->articleRepository->update($request, $id);
            return response()->json($article, 200);
        }
        catch(\Exception $ex)
        {
            return response()->json(['error' => 'No result returned or Bad Request'], 400);
        }

    }


    /**
     * Delete an article from ArticleRepository
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        try {
            $this->articleRepository->delete($id);
            return response()->json([], 410);
        }
        catch(\Exception $ex)
        {
            return response()->json(['error' => 'No result returned or Bad Request'], 400);
        }

    }


    /**
     * Search for articles by title
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        try {
            $article = $this->articleRepository->search($request);

            return response()->json($article, 200);
        }
        catch(\Exception $ex)
        {
            return response()->json(['error' => 'No result returned or Bad Request'], 400);
        }
    }


}
