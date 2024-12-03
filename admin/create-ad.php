	<?php

	include ('dashboard.php');
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
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/modals.css">
		<link rel="stylesheet" href="css/dashboard.css" />
		<style>
			table {
				margin-top: 20px; /* adjust the value as needed */
			}
		</style>
	</head>
	<body>
	<main class="mt-2 pt-3"> 

	<div class="row">
          <div class="col-md-14 mb-3 ms-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-person-plus-fill"></i> CREATING NEW FACILITATOR</span>
              </div>
              <div class="card-body">
			  <form id = "form_admin" method = "POST" enctype = "multi-part/form-data" >
						
					
						<div class="row">
							<div class="col">
							<div class = "form-group">
									<label for = "username">Username: </label>
									<input class = "form-control" name = "username" type = "text" required = "required">
								</div>
								
								<div class = "form-group">
									<label for = "middlename">Middlename: </label>
									<input class = "form-control" type = "text" name = "middlename">
								</div>
							</div>

								<div class="col">
								<div class = "form-group">
									<label for = "firstname">Firstname: </label>
									<input class = "form-control" type = "text" name = "firstname" required = "required">
								</div>
								<div class = "form-group">	
									<label for = "password">Password: </label>
									<input class = "form-control" name = "password" maxlength = "12" type = "text" required = "required">
								</div>
								</div>

								<div class="col">
								<div class = "form-group">
									<label for = "lastname">Lastname: </label>
									<input class = "form-control" type = "text" name = "lastname">
								</div>

								<div class = "form-group">
									<label for = "email">Email: </label>
									<input class = "form-control" type = "text" name = "email">
								</div>
								</div>
								
							
								<div class = "btn-field">
									

									<a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#saveModal">Save</a>

									<!-- Modal -->
									<div class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="saveModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h1 class="modal-title fs-5" id="saveModalLabel">Are you sure you want to save?</h1>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													Clicking "Yes" if you want to save new facilitator.
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
													<!-- Button triggers form submission -->
													<button type="submit" name ="save_user" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
												</div>
											</div>
										</div>
									</div>
								
								</div>
							</div>
				
							<?php require 'add_admin.php' ?>					
						</div>
					</form>
				</div>
			</div>
		</div>
		</div>

				
		<div class="row">
        <div class="col-md-14 mb-3 ms-3">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example" class="table table-bordered table-striped data-table table-hover" style="width: 100%" center >
                    	<thead>  
							<tr>
								<th>USER NAME</th>
								<th>NAME</th>
								<th>PASSWORD</th>
								<th>EMAIL</th>
								<th>ACTION</th>
							</tr>
						</thead>
                    </div>
                  </div>
                </div>
           
						<tbody>
		
						<?php
							$conn = new mysqli("localhost", "root", "", "isrhh") or die(mysqli_error());
							$query = $conn->query("SELECT * FROM `facilitator_tbl` ORDER BY `fac_id` DESC") or die(mysqli_error());
							while($fetch = $query->fetch_array()){
						?>
							<tr>
								<td><?php echo $fetch['username']?></td>
								<td><?php echo $fetch['firstname']." ".$fetch['lastname']?></td>
								<td><?php echo ($fetch['password'])?></td>
								<td><?php echo ($fetch['email'])?></td>
								
								<td>	
									<center>
									<a href = "edit_admin.php?fac_id=<?php echo $fetch['fac_id']?>&lastname=<?php echo $fetch['lastname']?>"class = "btn btn-sm btn-warning hovers-button "><i class="bi bi-pencil-square"></i></a>
									<a href="#" class="btn btn-sm btn-danger hovers-buttons" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $fetch['fac_id']?>"><i class="bi bi-trash"></i></a> 

									<!-- Delete Confirmation Modal (Dynamic ID) -->
									<div class="modal fade" id="deleteModal<?php echo $fetch['fac_id']?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $fetch['fac_id']?>" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h1 class="modal-title fs-5" id="deleteModalLabel<?php echo $fetch['fac_id']?>">Sure you want to delete?</h1>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													Click "Delete" if you want to delete this Facilitator account.
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
													<!-- Delete action button, passes patient ID to delete -->
													<a href="delete_admin.php?fac_id=<?php echo $fetch['fac_id']?>" class="btn btn-primary">Delete</a>
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
						<?php
							}
							$conn->close();
						?>
						</tbody>
						</table>
				</div>
						</main>
			</div>

			<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

    <script>
      $(document).ready(function () {
        $('#example').dataTable();
      }
    );
    </script>
</body>
</html>