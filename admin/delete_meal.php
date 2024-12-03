<?php
include 'dashboard.php';

$categories = [
    'Grains', 'Dairies', 'Fruits', 'Eggs', 'Breakfast', 'Lunch', 'Dinner', 'Snacks',
];

if (isset($_POST['delete_food'])) {
    $food_id = $_POST['food_id'];

    $conn = new mysqli("localhost", "root", "", "isrhh");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $deleteQuery = "DELETE FROM `meal_tbl` WHERE `id` = '$food_id'";

    if ($conn->query($deleteQuery) === TRUE) {
        echo "<script>alert('Food item deleted successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $conn->close();
}

$conn = new mysqli("localhost", "root", "", "isrhh");
$foodItems = [];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

foreach ($categories as $category) {
    $query = $conn->query("SELECT * FROM `meal_tbl` WHERE `category` = '$category'") or die(mysqli_error($conn));
    $foodItems[$category] = [];
    
    while ($row = $query->fetch_assoc()) {
        $foodItems[$category][] = $row;
    }
}

$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
<script type="text/javascript">
     function preventBack(){window.history.forward()};
     setTimeout("preventBack()",0);
     window.onunload=function(){null;}
    </script>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Calorie Tracker</title>
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/trackSSS.css" />
    <link rel="stylesheet" href="css/modals.css" />
    <link rel="stylesheet" href="css/dashboard.css" />
</head>
<body>
<main class="mt-3 pt-3"> 
    <div class="row">   
        <div class="col-md-11 mb-3 ms-4">
            <div class="card">
                <div class="card-header">
                    <span><i class="bi bi-clipboard2-pulse"></i> DELETING A MEALS </span>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="row">
                            <?php foreach ($categories as $category): ?>
                                <div class="col-md-3">
                                    <label for="category" class="form-label"><?php echo $category; ?></label>
                                    <select id="category_<?php echo strtolower($category); ?>" class="form-control searchable-dropdown dropdown-toggle" name="food_id" data-bs-toggle="dropdown" aria-expanded="false" required>
                                        <option value="" disabled selected>Select a <?php echo strtolower($category); ?></option>
                                        <?php 
                                        if (isset($foodItems[$category])) {
                                            foreach ($foodItems[$category] as $food) {
                                                $portionSize = isset($food['portionSize']) ? $food['portionSize'] : 'N/A';  
                                                echo "<option value='{$food['id']}' data-calories='{$food['calories']}' data-portion-size='{$portionSize}'>";
                                                echo "{$food['name']} ({$food['calories']} Calories - Portion: {$portionSize})</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="mt-3">
                            <a href="track.php" type="button" name="cancel" class="btn btn-secondary">Cancel</a>
                            <a href="#" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>

                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteModalLabel">Are you sure you want to delete this permanently?</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Click "Delete" if you want to permanently delete this meal.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" name="delete_food" class="btn btn-primary">Delete</button>
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
</body>
</html>