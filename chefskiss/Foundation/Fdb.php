<?php

class Fdb
{
    /**
     * @var $_conn PDO Variabile che stabilisce la connessione con il database
     */
    private $_conn;

    private static $_instance = null;
    /*
    private $_query;

    /**
     * @var $_stmt PDOStatement Variabile che memorizza l'istanza dello statement del DB
     */
    /*
    private $_stmt;

    private $_result;

    protected $_key;

    protected $_return_class;

    protected $_table;

    protected $_auto_increment = false;
    */

    private function __construct()
    {
        /*if (!$this->existConn()){
            $this->connect();
        }*/

        if (!$this->existConn()) {
            try {
                $this->_conn = new PDO("mysql:host=127.0.0.1;dbname=chefskiss", 'root', 'pippo');
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }

        if ($this->_conn!= null) echo 'connessione stabilita '.get_class($this->_conn);
        var_dump($this->_conn);
    }

    public static function getInstance(){
        if (self::$_instance == null) {
            self::$_instance = new Fdb();
        }
        return self::$_instance;
    }

    /**
     * Funzione che permette la connessione al server del database
     */
    public function connect(){
        try{
            $this->_conn = new PDO("mysql:host=127.0.0.1;dbname=chefskiss", 'root', 'pippo');
            if ($this->_conn != null) echo 'Connessione avviata';
        } catch (PDOException $e){
            print $e->getMessage();
        }
    }

    /**
     * Verifica l'esistenza della connessione con il database
     * @return bool
     */
    public function existConn(): bool {
        if($this->_conn != null){
            return true;
        } else
            return false;
    }

    /**
     * Questa funzione inizializza una query pronta per essere eseguita
     * @param string $query
     * @return bool
     */
    public function createStatement(string $query)
    {
        $this->_conn->beginTransaction();
        $this->_query = $query;
        if ($this->_conn != null)
            echo 'daje';
        else
            echo 'Non è stata stabilita una connessione ';
        $this->_stmt = $this->_conn->prepare($this->_query);
        if (!$this->_query)
            return false;
        else
            return true;
    }

    /**
     * Questa funzione serve a prelevare dati dal database e caricarli sul programma
     * @param string $id
     * @return array
     */
    public function load(string $id) : array
    {
        $query = "SELECT * FROM $this->_table WHERE $this->_key = $id";
        $result = $this->_conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Questa funzione serve ad inserire i dati di una nuova istanza di un oggetto all'interno del database
     * @param $object
     * @return bool|mixed
     */
    public function insertDb($class, $object){

        try {
            $this->_conn->beginTransaction();
            $query = "INSERT INTO " . $class::getTable() . " VALUES " . $class::getValues();
            echo $query;
            $stmt = $this->_conn->prepare($query);
            $class::bind($stmt, $object);
            $stmt->execute();
            $id = $this->_conn->lastInsertId();
            $this->_conn->commit();
            $this->closeConn();
            return $id;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $this->_conn->rollBack();
            return null;
        }

        /*$i = 0;
        $values='';
        $fields='';
        foreach ($object as $key=>$value) {
            if (!($this->_auto_increment && $key == $this->_key) && substr($key, 0, 1)!='_') {
                if ($i==0) {
                    $fields.='`'.$key.'`';
                    $values.='\''.$value.'\'';
                } else {
                    $fields.=', `'.$key.'`';
                    $values.=', \''.$value.'\'';
                }
                $i++;
            }
        }
        $query='INSERT INTO '.$this->_table.' ('.$fields.') VALUES ('.$values.')';
        echo $query.' ';
        echo $this->_table;
        $this->_stmt = $this->_conn->prepare($query);
        $return = $this->_stmt->execute();
        $this->_conn->commit();
        $this->closeConn();
        if ($this->_auto_increment) {
            $this->_conn->beginTransaction();
            $query='SELECT LAST_INSERT_ID() AS `id`';
            $this->_stmt = $this->_conn->prepare($query);
            $this->_stmt->execute();
            $this->_conn->commit();
            $this->closeConn();
            $result=$this->getResult();
            return $result['id'];
        } else {
            return $return;
        }
        */

    }

    /**
     * Questa funzione serve a rimuovere i dati di una determinata istanza di un oggetto dal database
     * @param $object
     * @return bool
     */
    public function remove($object){

        $arrayObject = get_object_vars($object);
        $query = 'DELETE ' .
                'FROM `'.$this->_table.'` ' .
                'WHERE `'.$this->_key.'` = \''.$arrayObject[$this->_key].'\'';
        unset($object);
        $this->createStatement($query);
        return $this->execStatement();
    }

    /**
     * Funzione che esegue la query precedentemente istanziata
     * @return bool
     */
    public function execStatement()
    {
        if ($this->_stmt != null) {
            $this->_result = $this->_stmt->execute();
            $this->_conn->commit();
            $this->closeConn();
            return true;
        } else
            return false;
    }

    /**
     * Chiude la connessione con il database
     */
    public function closeConn(){
        static::$_instance = null;
    }

    /**
     * Ottiene i risultati di una query precedentemente eseguita e li riordina all'interno di un array
     * @return false
     */
    public function getResult()
    {
        if ($this->_result != false){
            $row_number = $this->_stmt->rowCount();
            echo "Numero di risultati ".$row_number;
            if ($row_number > 0){
                $result = $this->_stmt->fetchAll(PDO::FETCH_ASSOC);
                $this->_result = false;
                return $result;
            }
        }
        return false;
    }

    /**
     * Restituisce un oggetto della classe Entity impostata in _return_class contenente i risultati della query
     * @return false
     */
    public function getObject(){
        $rowNumber = $this->_stmt->rowCount();
        if ($rowNumber > 0) {
            $row = $this->_stmt->fetchObject($this->_return_class);
            $this->_result = false;
            return $row;
        } else
            return false;
    }

    /**
     * Restituisce un array di oggetti contenenti il risultato della query
     * @return array|false
     */
    public function getArrayObject(){
        $rowNumber = $this->_stmt->rowCount();
        if ($rowNumber > 0){
            $result = array();
            while ($row = $this->_stmt->fetchObject($this->_return_class)){
                $result[] = $row;
            }
            $this->_result = false;
            return $result;
        } else
            return false;
    }

    /**
     * Cerca all'interno del database
     * @param array $parametri
     * @param string $ordinamento
     * @param string $limite
     * @return array|false
     */
    public function search($parametri = array(), $ordinamento = '', $limite = ''){
        $filtro = '';
        for ($i=0; $i<count($parametri); $i++){
            if ($i>0) $filtro .= ' AND';
            $filtro .= ' `'.$parametri[$i][0].'` '.$parametri[$i][1].' \''.$parametri[$i][2].'\'';
        }
        $query='SELECT * ' .
            'FROM `'.$this->_table.'` ';
        if ($filtro != '')
            $query.='WHERE '.$filtro.' ';
        if ($ordinamento!='')
            $query.='ORDER BY '.$ordinamento.' ';
        if ($limite != '')
            $query.='LIMIT '.$limite.' ';
        $this->createStatement($query);
        $this->execStatement();
        return $this->getArrayObject();
    }
}