<?php

class Database
{
    public $connection;

    function __construct()
    {
        $this->connection = new PDO('mysql:host=127.0.0.1;port=3306;dbname=learning;charset=utf8mb4', 'root', '');
    }

    public function query($query)
    {

        $statement = $this->connection->prepare($query);
        $statement->execute();

        // now here we have used fetchALl method which return collection event though we fetch one record like so we can use direct only fetch
//        But sometimes we need collection also so in for both cases that fetch should be dynamic so return only $statement
//        return $statement->fetchAll(PDO::FETCH_ASSOC);

        return $statement;
    }

}

//dd($db->query());