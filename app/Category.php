<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps=false;

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        self::creating(function(Category $category){
            if (is_null($category->parent_id)){
                $category->level=0;
                $category->path='-';
            }else{
                $category->level=$category->parent->level+1;
                $category->path=$category->parent->path.$category->parent_id.'-';
            }
        });
    }

    public function parent()
    {
        return $this->belongsTo(category::class,'parent_id','id');
    }

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }
}