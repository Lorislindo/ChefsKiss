<?php

class Fdb
{
    /**
     * @var $_conn PDO Variabile che stabilisce la connessione con il database
     */
    private $_conn;

    private static $_instance = null;

    private static $class = 'Fdb';
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

    public function __construct()
    {

        if (!$this->existConn()) {
            try {
                $this->_conn = new PDO("mysql:host=127.0.0.1;dbname=chefskiss", 'root', 'pippo');
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }

        if ($this->_conn!= null) echo 'connessione stabilita '. $this->_conn->errorInfo();
        var_dump($this->_conn);
    }

    /**
     * @return mixed|Fdb
     */
    public static function getInstance(){
        if (USingleton::getInstance(self::$class) == null) {
            USingleton::getInstance(self::$class);
        }
        return USingleton::getInstance(self::$class);
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
     * Questa funzione carica in $result il risultato di una query. Può produrre sia risultati singoli
     * che array di risultati (se le righe prodotte sono maggiori di una)
     * @param $class
     * @param $field
     * @param $id
     * @return array|mixed|null
     */
    public function loadDb($class, $field, $id)
    {
        try {
            // $this->db->beginTransaction();
            $query = "SELECT * FROM " . $class::getTable() . " WHERE " . $field . "='" . $id . "';";
            echo $query;
            $stmt = $this->_conn->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            if ($num == 0) {
                $result = null;        //nessuna riga interessata. return null
            } elseif ($num == 1) {                          //nel caso in cui una sola riga fosse interessata
                $result = $stmt->fetch(PDO::FETCH_ASSOC);   //ritorna una sola riga
            } else {
                $result = array();                         //nel caso in cui piu' righe fossero interessate
                $stmt->setFetchMode(PDO::FETCH_ASSOC);   //imposta la modalità di fetch come array associativo
                while ($row = $stmt->fetch())
                    $result[] = $row;                    //ritorna un array di righe.
            }
            //  $this->closeDbConnection();
            return $result;
        } catch (PDOException $e) {
            echo "Attenzione errore: " . $e->getMessage();
            $this->_conn->rollBack();
            return null;
        }
    }

    /**
     * Verifica l'accesso di un utente, controllando le credenziali (email e password) siano presenti nel db
     * @param $email
     * @param $pass
     * @return mixed|null
     */
    public function checkIfLogged($email, $pass){
        try {
            $class = 'FUtente';
            $query = 'SELECT * FROM ' . $class::getTable() . " WHERE email ='" . $email . "' AND password ='" . $pass . "';";
            $stmt = $this->_conn->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            if ($num == 0) {
                $result = null;
            } else {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return $result;
        } catch (PDOException $e){
            echo "Attenzione errore: " . $e->getMessage();
            $this->_conn->rollBack();
            return null;
        }
    }

    /**
res     * @param $object
     * @param $class
     * @return bool|mixed
     */
    public function insertDb($class, $object){

        try {
            $this->_conn->beginTransaction();
            $query = "INSERT INTO " . $class::getTable() . " " . str_replace(array(':', ',', ')'), array('`', '`,', '`)'), $class::getValues()) . " VALUES " . $class::getValues();
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

    }

    public function updateDB ($class, $field, $newvalue, $pk, $id)
    {
        try {
            $this->_conn->beginTransaction();
            $query = "UPDATE " . $class::getTable() . " SET " . $field . "='" . $newvalue . "' WHERE " . $pk . "='" . $id . "';";
            $stmt = $this->_conn->prepare($query);
            $stmt->execute();
            $this->_conn->commit();
            $this->closeConn();
            return true;
        } catch (PDOException $e) {
            echo "Attenzione errore: " . $e->getMessage();
            $this->_conn->rollBack();
            return false;
        }
    }

    /**
     * Questa funzione verifica quante righe sono state prodotte da una determinata query
     * @param $class
     * @param $field
     * @param $id
     * @return int|null
     */
    public function getRowNum($class, $field, $id){
        try {
            $this->_conn->beginTransaction();
            $query = "SELECT * FROM " . $class::getTable() . " WHERE " . $field . "='" . $id . "';";
            $stmt = $this->_conn->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            $this->closeConn();
            return $num;
        } catch (PDOException $e) {
            echo "Attenzione errore: " . $e->getMessage();
            $this->db->rollBack();
            return null;
        }
    }

    /**
     * Questa funzione serve a rimuovere i dati di una determinata istanza di un oggetto dal database
     * @param $object
     * @return bool
     */
    public function deleteDB ($class, $field, $id)
    {
        try {
            $result = null;
            $this->_conn->beginTransaction();
            $esiste = $this->existDB($class, $field, $id);
            if ($esiste) {
                $query = "DELETE FROM " . $class::getTable() . " WHERE " . $field . "='" . $id . "';";
                $stmt = $this->_conn->prepare($query);
                $stmt->execute();
                $this->_conn->commit();
                $this->closeConn();
                $result = true;
            }
        } catch (PDOException $e) {
            echo "Attenzione errore: " . $e->getMessage();
            $this->db->rollBack();
            //return false;
        }
        return $result;
    }

    /**
     * Funzione che esegue la query precedentemente istanziata
     * @return bool
     */

    public function existDB ($class, $field, $id)
    {
        try {
            $query = "SELECT * FROM " . $class::getTable() . " WHERE " . $field . "='" . $id . "'";
            $stmt = $this->_conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($result) == 1) return $result[0];  //rimane solo l'array interno
            else if (count($result) > 1) return $result;  //resituisce array di array
            $this->closeConn();
        } catch (PDOException $e) {
            echo "Attenzione errore: " . $e->getMessage();
            return null;
        }
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
     * Cerca all'interno del database
     * @param array $parametri
     * @param string $ordinamento
     * @param string $limite
     * @return array|false
     */
    public function searchDb($class, $parametri = array(), $ordinamento = '', $limite = ''){
        $filtro = '';
        try {
            for ($i = 0; $i < count($parametri); $i++) {
                if ($i > 0) $filtro .= ' AND';
                $filtro .= ' `' . $parametri[$i][0] . '` ' . $parametri[$i][1] . ' \'' . $parametri[$i][2] . '\'';
            }
            $query = 'SELECT * ' .
                'FROM `' . $class::getTable() . '` ';
            if ($filtro != '')
                $query .= 'WHERE ' . $filtro . ' ';
            if ($ordinamento != '')
                $query .= 'ORDER BY ' . $ordinamento . ' ';
            if ($limite != '')
                $query .= 'LIMIT ' . $limite . ' ';
            $stmt = $this->_conn->prepare($query);
            $stmt->execute();
            $numRow = $stmt->rowCount();
            if ($numRow == 0){
                $result = null;
            } elseif ($numRow == 1) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $result = array();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $stmt->fetch()) $result[] = $row;
            }
            return array($result, $numRow);
        } catch (PDOException $e){
            echo "Attenzione errore: " . $e->getMessage();
            $this->_conn->rollBack();
            return null;
        }
    }
}