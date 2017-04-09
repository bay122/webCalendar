<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = "articles";
    protected $filable = ['name','title', 'content', 'is_task', 
                        'contains_document', 'start_date', 'ending_date', 
                        'importance', 'responsible_id', 'creator_id', 
                        'category_id'];
    
    public function category() //relacion uno a muchos
    {
        return $this->belongsTo('App\Category');
    }
    
    public function user() //relacion uno a muchos
    {
        return $this->belongsTo('App\User');
    }
    
    public function documents() //relacion muchos a uno
    {
        return $this->hasMany('App\Document');
    }
    
    public function tags() //relacion muchos a muchos
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
}
