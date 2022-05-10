<?php
require 'vendor/autoload.php';

use \PhpOffice\PhpSpreadsheet\IOFactory;

class ImportXLSX
{
    public $filename;
    public $structure;
    public $result; //колличество вложений структуры
    public $idColumnConsultant; //номер колонки консультанта


    public function __construct()
    {
        $this->filename = $_FILES["file"]["tmp_name"];
        $this->structure = 4;
        $this->result = [];
        $this->idColumnConsultant = 4;

    }
    public function init(){
        $this->result = $this->spreadsheetToArray();

        for($item = 0; $item < $this->structure; $item++){
            $this->structureData($this->result,$item);
        }
        $this->getConsultant();
//        echo '<pre>';
//        print_r($this->result);
//        echo '</pre>';


        return $this->result;
    }

    public function spreadsheetToArray($nullValue = null, $calculateFormulas = true, $formatData = false)
    {
        $results = [];
        $spreadsheet = IOFactory::load($this->filename);
        foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
            $last_row=$worksheet->getHighestRow();
            $results = $worksheet->rangeToArray('A3:F'.$last_row, NULL, True, True);
        }
        $spreadsheet->__destruct();
        $spreadsheet = NULL;
        unset($spreadsheet);




        return $results;
    }
    public function structureData ($results,$item){
        $columnData = null;
        $i = 0;
        foreach($results as $res){
            if (isset($res[$item])){
                $columnData = $res[$item];
            }else{
                $this->result[$i][$item] = $columnData;
            }
            $i++;
        }
    }
    public function getConsultant (){
        $results = array();
        foreach ($this->result as $consultant){
            if(isset($consultant[$this->idColumnConsultant])){
                array_push($results, $consultant);
            }
        }
        $this->result = $results;
        return $results;

    }
}