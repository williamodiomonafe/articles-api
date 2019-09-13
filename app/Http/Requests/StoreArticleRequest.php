<?php

    namespace App\Http\Requests;

    use Illuminate\Http\Request;

    class StoreArticleRequest extends Request {


        public function rules ()
        {
            return [
                'user_id' => 'required|numeric',
                'title' => 'required|alphanumeric|min:10',
                'body' => 'required|min:20',
            ];
        }
    }