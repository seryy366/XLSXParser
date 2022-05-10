<?php
include 'ImportXLSX.php';
require 'vendor/autoload.php';
require 'api/config/db.php';


spl_autoload_register(function () {
	include 'api/api/classes/Db.php';
	include 'api/api/services/Consultants.php';
});
if(isset($_POST["Import"]))
{
	$xlsx = new ImportXLSX();
	$s = $xlsx->init();
	$res = Consultants::add($s);
	if(!$res)
	{
		echo "<script type=\"text/javascript\">
				alert(\"Не подходящий формат файла.\");
				window.location = \"index.php\"
			</script>";
	}
	echo "<script type=\"text/javascript\">
			alert(\"Файл был успешно импортирован в БД.\");
			window.location = \"index.php\"
		</script>";
}
