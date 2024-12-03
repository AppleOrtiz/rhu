<?php
require('dashboard.php');
include('conn.php');  // Include the MySQLi connection file
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Start the session if it's not already started
}

// Handle form submission for adding/editing an announcement
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $index = isset($_POST['index']) ? $_POST['index'] : null;

    // Handle image upload
    $imagePath = null; // Default if no image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Validate file type (e.g., JPEG, PNG)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($_FILES['image']['tmp_name']);
        
        if (in_array($fileType, $allowedTypes)) {
            // Create a unique name for the image to avoid conflicts
            $imageName = uniqid('announcement_') . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $uploadDir = '../facilitator/uploads/'; // Directory to store uploaded images
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
            }
            
            $imagePath = $uploadDir . $imageName;
            
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                // Successfully uploaded the image
            } else {
                $imagePath = null; // If there's an error during upload
            }
        } else {
            // Invalid file type
            $imagePath = null;
        }
    }

    // Add or edit the announcement in the database
    if ($index !== null && isset($_POST['id'])) {
        // Edit existing announcement
        $announcementId = $_POST['id'];

        // Use a prepared statement for updating the announcement
        $stmt = mysqli_prepare($conn, "UPDATE announcements SET title = ?, content = ?, image = ?, updated_at = NOW() WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "sssi", $title, $content, $imagePath, $announcementId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);  // Close the statement
    } else {
        // Add new announcement to the database
        $stmt = mysqli_prepare($conn, "INSERT INTO announcements (title, content, image, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
        mysqli_stmt_bind_param($stmt, "sss", $title, $content, $imagePath);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);  // Close the statement
    }
}

// Fetch all announcements to display in the table
$query = "SELECT * FROM announcements ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
$announcements = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
        <title>Announcement Management</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="css/modals.css">
        <link rel="stylesheet" href="css/dashboard.css">
        <link rel="stylesheet" href="css/announcements.css">
        
    </head>
<body>

<main class="mt-2 pt-3"> 

    <div class="row">
        <div class="col-md-15 mb-3 ms-3">
            <div class="card">
                <div class="card-header">
                    <span><i class="bi bi-sticky-fill"></i> CREATE/EDIT ANNOUNCEMENT</div>
                <div class="card-body">
                
                <form method="POST" action="announcement.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Announcement Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-2">
                        <label for="content" class="form-label">Announcement Content</label>
                        <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>
                   
                    <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#saveModal">Submit Announcement</a>

                    <!-- Modal -->
                    <div class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="saveModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="saveModalLabel">Do you want to save this announcement?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Clicking "Yes" if you want to save this announcement. Click "No" if you want to cancel.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                    <!-- Button triggers form submission -->
                                    <button type="submit" name="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Announcements Table -->
    <div class="row">
        <div class="col-md-15 mb-3 ms-3">
            <div class="card">
                <div class="card-body">
                <h3>All Announcements</h3>
            <table class="table table-bordered table-striped  table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Title</th>
                        <th>Posted On</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($announcements)): ?>
                        <tr>
                            <td colspan="5" class="text-center">No announcements available.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($announcements as $announcement): ?>
                            <tr>
                               
                                <td><?php echo htmlspecialchars($announcement['title']); ?></td>
                                <td><?php echo date("F j, Y", strtotime($announcement['created_at'])); ?></td>
                                <td>
                                    <?php if ($announcement['image']): ?>
                                        <img src="<?php echo htmlspecialchars($announcement['image']); ?>" class="announcement-image" alt="Image">
                                    <?php else: ?>
                                        <span>No Image</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="edit_ann.php?edit=<?php echo $announcement['id']; ?>" class="btn btn-sm btn-warning hovers-button"><i class="bi bi-pencil-square"></i></a>
                                    
                                    
                                    <!-- Corrected Delete Button with Modal Trigger -->
                                    <a href="#" class="btn btn-sm btn-danger hovers-buttons" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $announcement['id']; ?>"><i class="bi bi-trash"></i></a>

                                    <!-- Delete Confirmation Modal (Dynamic ID) -->
                                    <div class="modal fade" id="deleteModal<?php echo $announcement['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $announcement['id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="deleteModalLabel<?php echo $announcement['id']; ?>">Are you sure to delete this permanently?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Click "Delete" if you want to permanently delete this announcement.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <!-- Correct Delete Link -->
                                                    <a href="delete_ann.php?id=<?php echo $announcement['id']; ?>" class="btn btn-primary">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
