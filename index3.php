<!DOCTYPE html>
<html>

<head>
  <title>PG Finder - Home</title>
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
    <div class="search-bar">
      <form action="search.php" method="get">
        <input type="text" id="search-input" placeholder="Enter city or area" />
        <input type="text" id="budget-input" placeholder="Enter budget" />
        <input type="submit" id="search-btn" value="Search" />
      </form>
    </div>
    <div class="pg-list">
      <h2>Recently Added PGs</h2>
      <ul>
        <?php
            // Connect to the database
            $conn = mysqli_connect("localhost", "root", "", "pg");        // Check if the connection is successful
            if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
            }
    
            // Retrieve the recently added PGs from the database
            $sql = "SELECT `id`, `name`, `price`, `location`, `facilities`, `photo` FROM `pg` ORDER BY id DESC LIMIT 6";
            $result = mysqli_query($conn, $sql);
    
            // Loop through the results and display each PG
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<li>";
              echo "<a href='pg_details.php?id=" . $row['id'] . "'>";
              echo '<img src="uploads/' . $row["photo"] . '" alt="PG photo">';
              echo "<h3>" . $row['name'] . "</h3>";
              echo "<p>" . $row['location'] . "</p>";
              echo "<p>Starting from &#8377;" . $row['price'] . "/month</p>";
              echo "</a>";
              echo "</li>";
            }
    
            // Close the database connection
            mysqli_close($conn);
          ?>
      </ul>
    </div>
    <div class="featured-pg">
      <h2>Featured PGs</h2>
      <ul id="featured-pgs">
        <li>
          <a href="#" data-id="1">
            <img src="https://placeimg.com/200/150/people" alt="PG Image" />
            <h3>PG Title</h3>
            <p>City, Area</p>
            <p>Starting from &#8377;500/month</p>
          </a>
        </li>
        <li>
          <a href="#" data-id="2">
            <img src="https://placeimg.com/200/150/animals" alt="PG Image" />
            <h3>PG Title</h3>
            <p>City, Area</p>
            <p>Starting from &#8377;500/month</p>
          </a>
        </li>
        <li>
          <a href="#" data-id="3">
            <img src="https://placeimg.com/200/150/arch" alt="PG Image
            " />
            <h3>PG Title</h3>
            <p>City, Area</p>
            <p>Starting from &#8377;500/month</p>
          </a>
        </li>
      </ul>
    </div>

  </main>
  <footer>
    <p>Copyright &copy; PG Finder</p>
  </footer>
</body>

</html>