<?php

namespace Post;

use Dotenv\Dotenv;
use PDO;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

class PdoAdapter
{
    private static $connection;

    private static function connect()
    {
        if (!isset(self::$connection)) {
            self::$connection = new PDO(
                'pgsql:host=' . $_ENV['PG_HOST'] . ';dbname=' . $_ENV['PG_DB'] . ';port=' . $_ENV['PG_PORT'],
                $_ENV['PG_USER'],
                $_ENV['PG_PASSWORD']);
        }
    }

    private static function unsetConnect()
    {
        self::$connection = null;
    }

    public static function returnAllRequest(string $sql, array $bindings = [], int $fetchMode = PDO::FETCH_ASSOC)
    {
        self::connect();
        $statement = self::$connection->prepare($sql);
        $statement->execute($bindings);
        $result = $statement->fetchAll($fetchMode);
        self::unsetConnect();
        return $result;
    }

    public static function returnOneRequest(string $sql, array $bindings = [])
    {
        self::connect();
        $query = self::$connection->prepare($sql);
        $query->execute($bindings);
        $foundTask = $query->fetch();
        self::unsetConnect();
        return $foundTask;
    }

    public static function noReturnRequest(string $sql, array $bindings = [])
    {
        self::connect();
        $query = self::$connection->prepare($sql);
        $query->execute($bindings);
        self::unsetConnect();
    }
}