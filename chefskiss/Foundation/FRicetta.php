<?php

class FRicetta extends Fdb {

    private static $table = 'ricetta';

    private static $class = 'FRicetta';

    private static $values = '(:ingredienti, :procedimento, :categoria, :data_pubblicazione, :autore, :foto)';

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



    /**
     * @param PDOStatement $stmt
     * @param ERicetta $ricetta
     */
    public static function bind($stmt, ERicetta $ricetta){
        $stmt->bindValue(':ingredienti', $ricetta->getIngredienti(),PDO::PARAM_STR);
        $stmt->bindValue(':procedimento', $ricetta->getProcedimento(), PDO::PARAM_STR);
        $stmt->bindValue(':categoria', $ricetta->getCategoria(), PDO::PARAM_STR);
        $stmt->bindValue(':data_pubblicazione', $ricetta->getData_pubblicazione(), PDO::PARAM_STR);
        $stmt->bindValue(':autore', $ricetta->getAutore(), PDO::PARAM_INT);
    }

    public static function insert($object){
        $db = parent::getInstance();
        $id = $db->insertDb(self::$class, $object);
        $object->setId($id);
        return $id;
    }

    public static function loadByField($field, $val){
        $ricetta = null;
        $db = parent::getInstance();
        $result = $db->loadDb(static::getClass(), $field, $val);
        $rows_number = $db->getRowNum(static::getClass(), $field, $val);
        if(($result != null) && ($rows_number == 1)) {
            $ricetta = new ERicetta($result['ingredienti'], $result['procedimento'], $result['categoria'], $result['data_pubblicazione'], $result['autore']);
            $ricetta->setId($result['id']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $ricetta = array();
                for($i = 0; $i < count($result); $i++){
                    $ricetta[] = new ERicetta($result[$i]['ingredienti'], $result[$i]['procedimento'], $result[$i]['categoria'], $result[$i]['data_pubblicazione'], $result[$i]['autore']);
                    $ricetta[$i]->setId($result[$i]['id']);
                }
            }
        }
        return $ricetta;
    }

    public static function update($field, $newvalue, $primkey, $val){
        $db = parent::getInstance();
        $result = $db->updateDB(self::getClass(), $field, $newvalue, $primkey, $val);
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

    public static function filterByCategoria($categoria){
        $db = parent::getInstance();
        $ricetteFiltrate = $db->searchDb(self::$class, array('categoria', '=', $categoria));
        return $ricetteFiltrate;

    }

}