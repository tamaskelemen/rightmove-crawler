<?php

namespace Models;

use Models\Exceptions\MissingParametersException;

class Test {

    public static $instance;

    private $database;

    /**
     * Returns a single app instance
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Run the application
     * @param $config
     */
    public function run($config) : void
    {
        try {
            Logger::info("The tests has started to run.");
            $this->database = $config['db'];

            $this->envCheck();

            $this->test();

        } catch (\Exception $exception) {
            echo $exception->getMessage();
            Logger::error($exception->getMessage());
        } finally {
            Logger::info("The script run has ended.");
        }
    }

    /**
     * Processes the given arguments.
     */
    private function test() : void
    {
        $files = [];
        foreach ($files as $file) {

        }
    }

    private static function getHelpText() : string
    {
        return "This is a description how to run this crawler. With parameter c, you can specify the distinct you would like to query. \n";
    }

    /**
     * @throws \Exception
     */
    private function envCheck()
    {
        if (PHP_SAPI != "cli") {
            throw new \Exception("Not command line enviroment!");
        }
    }

    public function getDatabase()
    {
        return $this->database;
    }
}
