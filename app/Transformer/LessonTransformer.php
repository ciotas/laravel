<?php
/**
 * Created by PhpStorm.
 * User: lindy
 * Date: 2016/10/13
 * Time: 下午7:32
 */

namespace App\Transformer;


class LessonTransformer extends Transformer
{
    /**
     * @param $lessons
     * @return array
     */
    public function transform($lessons){
        return [
            'title' => $lessons['title'],
            'content' => $lessons['intro'],
            'imageurl' =>$lessons['image']
        ];
    }
}