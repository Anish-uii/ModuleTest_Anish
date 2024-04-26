<?php

if (isset($_POST["submit"])) {
  session_start();
  try {
    $conn = mysqli_connect('localhost', 'anish-hell', '928485', 'STOCKS');
    if ($conn->connect_error) {
      throw new Exception('Failed to connect to database: ' . $conn->connect_error);
    } else {
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $fullName = $fname . ' ' . $lname;
      $username = $_POST['username'];
      $password = $_POST['password'];
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
      $email = $_POST['email'];

      if (empty($fname) || empty($lname) || empty($username) || empty($password) || empty($email)) {
        throw new Exception("Please fill in all fields");
      }

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email format");
      }

        $conn->begin_transaction();
        $query = "INSERT INTO USER_DATA (NAME, USERNAME, PASSWORD, EMAIL) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        $stmt->bind_param("ssss", $fullName, $username, $password, $email);
        if (!$stmt->execute()) {
          throw new Exception("Error: " . $stmt->error);
        } else {
          $conn->commit();
          $_SESSION['registered'] = true;
          $_SESSION["username"] = $username;
          echo "<script>window.location.href = '../php/home.php';</script>";
          exit;
        }
    }
  } catch (Exception $e) {
    echo "<script>alert('Oops: " . addslashes($e->getMessage()) . "');</script>";
    echo "<script>window.location.href = '../php/login.php';</script>";
    exit;
  } finally {
    if (isset($conn)) {
      $conn->close();
    }
  }
}