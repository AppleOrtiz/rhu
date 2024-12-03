<?php
include 'dashboard.php';
?>
<!doctype html>
<html lang="en">
<head>
<script type="text/javascript">
     function preventBack(){window.history.forward()};
     setTimeout("preventBack()",0);
     window.onunload=function(){null;}
    </script>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/patients.css" />
    <link rel="stylesheet" href="css/modals.css" />
    <link rel="stylesheet" href="css/dashboard.css" />
</head>
<body>
<main class="mt-2 pt-3">

<div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-archive"></i> ARCHIVE DATA</span>
              </div>
              <div class="card-body">
              <div class="table-responsive">
                        <table id="example" class="table table-bordered table-striped data-table table-hover" style="width: 100%">
                            <thead class="table-light">  
                                <tr>
                                    <th>LAST NAME</th>
                                    <th>FIRST NAME</th>
                                    <th>MIDDLE NAME</th>
                                    <th>DAY OF REGISTRATION</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $conn = new mysqli("localhost", "root", "", "isrhh") or die(mysqli_error());
                                $query = $conn->query("SELECT * FROM `patient_archive` ORDER BY `pa_id` DESC") or die(mysqli_error());
                                while($fetch = $query->fetch_array()){
                                ?>
                                <tr>
                                    <td><?php echo $fetch['lastname']?></td>
                                    <td><?php echo $fetch['firstname']?></td>
                                    <td><?php echo $fetch['middlename']?></td>
                                    <td><?php echo $fetch['time']?></td>
                                    <td>
                                       
                                            <a href="archive_view.php?pa_id=<?php echo $fetch['pa_id']?>&lastname=<?php echo $fetch['lastname']?>" class="btn btn-sm btn-primary hover-button"><i class="bi bi-three-dots"></i></a> 
                                            <a href="restore_patient.php?pa_id=<?php echo $fetch['pa_id']?>&lastname=<?php echo $fetch['lastname']?>" class="btn btn-sm btn-secondary Hover-button" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-arrow-counterclockwise"></i></a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure to Restore it?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Click "Restore" if you want to restore the Patient?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <a  href="restore_patient.php?pa_id=<?php echo $fetch['pa_id']?>&lastname=<?php echo $fetch['lastname']?>"  class="btn btn-primary">Restore</a>
                                                </div>
                                                </div>
                                            </div>
                                            </div>

                                            <a href="#" class="btn btn-sm btn-danger hovers-buttons" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $fetch['pa_id']?>"><i class="bi bi-trash"></i></a> 
                                        
                                    </td>
                                </tr>

                                <!-- Delete Confirmation Modal (Dynamic ID) -->
                                <div class="modal fade" id="deleteModal<?php echo $fetch['pa_id']?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $fetch['pa_id']?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="deleteModalLabel<?php echo $fetch['pa_id']?>">Sure you want to delete permanently?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Click "Delete" if you want to delete this patient record permanently.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <!-- Delete action button, passes patient ID to delete -->
                                                <a href="delete_patient.php?pa_id=<?php echo $fetch['pa_id']?>" class="btn btn-primary">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                }
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
</div>


                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
<script>
    $(document).ready(function () {
        $('#example').dataTable();
    });
</script>
</body>
</html>