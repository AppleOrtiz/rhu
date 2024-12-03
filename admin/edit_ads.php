<?php
include ('dashboard.php');
require_once 'conn.php';


$id = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript">
     function preventBack(){window.history.forward()};
     setTimeout("preventBack()",0);
     window.onunload=function(){null;}
    </script>
	<meta charset="UTF-8">
	<title>RURAL HEALTH UNIT</title>
	<link rel="stylesheet" href="css/styles.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
	<link rel = "shortcut icon" href = "../images/logo.png" />
	<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
	<link rel = "stylesheet" type = "text/css" href = "css/jquery.dataTables.css" />
	<link rel="stylesheet" href="css/stylee.css">
	<link rel="stylesheet" href="css/dashboard.css" />
</head>
<body>
<main class="mt-2 pt-3"> 
<div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4><i class="bi bi-pencil-square"></i> Edit Administrator</h4>
          </div>
        </div>
</div>
<div class = "panel-body">
				
				<form id = "form_admin" method = "POST" enctype = "multi-part/form-data" >
					<div class = "panel panel-default" style = "width:60%; margin:auto;">
					<div class = "panel-heading">
					</div>
					<div class = "panel-body">
			<table>
	  <div class = "panel-heading">
			
		
			</div>
			<div class="container text-center">
  					<div class="row align-items-start">
    					<div class="col">
						<div class = "form-group">
								<label for = "username">Username: </label>
								<input class = "form-control" name = "username" type = "text" required = "required">
							</div>

							<div class = "form-group">	
								<label for = "password">Password: </label>
								<input class = "form-control" name = "password" maxlength = "12" type = "text" required = "required">
							</div>
						</div>
							<div class = "form-group">
								<label for = "email">Email: </label>
								<input class = "form-control" type = "text" name = "email">
							</div>
							
						</div>
						</div>
							<input type="hidden" name="id" value="<?php echo $id; ?>"> 
							<div class = "btn-field">
							<button  class = "btn btn-primary" name = "edit_ad" ><span class = "glyphicon glyphicon-edit"></span> UPDATE </button>
						</div>
					</div>
					<?php require 'edit_ad.php' ?>
				</form>
			</div>	
    </div>

    
</div>
</main>
</body>
</html>