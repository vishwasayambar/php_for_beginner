<?php

class Database
{
    public $connection;

    /*
     * Here dsn previous we have hardcoded so we have used config array and used http query builder but still we have hardcoded in array
     * like when we deploy it on prod or stage we have to change the configs so we have make it dynamic so take it as parameter of constructor
     * also username and password also and also set default values
     */

    function __construct($config, $username = 'root', $password = '')
    {

        $dsn = 'mysql:' . http_build_query($config, '', ';'); // this is used to build a query from array byDefault & is separator but we need ; so we have option to change

//        Also we dont need to tell query each time to fetch mode we can pass it here for common all FETCH_ASSOC;
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    public function query($query, $parameters = [])
    {

        $statement = $this->connection->prepare($query);
        $statement->execute($parameters);// to Avoid SQL injection we are sending param and using in query inline

        // now here we have used fetchALl method which return collection event though we fetch one record like so we can use direct only fetch
//        But sometimes we need collection also so in for both cases that fetch should be dynamic so return only $statement
//        return $statement->fetchAll(PDO::FETCH_ASSOC);

        return $statement;
    }

}

//dd($db->query());