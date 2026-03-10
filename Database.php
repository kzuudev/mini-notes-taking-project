<?php 

class Database {
    public $connection;
    public $statement;

    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql: ' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = []) {

        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // $stmt = $this->connection->prepare($query);
        // $stmt->execute($params);

        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        
        return $this;
        
    }
    

    // for fetching specific note
    public function find() {

        return $this->statement->fetch();
    }

    // for fetching all notes
    public function findAll() {

        return $this->statement->fetchAll();
    }


    // check if it find anything in the database it could be notes, user, and post.
    public function findOrFail() {

        $result = $this->find();

        if(! $result) {
            abort();
        }

        return $result;
    }


}


?>