<?php

namespace Models;

use Models\Exceptions\MissingParametersException;

class App {

    public static $instance;

    private $arguments;
    private $database;

    const SHORT_OPTIONS = "c:h";
    const LONG_OPTIONS = [
        'help',
    ];

    /**
     * App constructor.
     */
    public function __construct()
    {
        $this->arguments = getopt(self::SHORT_OPTIONS, self::LONG_OPTIONS);
    }

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
            Logger::info("The script has started to run.");
            $this->database = $config['db'];

            $this->envCheck();

            $this->validateParameters();

            $this->process();

        } catch (\Exception $exception) {
            echo $exception->getMessage();
            Logger::error($exception->getMessage());
        } finally {
            Logger::info("The script run has ended.");
        }
    }

    /**
     * @throws MissingParametersException
     */
    public function validateParameters()
    {
        if (empty($this->arguments)) {
            throw new MissingParametersException();
        }

        //TODO: This must check if parameters are listed in option constants.
    }

    /**
     * Processes the given arguments.
     */
    private function process() : void
    {
        foreach ($this->arguments as $key => $argument) {
            if ($key === "help" || $key === 'h' ) {
                echo self::getHelpText();
                continue;
            }
            if ($key === 'c') {
                $crawrler = new Crawler($argument);
                $crawrler->crawl();
                continue;
            }
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
}
