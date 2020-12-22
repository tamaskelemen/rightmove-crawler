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
    private function __construct()
    {
        try {
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

            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            Logger::error("Couldn't connect to Database: " . $e->getMessage());
        }
    }

    /**
     * A static method which returns an instance to make it universally available
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Empty clone method to prevent simultaneous connections
     */
    public function __clone() {}

    /**
     * A helper function to run prepared statements
     * @param $sql - the sql query
     * @param $params - if there are any conditions; passed as associative array
     * @return mixed
     */
    public function run($sql, $params = [], $targetObj = null)
    {
        try {
            if (!$params) {
                return $this->pdo->query($sql);
            }

            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);

            if (!is_null($targetObj)){
                $stmt->setFetchMode(PDO::FETCH_INTO, $targetObj);
            }

            $this->pdo->commit();
            return $stmt;

        } catch (Exception $e) {
            $this->pdo->rollBack();
            Logger::error("Error during preparing statement: " . $e->getMessage());
        }
    }


}
