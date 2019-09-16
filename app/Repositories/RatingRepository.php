<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RatingRepositoryInterface;
use App\Rating;


class RatingRepository implements RatingRepositoryInterface
{

    public function create($request, $id)
    {
        $data = [
            'article_id' => $id,
            'user_id' => ($request->auth != null) ? $request->auth->id : 0,
            'rating' => $request->rating,
        ];

        $rating = Rating::create($data);
        return $rating;
    }

}