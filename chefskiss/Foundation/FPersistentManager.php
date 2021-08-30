<?php


class FPersistentManager
{

    public static function insert($object){
        $EClass = get_class($object);
        $FClass = str_replace('E', 'F', $EClass);
        $FClass::insert($object);
    }

    public static function load($field, $val,$Fclass) {
        $ris = null;
        $ris = $Fclass::loadByField($field,$val);
        return $ris;
    }

    public static function update($field, $newvalue, $pk, $val,$Fclass){
        return $Fclass::update($field, $newvalue, $pk, $val);
    }

    public static function delete($field, $val, $Fclass){
        $Fclass::delete($field, $val);
    }

    public static function exist($field, $val, $Fclass){
        $ris = $Fclass::exist($field, $val);
        return $ris;
    }
}