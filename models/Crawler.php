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


        //TODO: implement crawling logic here. I get too tired to implement it on a fancy way with wget (curl is blocked - didnt debugged it.)

        //Mocking data:
        $postcode = new Estate();
        $postcode->address = "London teszt City teszt";
        $postcode->type = "flat";
        $postcode->price = "22222";
        $postcode->post_code = $this->postCode;
        $postcode->date = date("Y-m-d H:i:s");

        if ($postcode->save()) {
            Logger::info("Successfully saved estate: " . json_encode($postcode));
        }

    }

    private function parse()
    {
    }
}
