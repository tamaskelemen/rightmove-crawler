<?php
namespace models;

use PDO;
use PDOException;
use Exception;

class Database
{
    private $host;
    private $dbName;
    private $username;
    private $password;
    private $charset;
    protected $pdo;
    protected static $instance;

    /**
     * Create a database connection when an object is created.
     */
    private function __construct() {

        $app = App::instance();
        $config = $app->getDatabase();

        foreach ($config as $key => $value){
            $this->$key = $value;
        }

        /**
         * Setting PDO attributes:
         * ATTR_ERRMODE => Throw exceptions
         * ATTR_DEFAULT_FETCH_MODE => Set default fetch mode. Returns an anonymous object with property names that correspond to the column names.
         * ATTR_EMULATE_PREPARES => Disables emulation of prepared statements. FALSE = try to use native prepared statements.
         */
        $options  = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES   => FALSE,
        );

        $dsn = "{$this->host};dbname={$this->dbName};charset={$this->charset};";
        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            ExceptionHandler::handleAndLogPDO("Couldn't connect to Database", $e);
        }
    }

}
