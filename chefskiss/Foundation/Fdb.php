<?php


class Fdb
{
    /**
     * @var $_connection Variabile che stabililsce la connessione col database
     */
    private  $_connection;

    /**
     * @var $_query Variabile che memorizza la query corrente
     */
    private $_query;

    /**
     * @var $_stmt Variabile che memorizza l'istanza dello statement della connessione del database
     */
    private $_stmt;

    /**
     * @var $_result Variabile che memorizza il risultato dell'esecuzione di uno statement
     */
    private $_result;

    protected $_key;

    /**
     * @var $_return_class Variabile contenente il tipo di classe da restituire
     */
    protected $_return_class;

    /**
     * @var $_table Variabile contenente il nome della tabella
     */
    protected $_table;

    /**
     * @var bool $_auto_increment Variabile che definisce l'esistenza o meno di una chiave automatica nella tabella corrente
     */
    protected $_auto_increment = false;

    public function __construct()
    {
        if (!$this->existConn()){
            $this->connect();
        }
    }

    /**
     * Funzione che permette la connessione al server del database
     */
    public function connect(){
        try{
            $this->_connection = new PDO("mysql:host=127.0.0.1;dbname=chefskiss", 'root', 'pippo');
        } catch (PDOException $e){
            print $e->getMessage();
        }
    }

    /**
     * Verifica l'esistenza della connessione con il database
     * @return bool
     */
    public function existConn(): bool {
        if($this->_connection != null){
            return true;
        }
        return false;
    }

    /**
     * Questa funzione inizializza una query pronta per essere eseguita
     * @param string $query
     * @return bool
     */
    public function createStatement(string $query)
    {
        $this->_query = $query;
        if (!$this->_query)
            return false;
        else
            $this->_stmt = $this->_connection->preapare($this->_query);
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
        $result = $this->_connection->query($query)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Questa funzione serve ad inserire i dati di una nuova istanza di un oggetto all'interno del database
     * @param $object
     * @return bool|mixed
     */
    public function insert($object){

        $i = 0;
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
        $this->createStatement($query);
        $return = $this->execStatement();
        if ($this->_auto_increment) {
            $query='SELECT LAST_INSERT_ID() AS `id`';
            $this->createStatement($query);
            $this->execStatement();
            $result=$this->getResult();
            return $result['id'];
        } else {
            return $return;
        }

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
        }
        if ($this->_result == null)
            return false;
        else
            return true;
    }

    /**
     * Chiude la connessione con il database
     */
    public function close(){
        $this->_connection = null;
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