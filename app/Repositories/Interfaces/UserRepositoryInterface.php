<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{

    /**
     * @param $request
     * @return mixed
     */
    public function create($request);
}