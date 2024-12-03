<?php
include 'dashboard.php'; // Include dashboard (if needed for structure)

// Initialize food categories
$categories = [
    'Grains', 'Dairies', 'Fruits', 'Eggs', 'Breakfast', 'Lunch', 'Dinner', 'Snacks',
];

// Process the form submission when the button is clicked
if (isset($_POST['save_food'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $calories = $_POST['calories'];
    $portionSize = $_POST['portionSize'];
    $category = $_POST['category'];

    // Manually connect to the database
    $conn = new mysqli("localhost", "root", "", "isrhh");

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the food item already exists in the database
    $query = $conn->query("SELECT * FROM `meal_tbl` WHERE `name` = '$name' AND `category` = '$category'") or die(mysqli_error($conn));
    $rowCount = $query->num_rows;

    // If the food item already exists, show an alert
    if ($rowCount > 0) {
        echo "<script>alert('Food item already exists in the selected category!');</script>";
    } else {
        // Insert the new food item into the database
        $insertQuery = "INSERT INTO `meal_tbl` (`name`, `calories`, `category`, `portionSize`) 
                        VALUES ('$name', '$calories', '$category', '$portionSize')";
        if ($conn->query($insertQuery) === TRUE) {
            echo "<script>alert('Food item added successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }

    // Close the connection
    $conn->close();
}

// Fetch all food items from the database categorized by category
$conn = new mysqli("localhost", "root", "", "isrhh");
$foodItems = [];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch food items for each category
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                        <span><i class="bi bi-bag-plus-fill"></i> ADDING NEW MEALS</span>
                    </div>

                    <div class="card-body">
                        <div class="row align-items-start">
                            <div class="col">
                            <!-- Food Form -->
                            <form id="foodForm" method="POST">
                                <!-- Food Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Food Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter food name" required>
                                </div>

                                <!-- Calories -->
                                <div class="mb-3">
                                    <label for="calories" class="form-label">Calories</label>
                                    <input type="number" class="form-control" id="calories" name="calories" placeholder="Enter calories" required>
                                </div>
                            </div>

                            <div class="col">
                            <!-- Portion Size -->
                            <div class="mb-3">
                                <label for="portionSize" class="form-label">Portion Size</label>
                                <input type="text" class="form-control" id="portionSize" name="portionSize" placeholder="Enter portion size" required>
                            </div>

                            <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value=""disabled selected >Select Category</option>
                            <option value="grains">Grains</option>
                            <option value="dairies">Dairies</option>
                            <option value="fruits">Fruits</option>
                            <option value="eggs">Eggs</option>
                            <option value="breakfast">Breakfast</option>
                            <option value="lunch">Lunch</option>
                            <option value="dinner">Dinner</option>
                            <option value="snacks">Snacks</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
            </div>
            
                  <!-- Trigger Modal -->
                    <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#saveModal">Save Menu</a>

                    <!-- Modal -->
                    <div class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="saveModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="saveModalLabel">Do you want to save this meal?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Clicking "Yes" will save the meal.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <!-- Button triggers form submission -->
                                    <button type="submit" name="save_food" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>

    </div>
</div>
</div>
</div>

            <div class="row">   
            <div class="col-md-11 mb-3 ms-4">
                <div class="card">
                <div class="card-header">
                        <span><i class="bi bi-clipboard2-pulse"></i> CALORIE TRACKER</span>
                    </div>
                </form>
                    <div class="card-body">
                        <div class="row">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="delete_meal.php" class="btn btn-danger" type="button"><i class="bi bi-trash3"></i> Delete Meals</a>
                        </div>
                        <?php foreach ($categories as $category): ?>
                            <div class="col-md-3">
                            <label for="category" class="form-label"><?php echo $category; ?></label>
                               
                                <select id="<?php echo strtolower($category); ?>" class="form-control searchable-dropdown dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <option value="" disabled selected>Select a <?php echo strtolower($category); ?></option>
                                    <?php 
                                    // Check if there are food items for this category
                                    if (isset($foodItems[$category])) {
                                        foreach ($foodItems[$category] as $food) {
                                            $portionSize = isset($food['portionSize']) ? $food['portionSize'] : 'N/A';  // Check if portionSize is set
                                            echo "<option value='{$food['name']}' data-calories='{$food['calories']}' data-portion-size='{$portionSize}'>";
                                            echo "{$food['name']} ({$food['calories']} Calories - Portion: {$portionSize})</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    <hr>
                              
                        <!-- Meal Selection -->
                        <div class="row">
                        <div class="col">
                            <div class="form-group">
                            <label for="height">Add other meal</label>
                                <input type="text" id="mealName" class="form-control" placeholder="Meal Name">
                            </div>
                            
                        </div>
                        <div class="col">
                            <div class="form-group">
                            <label for="height">Type the Calories</label>
                                <input type="number" id="mealCalories" class="form-control" placeholder="Calories">
                            </div>
                            
                        </div>
                    </div>

                        <!-- Add Meal Button -->
                        <div class="row align-items-start">
                        
                        <div class="col align-self-center">
                        <button class="btn-add" data-bs-toggle="modal" data-bs-target="#addModal"><i class="bi bi-bag-plus-fill"></i> Add Meal</button>

                            <!-- Modal -->
                            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="addModalLabel">Are you sure to add meal?</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Click "Yes" if you want to add the meal.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                            <button type="button" id="addMeal" class="btn btn-primary">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col align-self-center">
                        <button class="btn-del" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="bi bi-eraser-fill"></i> Clear All</button>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="deleteModalLabel">Are you sure to clear this?</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Click "Yes" if you want to clear all the meals.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <button type="button" id="deleteAll" class="btn btn-primary">Yes</button>
                            </div>
                            </div>
                        </div>
                        </div>
                        
                    </div>


                        <!-- Meal List and Total Calories -->
                        <div class="row mt-3">
                            <div class="col text-center">
                                <h5><span id="totalCalories"></span></h5>
                                <ul id="mealList" class="list-group"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <script src="meal.script.js"></script>
</main>
<!-- Add this script at the bottom of your HTML or in an external JS file -->
<script>
  document.getElementById("deleteAll").addEventListener("click", function() {
    // Perform the action of clearing meals here
    console.log("Meals cleared");

    // Close the modal
    var modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
    modal.hide();
  });
</script>
<script>
    document.getElementById('addMeal').addEventListener('click', function() {
        // Your logic for adding the meal goes here
        // For example, you might want to send an AJAX request or update the UI

        // After your logic, close the modal
        var modalElement = document.getElementById('addModal');
        var modal = bootstrap.Modal.getInstance(modalElement); // Get the modal instance
        if (modal) {
            modal.hide(); // Hide the modal
        }
    });
</script>
</body>
</html>
