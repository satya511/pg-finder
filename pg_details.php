<!DOCTYPE html>
<html>

<head>
  <title>PG Finder - PG Details</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
  <header>
    <div class="logo">
      <h1>PG Finder</h1>
    </div>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="registration.php">Register</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <div class="pg-details">
      <?php
        // Get the PG ID from the query string
        $pg_id = $_GET['id'];
        
        // Connect to the database
        $conn = mysqli_connect("localhost", "root", "", "pg");
        // Check if the connection is successful
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        
        
        // Retrieve the PG details from the database
        $sql = "SELECT * FROM `pg` WHERE `id` = $pg_id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        
        // Display the PG details
        echo "<h2>" . $row['name'] . "</h2>";
        echo "<div class='pg-photo'>";
        echo "<img src='uploads/" . $row['photo'] . "' alt='PG Image' />";
        echo "</div>";
        echo "<div class='pg-info'>";
        echo "<p><strong>Location:</strong> " . $row['location'] . "</p>";
        echo "<p><strong>Price:</strong> $" . $row['price'] . "/month</p>";
        // echo "<p><strong>Description:</strong> " . $row['description'] . "</p>";
        echo "<p><strong>Facilities:</strong></p>";
        echo "<ul>";
        $facilities = explode(",", $row['facilities']);
        foreach ($facilities as $facility) {
          echo "<li>" . trim($facility) . "</li>";
        }
        echo "</ul>";
        echo "</div>";
        
        // Close the database connection
        mysqli_close($conn);
      ?>
    </div>
  </main>
</body>

</html>