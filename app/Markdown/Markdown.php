<?php
/**
 * Created by PhpStorm.
 * User: lindy
 * Date: 16/9/3
 * Time: 下午1:22
 */

namespace App\Markdown;


class Markdown
{
    protected $parser;

    /**
     * Markdown constructor.
     * @param $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function markdown($text){
        $html=$this->parser->makeHtml($text);
        return $html;
    }
}