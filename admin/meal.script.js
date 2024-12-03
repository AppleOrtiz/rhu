document.addEventListener("DOMContentLoaded", function () {
    const categorySelects = document.querySelectorAll('.form-control'); // All category select elements
    const totalCaloriesDisplay = document.getElementById("totalCalories");
    const itemList = document.getElementById("mealList");

    let totalCalories = 0; // This variable will track the total calories

    // Function to update the total calories display
    function updateTotalCalories() {
        totalCaloriesDisplay.textContent = `Total Calories: ${totalCalories}`;
    }

    // Function to handle adding selected food item and updating total calories
    function handleFoodSelection(selectElement) {
        const selectedOption = selectElement.selectedOptions[0]; // Get the selected option
        const foodName = selectedOption.value;  // Get food name
        const foodCalories = parseInt(selectedOption.dataset.calories);  // Get calories from data attribute

        if (foodName && foodCalories) {
            // Add the selected food's calories to the total
            totalCalories += foodCalories;

            // Update the total calories display
            updateTotalCalories();

            // Create the list item for the selected food
            const li = document.createElement("li");
            li.textContent = `${foodName} (${foodCalories} calories)`; // Show food name and calories

            const deleteButton = document.createElement("button");
            deleteButton.textContent = "Delete";
            deleteButton.classList.add("delete-btn");
            li.appendChild(deleteButton);

            // Append the item to the meal list
            itemList.appendChild(li);

            // Add delete functionality to the item
            deleteButton.addEventListener("click", function () {
                deleteItem(foodCalories, li); // Remove the item and update total calories
            });
        }

        // Reset the dropdown selection after a food item is selected
        selectElement.value = ""; // Reset dropdown to default state
    }

    // Function to handle deleting a food item from the list and updating total calories
    function deleteItem(calories, listItem) {
        totalCalories -= calories; // Subtract the calories of the deleted item from the total
        updateTotalCalories(); // Update the total calories display
        listItem.remove(); // Remove the list item
    }

    // Add event listeners to all category selects to handle food selection
    categorySelects.forEach(function (selectElement) {
        selectElement.addEventListener("change", function () {
            handleFoodSelection(selectElement);  // Call the handler when a food item is selected
        });
    });

    // Handle adding a custom meal
    document.getElementById("addMeal").addEventListener("click", function () {
        const customMealName = document.getElementById("mealName").value.trim();
        const customMealCalories = document.getElementById("mealCalories").value.trim();

        if (customMealName && customMealCalories) {
            addItem(customMealName, parseInt(customMealCalories)); // Add custom meal and calories to total
        }

        // Reset the input fields after adding the custom meal
        document.getElementById("mealName").value = "";
        document.getElementById("mealCalories").value = "";
    });

    // Function to add a custom meal to the list and update the total calories
    function addItem(name, calories) {
        totalCalories += calories; // Add calories to total
        updateTotalCalories(); // Update the total calories display

        // Create a new list item for the custom meal
        const li = document.createElement("li");
        li.textContent = `${name} (${calories} calories)`;  // Show custom meal name and calories

        const deleteButton = document.createElement("button");
        deleteButton.textContent = "Delete";
        deleteButton.classList.add("delete-btn");
        li.appendChild(deleteButton);

        // Add the custom meal item to the list
        itemList.appendChild(li);

        // Add delete functionality for the custom meal item
        deleteButton.addEventListener("click", function () {
            deleteItem(calories, li);
        });
    }

    // Clear all meals and reset the total calories
    document.getElementById('deleteAll').addEventListener('click', function () {
        const listItems = itemList.children;

        for (let i = 0; i < listItems.length; i++) {
            const calories = parseInt(listItems[i].textContent.split("(")[1].split(" ")[0]);
            totalCalories -= calories; // Subtract calories of each item
        }

        updateTotalCalories(); // Update the total calories
        itemList.innerHTML = ''; // Clear the list
    });
});
