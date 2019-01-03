<?php

namespace App\Matd;

use App\File\Content;

class MatdContent extends Content
{
    public function getContent()
    {
        $file = $this->header->getFile();
        $positions = $this->header->getPositions();
    }
}