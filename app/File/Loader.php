<?php

namespace App\File;

use PhpOffice\PhpSpreadsheet\IOFactory;

class Loader
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function load()
    {
        return $this->getFileCreate()
            ->setReadDataOnly(true)
            ->load($this->file);
    }

    private function getFileCreate()
    {
        return IOFactory::createReader($this->getFileType());
    }

    private function getFileType()
    {
        return IOFactory::identify($this->file);
    }
}