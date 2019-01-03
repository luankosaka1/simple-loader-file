<?php

namespace App\File;

abstract class Content
{
    protected $header;

    public function __construct(Header $header)
    {
        $this->header = $header;    
    }

    public abstract function getContent();
}