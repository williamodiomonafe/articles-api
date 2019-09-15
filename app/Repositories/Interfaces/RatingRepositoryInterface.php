<?php

namespace App\Repositories\Interfaces;

interface RatingRepositoryInterface
{

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function create($request, $id);

}