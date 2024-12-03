document.getElementById('searchButton').addEventListener('click', function() {
    const query = document.getElementById('mealName').value;
    if (!query) {
        alert('Please enter a meal name');
        return;
    }

    const appId = '21f8d57e';  // Your actual app_id
    const appKey = '4229ccef4f240235574537c6b25729e3';  // Your actual app_key
    const url = `https://api.edamam.com/api/food-database/v2/parser?ingr=${encodeURIComponent(query)}&app_id=${appId}&app_key=${appKey}`;

    // Clear previous results
    document.getElementById('resultsTable').style.display = 'none';
    document.getElementById('resultsList').innerHTML = '';

    // Fetch the data from the API
    fetch(url)
        .then(response => response.json())
        .then(data => {
            console.log('API Response:', data);  // Log full response to the console for debugging

            // Check if hints exist (if we found a valid result)
            if (data.hints && data.hints.length > 0) {
                displaySearchResults(data);
            } else {
                alert('No meals found. Please try a different search.');
                document.getElementById('resultsTable').style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            alert('Error occurred while fetching data. Please try again.');
        });
});

// Function to display search results in a table
function displaySearchResults(data) {
    const resultsList = document.getElementById('resultsList');
    document.getElementById('resultsTable').style.display = 'table';  // Show results table

    // Clear previous results
    resultsList.innerHTML = '';

    data.hints.forEach(item => {
        const food = item.food;
        const label = food.label;
        const measures = food.measures;
        const calories = food.nutrients ? food.nutrients.ENERC_KCAL : 'N/A'; // Get calories if available

        // Add a new row for each result
        const resultItem = document.createElement('li');
        resultItem.textContent = `${label} - Calories: ${calories} kcal`;

        // Append to results list
        resultsList.appendChild(resultItem);
    });
}
