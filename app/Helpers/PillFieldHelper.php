<?php

namespace App\Helpers;

class PillFieldHelper {

  public static function toArray(string $inputs) {

     $inputs = json_decode($inputs);
     if(!$inputs) return [];

     $array = [];

     foreach ($inputs AS $input) {
         
         $array[] = $input->id;

     }

     return $array;

  }

  public static function dbRowsToJson(array $db_rows, string $key, string $value) {

    $array = [];

    foreach($db_rows AS $row) {

        $obj = new \stdClass();
        $obj->id = $row[$key];
        $obj->value = $row[$value];
        $array[] = $obj;
    }

    return json_encode($array);

  }


}