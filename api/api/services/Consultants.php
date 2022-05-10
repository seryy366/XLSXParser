<?php


class Consultants
{
    static public function get()
    {
        $response = Db::query("SELECT * FROM `consultant`");

        if ($response) {
            return $response;
        } else {
//            return [
//                'message' => 'Данные не найдены'
//            ];
        }
    }
    static public function getConsultantInJson()
    {
        $consultants = Db::query("SELECT * FROM `consultant` GROUP BY `consultant`");
        if ($consultants) {
            $arConsultants = array();
            foreach ($consultants as $item) {
                $consultantsss = Db::query("SELECT numberOfTasks, division,direction, service, subdivision FROM `consultant` WHERE consultant = '" .$item["consultant"]. "'");
                array_push($arConsultants, array($item["consultant"]=> $consultantsss));

            }
            $response = json_encode($arConsultants, JSON_UNESCAPED_UNICODE);
            return $response;
        }else {
            return [
                'message' => 'Данные не найдены'
            ];
        }
    }

    static public function add($array)
    {
        if ($array) {

            foreach ($array as $item) {
                $consultant = $item[4];
                $numberOfTasks = $item[5];
                $division = $item[0];
                $direction = $item[1];
                $service = $item[2];
                $subdivision = $item[3];

                $res = Db::query("
                INSERT INTO `consultant` (consultant, numberOfTasks, division,direction, service, subdivision)
                values ('$consultant','$numberOfTasks','$division','$direction','$service', '$subdivision')
                ");
            }
            return [$res];
        } else {
            return [
                'message' => 'При добавлении консультантов произошла ошибка.'
            ];
        }
    }

}