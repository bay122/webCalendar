<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = "tags";
    protected $filable = ['name'];
    
    public function articles()//relacion muchos a muchos
    {
        return $this->belongsToMany('App\Articles')->withTimestamps();
    }
}
