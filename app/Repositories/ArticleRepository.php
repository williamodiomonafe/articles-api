<?php

    namespace App\Repositories;

    use App\Article;
    use App\Repositories\Interfaces\ArticleRepositoryInterface;

    class ArticleRepository implements ArticleRepositoryInterface {

        /**
         * Implement create() method of the Interface
         *
         * Create an article
         * @param $request
         * @return mixed
         */

        public function create($request)
        {
            try {
                // Collect all new article data
                $data = [
                    'user_id' => $request->user_id,
                    'title' => $request->title,
                    'body' => $request->body,
                    'published' => $request->published,
                ];

                // Create article data in Model/Database and return data
                return Article::create($data);
            } catch(\Exception $ex) {
                return response(["error" => $ex->getMessage()], 503);
            }
        }


        /**
         * Implement getAll() method of the Interface
         *
         * Get all articles
         * @return array
         */
        public function getAll()
        {
            // Get all articles and return data
            return Article::all();
        }


        /**
         * TODO: Implement get() method of the Interface
         *
         * Get an article
         * @param $id
         * @return mixed
         */
        public function getOne($id)
        {
            try {
                // Get article using id and return data
                return Article::findorFail($id);
            } catch(\Exception $ex) {
                return response()->json(['error' => $ex->getMessage()], 501);
            }
        }


        /**
         * TODO: Implements update() method of the Interface
         *
         * Updates an Article
         * @param $request
         * @param $id
         * @return mixed
         */
        public function update($request, $id)
        {
            try {
                // Get an article
                $article = Article::findOrFail($id);

                // Set new article values
//                $article->user_id = $request->user_id;
//                $article->title = $request->title;
//                $article->body = $request->body;
//                $article->published = $request->published;

                $data = [
                    'user_id' => $request->user_id,
                    'title' => $request->title,
                    'body' => $request->body,
                    'published' => $request->published,
                ];


                // Update article
                return $article->update($data);
            } catch(\Exception $ex) {
                return response()->json(['error' => $ex->getMessage()], 501);
            }
        }


        /**
         * TODO: Implement delete() method.
         *
         * @param id
         * @return bool|mixed|null
         * @throws \Exception
         */
        public function delete($id)
        {
            try {
                // GET specific article by id
                $article = Article::findOrFail($id);
                return $article->delete();
            } catch(\Exception $ex) {
                return response()->json(['error' => $ex->getMessage()], 501);
            }

        }


    }

