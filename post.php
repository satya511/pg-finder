<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the PG information from the form
    $name = $_POST['name'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $facilities = $_POST['facilities'];
    $photo = $_FILES['photo']['name'];

    // Validate user inputs
    if (empty($name) || empty($price) || empty($location) || empty($facilities) || empty($photo)) {
        echo "All fields are required!";
        exit;
    }

    // Sanitize user inputs
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $price = filter_var($price, FILTER_SANITIZE_NUMBER_INT);
    $location = filter_var($location, FILTER_SANITIZE_STRING);
    $facilities = filter_var($facilities, FILTER_SANITIZE_STRING);
    $photo = filter_var($photo, FILTER_SANITIZE_STRING);

    // Upload the photo to the server
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES['photo']['name']);

    if ($_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
        echo "Error uploading file: " . $_FILES['photo']['error'];
        exit;
    }

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (!move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
        echo "Error moving file to destination directory";
        exit;
    }

    // Connect to the database using prepared statements
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pg";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO pg (name, price, location, facilities, photo) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $name, $price, $location, $facilities, $photo);

    // Insert the PG information into the database
    if ($stmt->execute()) {
        echo "PG added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html>

<head>
  <title>Post Your PG</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
  <header>
    <h1>Post Your PG</h1>
  </header>
  <main>
    <form action="post.php" method="post" enctype="multipart/form-data">

      <div class="form-group">
        <label for="name">PG Name:</label>
        <input type="text" name="name" id="name" required />
      </div>
      <div class="form-group">
        <label for="price">Price:</label>
        <input type="text" name="price" id="price" required />
      </div>
      <div class="form-group">
        <label for="location">Location:</label>
        <input type="text" name="location" id="location" required />
      </div>
      <div class="form-group">
        <label for="facilities">Facilities:</label>
        <textarea name="facilities" id="facilities" required></textarea>
      </div>
      <div class="form-group">
        <label for="photo">Photo:</label>
        <input type="file" name="photo" id="photo" required />
      </div>
      <div class="form-group">
        <button type="submit" id="submit">Submit</button>
        <label for="submit" class="visually-hidden">Submit the form</label>
      </div>

    </form>
  </main>
</body>

</html>