<?php
ob_start();

require('dashboard.php');
include('conn.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $announcementId = $_GET['edit'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM announcements WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $announcementId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $announcement = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if (!$announcement) {
        header("Location: announcement.php");
        exit();
    }
} else {
    header("Location: announcement.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $imagePath = $announcement['image'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($_FILES['image']['tmp_name']);
        
        if (in_array($fileType, $allowedTypes)) {
            $imageName = uniqid('announcement_') . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $imagePath = $uploadDir . $imageName;

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                $imagePath = $announcement['image'];
            }
        } else {
            $imagePath = $announcement['image'];
        }
    }

    $stmt = mysqli_prepare($conn, "UPDATE announcements SET title = ?, content = ?, image = ?, updated_at = NOW() WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "sssi", $title, $content, $imagePath, $announcementId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: announcement.php");
    exit();
}

ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript">
     function preventBack(){window.history.forward()};
     setTimeout("preventBack()",0);
     window.onunload=function(){null;}
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Announcement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/announcements.css">
    <link rel="stylesheet" href="css/modals.css">
</head>
<body>
<main class="mt-2 pt-3"> 

<div class="row">
    <div class="col-md-15 mb-3 ms-3">
        <div class="card">
            <div class="card-header">
                <span><i class="bi bi-sticky-fill"></i> EDIT ANNOUNCEMENT</div>
            <div class="card-body">
            <form method="POST" action="edit_ann.php?edit=<?php echo $announcement['id']; ?>" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Announcement Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($announcement['title']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Announcement Content</label>
                    <textarea class="form-control" id="content" name="content" rows="4" required><?php echo htmlspecialchars($announcement['content']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Upload New Image (Optional)</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    <br>
                    <?php if ($announcement['image']): ?>
                        <img src="<?php echo htmlspecialchars($announcement['image']); ?>" class="img-thumbnail" alt="Current Image" style="max-width: 150px;">
                    <?php else: ?>
                        <p>No current image.</p>
                    <?php endif; ?>
                </div>
                <a href="announcement.php" type="button" name="cancel" class="btn btn-secondary">Cancel</a>
               
                <!-- Trigger Modal -->
                <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#saveModal">Update</a>

                <!-- Modal -->
                <div class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="saveModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="saveModalLabel">Are you sure to update this?</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Clicking "Yes" if you want to update the announcement.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
    </div>
</div>

        
</main>
</body>
</html>