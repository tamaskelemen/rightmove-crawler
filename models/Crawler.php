<?php

namespace Models;

class Crawler
{
    public $postCode;

    public function __construct($postCode)
    {
        $this->postCode = $postCode;
    }

    public function crawl()
    {

    }
}
