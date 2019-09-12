<?php

    namespace App\Repositories;

    use App\Article;
    use App\Repositories\Interfaces\ArticleRepositoryInterface;

    class ArticleRepository implements ArticleRepositoryInterface {

        /**
         * Get all articles
         * @return array
         */
        public function getAll()
        {
            return Article::all();
        }



        public function getOne(Article $article)
        {
            return $article;
        }
    }

