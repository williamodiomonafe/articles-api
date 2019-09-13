<?php

    namespace App\Repositories;

    use App\Article;
    use App\Repositories\Interfaces\ArticleRepositoryInterface;

    class ArticleRepository implements ArticleRepositoryInterface
    {

        /**
         * Implement create() method of the Interface
         *
         * Create an article
         * @param $request
         * @return mixed
         */

        public function create($request)
        {
            $this->validate($request, [
                'user_id' => 'required|numeric',
                'title' => 'required|alphanumeric|min:10|max:100',
                'body' => 'required',
            ]);

            $data = [
                'user_id' => $request->user_id,
                'title' => $request->title,
                'body' => $request->body,
                'published' => $request->published,
            ];

            // Create article data in Model/Database and return data
            return Article::create($data);

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
            return Article::paginate(5);
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
            // Get article using id and return data
            return Article::findorFail($id);
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
            // GET specific article by id
            $article = Article::findOrFail($id);
            return $article->delete();
        }


        // TODO: Implement search() method.
        public function search($title)
        {
            $title = '%' . $title . '%';
            $articles = Article::where('title', 'LIKE', $title)->get();
            return $articles;
        }

    }

