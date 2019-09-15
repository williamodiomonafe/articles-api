<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class Rating extends Model
    {
        /**
         * The attributes that are guarded against mass assignment.
         *
         * @var array
         */
        protected $guarded = [
            'id'
        ];
    }