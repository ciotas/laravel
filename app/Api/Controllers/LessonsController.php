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
}