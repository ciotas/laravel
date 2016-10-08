<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //更新子模型时更新父模型的时间戳updated_at
    protected $touches = array('article');

    public function articles(){
        return $this->belongsToMany(Article::class);
    }
}
