<!DOCTYPE html>
<?php 
	include 'db.php';
?>	
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Import Excel File To MySql Database Using php">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="css/bootstrap-custom.css">
	</head>
	<body>    

	<div id="wrap">
	<div class="container">
		<div class="row">
			<div class="span3 hidden-phone"></div>
			<div class="span6" id="form-login">
				<form class="form-horizontal well" action="import.php" method="post" name="upload_excel" enctype="multipart/form-data">
					<fieldset>
						<legend>Добавьте Excel файл</legend>
						<div class="control-group">
								<input type="file" name="file" id="file" class="input-large">
                                <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Загрузить</button>

						</div>
					</fieldset>
				</form>
			</div>
			<div class="span3 hidden-phone"></div>
		</div>
		

		<table class="table table-bordered">
			<thead>
				  	<tr>

				 		
				 
				  	</tr>	
				  </thead>
			<?php
				$SQLSELECT = "SELECT * FROM subject ";
				$result_set =  mysqli_query($conn, $SQLSELECT);
				while($row = mysqli_fetch_array($result_set))
				{
				?>
			
					<tr>
						<td><?php echo $row['SUBJ_ID']; ?></td>
						<td><?php echo $row['SUBJ_CODE']; ?></td>
						<td><?php echo $row['SUBJ_DESCRIPTION']; ?></td>
						<td><?php echo $row['UNIT']; ?></td>
						<td><?php echo $row['SEMESTER']; ?></td>
					</tr>
				<?php
				}
			?>
		</table>
	</div>

	</div>

	</body>
</html>