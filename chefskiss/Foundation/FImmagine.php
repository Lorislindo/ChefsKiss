<?php

class FImmagine extends Fdb{
    private static $table = 'immagine';

    private static $class = 'FImmagine';

    private static $values = '(:nome, :dimensione, :tipo, :immagine, :id_ricetta, :id_post)';

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
     * @param EImmagine $immagine
     */
    public static function bind($stmt, EImmagine $immagine){
        $stmt->bindValue(':nome', $immagine->getNome(), PDO::PARAM_STR);
        $stmt->bindValue(':dimensione', $immagine->getDimensione(), PDO::PARAM_STR);
        $stmt->bindValue(':tipo', $immagine->getTipo(), PDO::PARAM_STR);
        $stmt->bindValue(':immagine', $immagine->getImmagine(), PDO::PARAM_LOB);
        $stmt->bindValue(':id_ricetta', $immagine->getId_ricetta(), PDO::PARAM_INT);
        $stmt->bindValue(':id_post', $immagine->getId_post(), PDO::PARAM_INT);
    }

    public static function insert($object){
        $db = parent::getInstance();
        $id = $db->insertDb(self::$class, $object);
        $object->setId($id);
    }

    public static function loadByField($field, $val){
        $immagine = null;
        $db = parent::getInstance();
        $result = $db->loadDb(static::getClass(), $field, $val);
        $rows_number = $db->getRowNum(static::getClass(), $field, $val);
        if(($result != null) && ($rows_number == 1)) {
            $immagine = new EImmagine($result['nome'], $result['dimensione'], $result['tipo'], $result['immagine'], $result['id_ricetta'], $result['id_post']);
            $immagine->setId($result['id']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $immagine = array();
                for($i = 0; $i < count($result); $i++){
                    $immagine[] = new EImmagine($result['nome'], $result['dimensione'], $result['tipo'], $result['immagine'], $result['id_ricetta'], $result['id_post']);
                    $immagine[$i]->setId($result[$i]['id']);
                }
            }
        }
        return $immagine;
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
}

?>