<?php 
abstract class Connection {
    private $serverDB = 'mysql:host=localhost;dbname=register_sales';
    private $user = "root";
    private $password = "";

    protected function connect() {
        try {
            $connection = new PDO($this->serverDB, $this->user, $this->password);
            $connection->exec("set names utf8");
            return $connection;
        } catch(PDOException $error) {
            echo $error->getMessage();
        }
    }
}