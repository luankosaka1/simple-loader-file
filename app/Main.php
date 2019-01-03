<?php

namespace App;

use App\File\Loader;
use App\File\Header;
use App\Matd\MatdHeader;
use App\File\Content;
use App\Matd\MatdContent;

class Main
{
    public static function run()
    {
        $file = (new Loader('./teste.xlsx'))->load();
        $header = new Header(new MatdHeader, $file);
        $content = new MatdContent($header);
        $content->getContent();
    }
}