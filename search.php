<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "pg");

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the search query parameters from the URL
$cityOrArea = isset($_GET['location']) ? $_GET['location'] : "";
$budget = isset($_GET['price']) ? $_GET['price'] : "";

// Build the SQL query based on the search parameters
$sql = "SELECT * FROM pg WHERE location LIKE '%". mysqli_real_escape_string($conn, $cityOrArea) . "%' AND price <= '". mysqli_real_escape_string($conn, $budget) . "'";

// Execute the query and get the results
$result = mysqli_query($conn, $sql);

echo "Search query: " . $sql . "<br>";

// Check if there are any results
if ($result) {
    echo "Number of results: " . mysqli_num_rows($result) . "<br>";
    if (mysqli_num_rows($result) > 0) {
        // Loop through the results and display each PG
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='pg'>";
            echo "<a href='pg-details.php?id=" . $row['id'] . "'>";
            echo "<img src='./uploads/" . $row['photo'] . "' alt='PG Image' />";
            echo "<h3>" . $row['name'] . "</h3>";
            echo "<p>" . $row['location'] . "</p>";
            echo "<p>Starting from $" . $row['price'] . "/month</p>";
            echo "</a>";
            echo "</div>";
        }
    } else {
        echo "No PGs found for the given search criteria.";
    }
} else {
    echo "Error executing query: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>