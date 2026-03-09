<?php 

class Database {
    public $connection;

    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql: ' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = []) {

        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);

        
        return $stmt;
        
    }
}


?>