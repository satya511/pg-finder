<!DOCTYPE html>
<html>

<head>
  <title>PG Finder - Book Now</title>
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
    <div class="booking-form">
      <h2>Book Now</h2>
      <form action="#" method="post">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required />
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required />
        <label for="phone">Phone</label>
        <input type="tel" id="phone" name="phone" required />
        <label for="checkin-date">Check-in Date</label>
        <input type="date" id="checkin-date" name="checkin_date" required />
        <label for="checkout-date">Check-out Date</label>
        <input type="date" id="checkout-date" name="checkout_date" required />
        <input type="submit" id="book-now-btn" name="book_now" value="Book Now" />
      </form>
    </div>
    <?php
      // Check if the form has been submitted
      if (isset($_POST['book_now'])) {
        // Get the form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $checkin_date = $_POST['checkin_date'];
        $checkout_date = $_POST['checkout_date'];
        $pg_id = $_GET['id'];
        
        // Connect to the database
        $conn = mysqli_connect("localhost", "root", "", "pg");

        // Check if the connection is successful
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        // Insert the booking information into the database
        $sql = "INSERT INTO `bookings` (`pg_id`, `name`, `email`, `phone`, `checkin_date`, `checkout_date`) VALUES ('$pg_id', '$name', '$email', '$phone', '$checkin_date', '$checkout_date')";
        if (mysqli_query($conn, $sql)) {
          echo "<div class='success-msg'>Booking Successful</div>";
        } else {
          echo "<div class='error-msg'>Booking Failed</div>";
        }

        // Close the database connection
        mysqli_close($conn);
      }
    ?>
  </main>
</body>

</html>