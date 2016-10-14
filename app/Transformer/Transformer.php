<?php
/**
 * Created by PhpStorm.
 * User: lindy
 * Date: 2016/10/13
 * Time: 下午7:29
 */

namespace App\Transformer;


abstract class Transformer
{

    /**
     * @param $items
     * @return array
     */
    public function transformCollection($items)
    {
        return array_map([$this,'transform'],$items);
    }

    /**
     * @param $item
     * @return mixed
     */
    public abstract function transform($item);
}