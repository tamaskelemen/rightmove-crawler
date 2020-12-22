<?php

namespace Models;

use Tests;

class Test
{
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
     * @param $config array
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
        $files = $this->getTestFileList();

        foreach ($files as $file) {

             $class = new \ReflectionClass("Tests\\".substr($file, 0, -4));

             foreach ($class->getMethods() as $object) {
                 $testObject = new $class->name;
                 $testObject->{$object->name}();

             }

        }
    }

    private function getTestFileList()
    {
        $files = scandir(__DIR__ . "/../tests");
        array_shift($files);
        array_shift($files);

        return $files;
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
