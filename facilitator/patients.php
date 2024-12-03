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
          <span><i class="bi bi-person-lines-fill"></i> PATIENT'S LIST</span> 
          
        </div>
        <div class="card-body">
        <div class="table-responsive">
                    <table id="example" class="table table-bordered table-striped data-table table-hover" style="width: 100%" <center>
                    <thead>  
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <a  href="export.php" class="btn btn-secondary me-md-2" type="button"><i class="bi bi-file-earmark-spreadsheet"></i> Save all</a> 
                    </div>
                        <tr>
                          <th>LAST NAME</th>
                          <th>FIRST NAME</th>
                          <th>MIDDLE NAME</th>
                          <th>REGISTRATION DATE</th>
                          <th>ACTION</th>
                        </tr>
                    </thead>
                    </div>
        </div>
      </div>
    </div>
</div>


</main>
      
      <tbody>
      <?php
          $conn = new mysqli("localhost", "root", "", "isrhh") or die(mysqli_error());
          $query = $conn->query("SELECT * FROM `patient_tbl` ORDER BY `pa_id` DESC") or die(mysqli_error());
          while($fetch = $query->fetch_array()){
      ?>
        <tr>
          <center>
          <td><?php echo $fetch['lastname']?></td>
          <td><?php echo $fetch['firstname']?></td>
          <td><?php echo $fetch['middlename']?></td>
          <td><?php echo $fetch['time']?></td>
          <td>
            <center>
          <a href = "view.php?pa_id=<?php echo $fetch['pa_id']?>&lastname=<?php echo $fetch['lastname']?> "class="btn btn-sm btn-primary hover-button"><i class="bi bi-three-dots"></i></a> 
          <a href = "generate.php?pa_id=<?php echo $fetch['pa_id']?>&lastname=<?php echo $fetch['lastname']?>"target="_blank" class = "btn btn-sm btn-success hover-buttons"> <i class="bi bi-file-earmark-pdf"></i></a> 
          <a href = "update.php?pa_id=<?php echo $fetch['pa_id']?>&lastname=<?php echo $fetch['lastname']?>"class = "btn btn-sm btn-warning hovers-button"><i class="bi bi-pencil-square"></i></a> 
          <a href="archive_patient.php?pa_id=<?php echo $fetch['pa_id']?>&lastname=<?php echo $fetch['lastname']?>" class="btn btn-sm btn-danger hovers-buttons" data-bs-toggle="modal" data-bs-target="#archive<?php echo $fetch['pa_id']; ?>"><i class="bi bi-trash"></i></a>

        <!-- Modal -->
        <div class="modal fade" id="archive<?php echo $fetch['pa_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to archive?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    Click "Yes" if you want this record to be move to archive.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <a href="archive_patient.php?pa_id=<?php echo $fetch['pa_id']?>&lastname=<?php echo $fetch['lastname']?>" class="btn btn-primary">Yes</a>
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