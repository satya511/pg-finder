<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $phone_number = $_POST['phone-number'];
  $address = $_POST['address'];

  // Validate the form data
  $errors = [];
  if (empty($name)) {
    $errors[] = 'Please enter your name.';
  }
  if (empty($email)) {
    $errors[] = 'Please enter your email address.';
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address.';
  }
  if (empty($password)) {
    $errors[] = 'Please enter a password.';
  }
  if ($password != $_POST['confirm-password']) {
    $errors[] = 'Passwords do not match.';
  }
  if (empty($phone_number)) {
    $errors[] = 'Please enter your phone number.';
  }
  if (empty($address)) {
    $errors[] = 'Please enter your address.';
  }

  // If there are no errors, insert the data into the database
  if (empty($errors)) {
    // Connect to the database (replace "hostname", "username", "password", and "database" with your own values)
    $conn = mysqli_connect('localhost', 'root', '', 'pg');

    // Check if the connection was successful
    if (!$conn) {
      die('Database connection error: ' . mysqli_connect_error());
    }

    // Insert the data into the "users" table
    $sql = "INSERT INTO users (name, email, password, phone_number, address) VALUES ('$name', '$email', '$password', '$phone_number', '$address')";

    if (mysqli_query($conn, $sql)) {
      echo 'Registration successful.';
    } else {
      echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
  } else {
    // If there are errors, display them to the user
    foreach ($errors as $error) {
      echo '<p>' . $error . '</p>';
    }
  }
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Registration</title>
  <link rel="stylesheet" href="./css/registration.css">
</head>

<body>
  <div class="container">
    <h1>Register</h1>
    <form action="registration.php" method="POST">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <label for="confirm-password">Confirm Password:</label>
      <input type="password" id="confirm-password" name="confirm-password" required>

      <label for="phone-number">Phone Number:</label>
      <input type="tel" id="phone-number" name="phone-number" required>

      <label for="address">Address:</label>
      <textarea id="address" name="address" required></textarea>

      <button type="submit">Register</button>
    </form>
  </div>

</body>

</html>