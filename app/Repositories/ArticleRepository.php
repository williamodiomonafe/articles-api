<?php

    namespace App\Repositories;

    use App\Article;
    use App\Repositories\Interfaces\ArticleRepositoryInterface;

    class ArticleRepository implements ArticleRepositoryInterface
    {

        /**
         * Create an article via create() method of the Interface
         *
         * @param $request
         * @return mixed
         */

        public function create($request)
        {
            $data = [
                'user_id' => auth()->user->id,
                'title' => $request->title,
                'body' => $request->body,
                'published' => $request->published,
            ];

            // Create article data in Model/Database and return data
            return Article::create($data);

        }


        /**
         * Get all articles via list() method of the Interface
         *
         * @return array
         */
        public function list()
        {
            // Get all articles and return data
            return Article::paginate(5);
        }


        /**
         * Get an article via getOne() method of the Interface
         *
         * @param $id
         * @return mixed
         */
        public function get($id)
        {
            // Get article using id and return data
            $article = Article::findorFail($id);

            if($ratings = $article->ratings()->get()) {
                $article['ratings'] = $ratings;
                $article['average_rating'] = number_format($article->ratings()->average('rating'), 1);
            } else {
                $article['ratings'] = 'No ratings yet.';
            }

            return $article;
        }


        /**
         * Updates an Article Implements via update() method of Interface
         *
         * @param $request
         * @param $id
         * @return mixed
         */
        public function update($request, $id)
        {
            // Get an article
            $article = Article::findOrFail($id);

            $data = [
                'user_id' => auth()->user->id,
                'title' => $request->title,
                'body' => $request->body,
                'published' => $request->published,
            ];


            // Update article
            return $article->update($data);
        }


        /**
         * Delete an article  via delete() method of the Interface
         *
         * @param id
         * @return bool|mixed|null
         * @throws \Exception
         */
        public function delete($id)
        {
            // GET specific article by id
            $article = Article::findOrFail($id);
            return $article->delete();
        }

        /**
         * Search for an article via search() method of the Interface
         *
         * @param $request
         * @return mixed
         */
        public function search($request)
        {
            $query = '%' . $request->do_query . '%';
            $articles = Article::where('title', 'LIKE', $query)
                                ->orWhere('body', 'LIKE', $query)
                                ->get();
            return $articles;
        }

    }

