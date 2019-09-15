<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The attributes that are guarded against mass assignment.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    public function ratings() {
        return $this->hasMany('App\Rating');
    }
}
