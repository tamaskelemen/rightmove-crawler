<?php

namespace Models\Exceptions;

class MissingParametersException extends \Exception
{
    protected $message = "Missing parameters! Type -h or --help for more information about how to run this script.";
}
