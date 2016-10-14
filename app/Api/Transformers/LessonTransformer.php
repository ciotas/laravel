<?php
/**
 * Created by PhpStorm.
 * User: lindy
 * Date: 2016/10/14
 * Time: 下午11:41
 */

namespace App\Api\Transformers;


use App\Lesson;
use League\Fractal\TransformerAbstract;

class LessonTransformer extends TransformerAbstract
{
    public function transform(Lesson $lesson){
        return [
            'title' => $lesson['title'],
            'content' => $lesson['intro'],
            'imageurl' =>$lesson['image']
        ];
    }
}