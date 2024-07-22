<?php 
namespace App\database;

use PDO;
use PDOStatement;

/**
 * Sqlite
 */
class Sqlite {
    public $connection = null;
    public $fetchMode = PDO::FETCH_ASSOC;
    
    /**
     * construct
     *
     * @param  string $path : path of the database
     * @param  PDOstatement $fetchMode
     * @return void
     */
    public function __construct (string $path, PDOStatement $fetchMode = null) {
        $this->fetchMode = $fetchMode ?? $this->fetchMode;
        $this->connection = new PDO("sqlite:" . $path, null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => $this->fetchMode,
        ]);
    }

    public function queryResult ($query) {
        return $this->connection->query($query)->fetchAll();
    }

    public function queryParamResult (string $query, array $parametersArray) {
        $statement = $this->connection->prepare($query);
        $statement->execute($parametersArray);
        return $statement->fetchAll();
    }
    
}