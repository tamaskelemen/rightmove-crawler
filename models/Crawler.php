<?php

namespace Models;

use Models\Request;
class Crawler
{
    public $postCode;

    public function __construct($postCode)
    {
        $this->postCode = $postCode;
    }

    public function crawl()
    {
//        $html = Request::getHtml();

        $postcode = new PostCode();
        $postcode->name = "London";
        $postcode->date = "2020-12-22 12:00:00";

        var_dump($postcode->save());
        //Get html page
        //Parse
        //find data: number of sold properties
        //address, type of property and price of 5 most expensive properties sold in the last 10 years
    }

    private function parse()
    {
    }
}
