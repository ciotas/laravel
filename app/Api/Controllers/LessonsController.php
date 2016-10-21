<?php
/**
 * Created by PhpStorm.
 * User: lindy
 * Date: 2016/10/14
 * Time: 下午10:58
 */

namespace App\Api\Controllers;

use App\Api\Transformers\LessonTransformer;
use App\Lesson;

class LessonsController extends BaseController
{
    public function index(){
        $lessons = Lesson::all();
        return $this->collection($lessons, new LessonTransformer());
    }

    public function show($id){
        $lesson = Lesson::find($id);
        if(!$lesson){
            return $this->response->errorNotFound('lesson not found');
        }
        return $this->item($lesson,new LessonTransformer());
    }
}