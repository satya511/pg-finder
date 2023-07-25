<?php
// Start a session
session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the form data
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Connect to the database
  $host = 'localhost';
  $user = 'root';
  $db_password = '';
  $dbname = 'pg';
  $conn = new mysqli($host, $user, $db_password, $dbname);

  // Check if the connection was successful
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare the SQL statement
  $sql = "SELECT id, email, password FROM users WHERE email = ?";

  // Create a prepared statement
  $stmt = $conn->prepare($sql);

  // Bind the parameters
  $stmt->bind_param("s", $email);

  // Execute the statement
  $stmt->execute();

  // Get the result
  $result = $stmt->get_result();

  // Check if a user was found with the given email
  if ($result->num_rows === 1) {
    // Get the user data
    $user = $result->fetch_assoc();

    // Check if the password is correct
    if (password_verify($password, $user['password'])) {
      // Set the session variables
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_email'] = $user['email'];

      // Redirect to the dashboard page
      header('Location: index3.php');
      exit();
    } else {
      // Invalid password
      $error = "Invalid email or password.";
    }
  } else {
    // User not found
    $error = "Invalid email or password.";
  }

  // Close the statement and connection
  $stmt->close();
  $conn->close();
}
?>


<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="css/login.css" />
</head>

<body>
  <h1>Login</h1>
  <form method="post" action="login.php">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required /><br />

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required /><br />

    <button type="submit">Login</button>
  </form>
</body>

</html>