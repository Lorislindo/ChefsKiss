<?php 

class FPost extends Fdb{

    private static $table = 'post';

    private static $class = 'FPost';

    private static $values = '(:domanda, :autore, :categoria, :data)';
    
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
     * @param EPost $post
     */
    public static function bind($stmt, EPost $post){
        //$stmt->bindValue(':id', $post->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':domanda', $post->getDomanda(), PDO::PARAM_INT);
        $stmt->bindValue(':autore', $post->getAutore(), PDO::PARAM_INT);
        $stmt->bindValue(':categoria', $post->getCategoria(), PDO::PARAM_STR);
        $stmt->bindValue(':data', $post->getData_pubb(), PDO::PARAM_STR);
    }

    public static function insert($object){
        $db = parent::getInstance();
        $id = $db->insertDb(self::$class, $object);
        $object->setId($id);
    }

    public static function loadByField($field, $val){
        $post = null;
        $db = parent::getInstance();
        $result = $db->loadDb(static::getClass(), $field, $val);
        $rows_number = $db->getRowNum(static::getClass(), $field, $val);
        if(($result != null) && ($rows_number == 1)) {
            $post = new EPost($result['domanda'], $result['autore'], $result['categoria'], $result['data']);
            $post->setId($result['id']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $post = array();
                for($i = 0; $i < count($result); $i++){
                    $post[] = new EPost($result[$i]['domanda'], $result[$i]['autore'], $result[$i]['categoria'], $result[$i]['data']);
                    $post[$i]->setId($result[$i]['id']);
                }
            }
        }
        return $post;
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

    public function filterByCategorie(String $categoria){
        $db = parent::getInstance();
        $result = $db->searchDB(self::class, array('categoria', '=', $categoria));
        return $result;
    }

}

?>