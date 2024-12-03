<?php
include('dashboard.php');
require_once 'conn.php';

// Retrieve the fac_id from the URL parameter
$fac_id = $_GET['fac_id'];

// If the form is submitted, process the update
if (isset($_POST['edit_admin'])) {
    // Sanitize and collect form data
    $username = $_POST['username'];
    $middlename = $_POST['middlename'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $fac_id = $_POST['fac_id'];

    // Update the facilitator information in the database
    $query = "UPDATE facilitator_tbl SET 
              username = ?, middlename = ?, password = ?, firstname = ?, lastname = ?, email = ? 
              WHERE fac_id = ?";

    if ($stmt = $conn->prepare($query)) {
        // Bind parameters and execute
        $stmt->bind_param("ssssssi", $username, $middlename, $password, $firstname, $lastname, $email, $fac_id);
        if ($stmt->execute()) {
            echo "Information updated successfully!";
        } else {
            echo "Error updating information.";
        }
    }
}
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
    <link rel="stylesheet" href="css/styles.css" />
	<link rel="stylesheet" href="css/modals.css" />
    <link rel="stylesheet" href="css/dashboard.css" />
</head>
<body>
<main class="mt-2 pt-3">
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <span><i class="bi bi-pencil-square"></i> Edit Facilitator Information</span>
                </div>
                <div class="card-body">
                    <form id="form_admin" method="POST" enctype="multipart/form-data">
                        <div class="container ">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="username">Username: </label>
                                        <input class="form-control" name="username" type="text" required="required">
                                    </div>

                                    <div class="form-group">
                                        <label for="middlename">Middlename: </label>
                                        <input class="form-control" type="text" name="middlename">
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password: </label>
                                        <input class="form-control" name="password" maxlength="12" type="text" required="required">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="firstname">Firstname: </label>
                                        <input class="form-control" type="text" name="firstname" required="required">
                                    </div>

                                    <div class="form-group">
                                        <label for="lastname">Lastname: </label>
                                        <input class="form-control" type="text" name="lastname">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email: </label>
                                        <input class="form-control" type="text" name="email">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="fac_id" value="<?php echo $fac_id; ?>">
                            
                            <!-- Trigger Modal -->
                            <a href="create-ad.php" type="button" name="cancel" class=" btn btn-secondary">Cancel</a>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Update
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Updating Facilitator Information</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Click "Update" if you want to update the facilitator information.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <!-- Submit Button that triggers the form submission -->
                                            <button type="submit" name="edit_admin" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
