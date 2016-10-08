<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title','body','updated_at'];

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @return mixed
     * TagList对应字段 tag_list
     */
    public function getTagListAttribute(){
        return $this->tags->lists('id')->all();
    }
}
