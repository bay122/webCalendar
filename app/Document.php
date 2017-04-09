<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = "documents";
    protected $filable = ['name', 'route', 'article_id'];
    
    public function artcile()//relacion muchos a uno
    {
        return $this->belongsTo('App\Article');
    }
}
