<?php

require 'Fdb.php';
require 'Utility/USingleton.php';

class FUtente extends Fdb{

    private static $table = 'utente';

    private static $class = 'FUtente';

    private static $values = '(:nome, :cognome, :email, :id, :password, :nickname, :data_iscrizione, :ban, :privilegi)';

    public function __construct(){
    }

    /**
    * @return string
    */
    public static function getTable(): string
    {
        return self::$table;
    }

    /**
     * @return string
     */
    public static function getClass(): string
    {
        return self::$class;
    }

    /**
     * @return string
     */
    public static function getValues(): string
    {
        return self::$values;
    }

    public static function insert($object){
        $db = parent::getInstance();
        $id = $db->insertDb(self::$class, $object);
        $object->setId($id);
    }

    /**
     * @param PDOStatement $stmt
     * @param EUtente $user
     */
    public static function bind($stmt, EUtente $user){
        $stmt->bindValue(':nome', $user->getNome(), PDO::PARAM_STR);
        $stmt->bindValue(':cognome', $user->getCognome(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(':nickname', $user->getNickname(), PDO::PARAM_STR);
        $stmt->bindValue(':data_iscrizione', $user->getDataIscrizione(), PDO::PARAM_STR);
        $stmt->bindValue(':ban', $user->getBan(), PDO::PARAM_BOOL);
        $stmt->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':privilegi', $user->getPrivilegi(), PDO::PARAM_INT);

    }

    public static function loadByField($field, $val){
        $utente = null;
        $db = parent::getInstance();
        $result = $db->loadDb(static::getClass(), $field, $val);
        $rows_number = $db->getRowNum(static::getClass(), $field, $val);
        if(($result != null) && ($rows_number == 1)) {
            $utente = new EUtente($result['nome'], $result['cognome'], $result['email'], $result['password'],
                                    $result['nickname'], $result['data_iscrizione'], $result['data_fine_ban'], $result['ban'], $result['id'], $result['privilegi']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $utente = array();
                for($i = 0; $i < count($result); $i++){
                    $utente = new EUtente($result[$i]['nome'], $result[$i]['cognome'], $result[$i]['email'], $result[$i]['password'],
                                    $result[$i]['nickname'], $result[$i]['data_iscrizione'], $result[$i]['data_fine_ban'], $result[$i]['ban'], $result[$i]['id'], $result[$i]['privilegi']);
                }
            }
        }
        return $utente;
    }

    public static function update($field, $newvalue, $pk, $val){
        $db = parent::getInstance();
        $result = $db->updateDB(self::getClass(), $field, $newvalue, $pk, $val);
        if ($result) return true;
        else return false;
    }

    public static function delete($field, $id){
        $db = parent::getInstance();
        $result = $db->deleteDB(self::getClass(), $field, $id);
        if ($result) return true;
        else return false;
    }

    public static function exist($field, $id){
        $db = parent::getInstance();
        $result = $db->existDB(self::getClass(), $field, $id);
        if ($result != null) return true;
        else return false;
    }

    public static function search($parametri=array(), $ordinamento='', $limite=''){
        $db = parent::getInstance();
        $result = $db->searchDb(self::$class, $parametri, $ordinamento, $limite);
        return $result;
    }

    public static function loadLogin($user, $pass){
        $utente = null;
        $db = Fdb::getInstance();
        $result = $db->checkIfLogged($user, $pass);
        if (isset($result)){
            $utente = self::loadByField('email', $result['email']);
        }
        return $utente;
    }
}
?>