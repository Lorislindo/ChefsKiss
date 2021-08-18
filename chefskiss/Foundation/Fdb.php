<?php


class Fdb
{
    private  $_connection;

    private $query;

    protected $_key;

    protected $_return_table;

    protected $_auto_increment = false;

    public function __construct()
    {
        if (!$this->existConn()){
            $this->connect();
        }
    }

    /* Funzione che permette la connessione al server del database */
    public function connect(){
        try{
            $this->_connection = new PDO("mysql:host=127.0.0.1;dbname=chefkiss", 'root', 'pippo');
        } catch (PDOException $e){
            print $e->getMessage();
        }
    }

    /* Funzione che verifica se l'esistenza della connessione con il database */
    public function existConn(): bool {
        if($this->_connection != null){
            return true;
        }
        return false;
    }

    public function query(string $query)
    {
        $this->query = $query;
    }

    /*
    Funzione per prelevare dati da un database e caricarli sul programma
    */
    public function load(string $id) : array
    {
        $query = "SELECT * FROM users WHERE user_id = $id";
        $result = $this->_connection->query($query)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /*
    Funzione per inserire nuovi dati all'interno del database (da migliorare)
    */
    public function insert(string $table_name, string $column){


        /*$query = "INSERT INTO users (email, password) VALUES (:email, :password)";

        $stmt = $this->dbConnect->prepare($query);
        if($email != null & $password != null){
            $stmt->execute(array(
                ':email'=>$email,
                ':password'=>$password
            ));
        }*/
    }

    /*
    Funzione che permette di rimuovere elementi dal database tramite un determinato id o tutt'al più l'email
    */
    public function remove(string $id=null, string $email=null){

        if($id != null){
            $query = "DELETE FROM users WHERE user_id = :id";
            $stmt = $this->_connection->prepare($query);
            $stmt->execute(array(':id'=>$id));
        } else if($email != null & $id == null){
            $query = "DELETE FROM users WHERE email = :email";
            $stmt = $this->_connection->prepare($query);
            $stmt->execute(array(':email'=>$email));
        }
    }

    public function execQuery()
    {
        $sbt = $this->_connection->prepare($this->query);
        $sbt->execute();
    }

    public function close(){
        $this->_connection = null;
    }
}