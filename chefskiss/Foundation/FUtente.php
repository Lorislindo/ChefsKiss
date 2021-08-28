<?php

require 'Fdb.php';
require 'Utility/USingleton.php';

class FUtente extends Fdb{

    private static $table = 'utente';

    private static $class = 'FUtente';

    private static $values = '(:nome, :cognome, :email, :id, :password, :nickname, :data_iscrizione, :ban, :ricette, :privilegi)';

    public function __construct(){
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
        $stmt->bindValue(':ban', $user->getBan(), PDO::PARAM_INT);
        $stmt->bindValue(':ricette', $user->getRicette(), PDO::PARAM_STR);
        $stmt->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':privilegi', $user->getPrivilegi(), PDO::PARAM_INT);

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

    public function insert($object)
    {
        $db = parent::getInstance();
        $db->insertDb(self::$class, $object);
    }
}
?>