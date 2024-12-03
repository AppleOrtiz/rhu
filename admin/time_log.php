<?php
include 'dashboard.php';

$conn = new mysqli("localhost", "root", "", "isrhh");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Time Logs</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/patients.css" />
    <link rel="stylesheet" href="css/dashboard.css" />
    <link rel="stylesheet" href="css/modals.css" />
</head>
<body>
<main class="mt-2 pt-3">

<div class="row">
          <div class="col-md-13 mb-3 ">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-list-ul"></i> EMPLOYEE TIME LOGS </span>
              </div>
              <div class="card-body">
              <div class="table-responsive">
                        <table id="example" class="table table-bordered table-striped data-table table-hover" style="width: 100%">
                            <thead class="table-light">  
                                <tr>
                                    <th>EMPLOYEE NAME</th>
                                    <th>TIME IN</th>
                                    <th>TIME OUT</th>
                                    <th>DATE</th>
                                    <th>WORK HOURS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // SQL query to get time logs only for users that exist in facilitator_tbl
                                $query = $conn->query("SELECT 
                                    tl.*, 
                                    ft.username 
                                FROM 
                                    time_log AS tl 
                                JOIN 
                                    facilitator_tbl AS ft 
                                ON 
                                    tl.fac_id = ft.fac_id 
                                WHERE 
                                    ft.username IS NOT NULL 
                                ORDER BY 
                                    tl.id DESC");

                                if (!$query) {
                                    die("Query failed: " . $conn->error); // Show the SQL error
                                }

                                while ($fetch = $query->fetch_assoc()) {
                                    $In = new DateTime($fetch['In']);
                                    $Out = new DateTime($fetch['Out']);
                                    $work_hours = $In->diff($Out)->h + ($In->diff($Out)->i / 60);
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($fetch['username']); ?></td>
                                    <td><?php echo htmlspecialchars($fetch['In']); ?></td>
                                    <td><?php echo htmlspecialchars($fetch['Out']); ?></td>
                                    <td><?php echo htmlspecialchars($fetch['date']); ?></td>
                                    <td>
                                        <?php 
                                            // Assuming $work_hours is a decimal value representing hours
                                            $hours = floor($work_hours);
                                            $minutes = round(($work_hours - $hours) * 60);
                                            
                                            // Display the time in hours and minutes format
                                            echo $hours . ' hours ' . $minutes . ' minutes';
                                        ?>
                                    </td>
                                    <td class="text-center">
                                      <!-- Trigger button for the modal -->
                                    <a href="#" class="btn btn-sm btn-danger hovers-buttons" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteLink(<?php echo $fetch['id']; ?>)">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                    <!-- Modal for confirmation -->
                                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="deleteModalLabel">Confirm you want to delete?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Click "Delete" if you want to delete this permanently.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <a href="#" id="deleteLink" class="btn btn-primary">Delete</a>
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
            </div>
</div>
</main>
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
    <!-- JavaScript for dynamically setting the delete link -->
    <script>
        function setDeleteLink(itemId) {
            // Set the link to the delete page with the correct ID
            document.getElementById('deleteLink').href = "delete_time.php?id=" + itemId;
        }
    </script>
</body>
</html>