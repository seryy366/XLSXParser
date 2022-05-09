<?php
include 'db.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\IOFactory;


if(isset($_POST["Import"])){
		

		echo $filename=$_FILES["file"]["tmp_name"];

		 if($_FILES["file"]["size"] > 0)
		 {

		  	 $file = fopen($filename, "r");

			 $spreadsheet = new Spreadsheet();
			 $results = [];
			 $spreadsheet = IOFactory::load($filename);
			 foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
				 $results[$worksheet->getTitle()] = $worksheet->toArray($nullValue = null, $calculateFormulas = true, $formatData = false);
			 }
			 $row1 = [];

			 $row = -1;
			 $one = [];
			 $too = [];
			 $fo = [];

			 foreach($results["Лист1"] as $res){
				 if(isset($res[0])AND !isset($res[1]) AND !isset($res[4])){
					 $row ++;
					 echo '<pre>';
					 print_r($res);
					 echo '</pre>';
					 $one = $res[0];
//					  array_push($row1[$row],$res[0]);
				 }
				 if(isset($res[1])){
					 $too = $res[1];
//					 array_push($row1[$row],$res[1]);
				 }
				 if(isset($res[2]) AND !isset($res[3])){
					 $tr = [];
					 array_push($tr,$one,$too, $res[2]);
					 array_push($row1,$tr);
				 }
				 if(isset($res[3]) AND !isset($res[1])){
					 $fo = [];
					 array_push($fo,$one,$too, $res[2]);
					 array_push($row1,$fo);
				 }

			 }
			 echo '<pre>';
			 print_r($row1);
			 echo '</pre>';
			 // save memory
			 $spreadsheet->__destruct();
			 $spreadsheet = NULL;
			 unset($spreadsheet);


			 $row = 1;
//	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
//	         {
//				 $num = count($emapData);
//				 echo "<p> $num полей в строке $row: <br /></p>\n";
//				 $row++;
//	          //It wiil insert a row to our subject table from our csv file`
//	           $sql = "INSERT into subject (`SUBJ_CODE`, `SUBJ_DESCRIPTION`, `UNIT`, `PRE_REQUISITE`,COURSE_ID, `AY`, `SEMESTER`)
//	            	values('$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]','$emapData[6]','$emapData[7]')";
//	         //we are using mysql_query function. it returns a resource on true else False on error
//	          $result = mysqli_query( $conn, $sql);
//				if(! $result )
//				{
//					echo "<script type=\"text/javascript\">
//							alert(\"Не подходящий формат файла.\");
//							window.location = \"index.php\"
//						</script>";
//
//				}
//
//	         }
//	         fclose($file);
//	         echo "<script type=\"text/javascript\">
//						alert(\"Файл был успешно импортирован в БД.\");
//						window.location = \"index.php\"
//					</script>";



			 //close of connection
			mysqli_close($conn);



		 }
	}	 
?>		 