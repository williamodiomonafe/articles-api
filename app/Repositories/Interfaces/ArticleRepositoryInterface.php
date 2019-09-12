<?php

    namespace App\Repositories\Interfaces;

    use App\Article;

    interface ArticleRepositoryInterface
    {

        public function getAll();

        public function getOne(Article $article);

    }

