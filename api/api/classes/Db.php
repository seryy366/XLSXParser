<?php

class Db {
    static public function query($query)
    {
        $mysql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//        print_r($query);
        $arResult = [];
        $query = $mysql->query($query);

        if ($query) {
            if (is_object($query)) {
                while ($arItem = $query->fetch_assoc()) {
                    $arResult[] = $arItem;
                }
            } else {
                return $mysql->insert_id;
            }
        } else {
//            writeToLog(mysqli_error($mysql, "ERROR $query"));
        }

        return count($arResult) ? $arResult : null;
    }
}