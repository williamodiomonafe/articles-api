<?php

namespace App\Http\Controllers;

use App\Repositories\RatingRepository;
use Illuminate\Http\Request;
use App\Rating;

class RatingController extends Controller
{
    /**
     * @var RatingRepository
     */
    public $ratingRepository;

    /**
     * RatingController constructor.
     * @param RatingRepository $ratingRepository
     */
    public function __construct(RatingRepository $ratingRepository)
    {
        $this->ratingRepository = $ratingRepository;
    }


    /**
     * Stores an article rating via the RatingRepositoryInterface
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $id)
    {
        try {
            $rating = $this->ratingRepository->create($request, $id);
            return response()->json($rating, 200);
        } catch(\Exception $ex) {
            return response()->json(['error' => 'No result returned or Bad Request'], 400);
        }
    }
}