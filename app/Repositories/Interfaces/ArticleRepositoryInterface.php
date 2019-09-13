<?php
    /**
     * Article Repository Interface which defines
     * the structure and expected methods for the Article Repository
     *
     * @author Oshoname William-Sear Odiomonafe
     * @date 13/09/2019
     */

    namespace App\Repositories\Interfaces;

    use App\Article;

    interface ArticleRepositoryInterface
    {

        /**
         * Create an article method
         *
         * @param $request
         * @return mixed
         */
        public function create($request);


        /**
         * Get all Articles method
         *
         * @return mixed
         */
        public function getAll();


        /**
         * Get an Article method
         *
         * @param $id
         * @return mixed
         */
        public function getOne($id);

        /**
         * Update an article method
         *
         * @param $request
         * @param $id
         * @return mixed
         */
        public function update($request, $id);


        /**
         * Delete an article
         *
         * @param $id
         * @return mixed
         */
        public function delete($id);


        /**
         * @param $title
         * @return mixed
         */
        public function search($title);

    }

