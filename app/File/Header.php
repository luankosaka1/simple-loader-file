<?php

namespace App\File;

use App\File\SimpleHeader;

class Header
{
    private $header;
    private $file;

    public function __construct(SimpleHeader $header, $file)
    {
        $this->header = $header;
        $this->file = $file;
    }

    public function getPositions()
    {
        return $this->header->getPositions($this->file);
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getHeader()
    {
        return $this->header;
    }

}