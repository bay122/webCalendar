<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $filable = ['name'];
    
    public function articles()//relacion muchos a uno
    {
        return $this->hasMany('App\Article');
    }
}
