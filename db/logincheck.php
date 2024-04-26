<?php

if (isset($_POST["submit"])) {
  session_start();
  try {
    $conn = mysqli_connect('localhost', 'anish-hell', '928485', 'STOCKS');
    if ($conn->connect_error) {
      throw new Exception('' . $conn->connect_error);
    } else {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $result = mysqli_fetch_array(mysqli_query($conn, "SELECT PASSWORD FROM USER_DATA WHERE USERNAME = '$username'"));

      if (!$result) {
        throw new Exception("No User Found !! Please check the details, and try again.");
      } else {
        $hashed_password = $result['PASSWORD'];

        if (!password_verify($password, $hashed_password)) {
          throw new Exception("Invalid Username or password, please try again !!");
        } else {
          $_SESSION['registered'] = true;
          $_SESSION['username'] = $username;
          echo "<script>window.location.href = '../php/home.php';</script>";
        }
      }
    }
  } catch (Exception $e) {
    echo "<script>alert('Ooops : " . addslashes($e->getMessage()) . "');</script>";
    echo "<script>window.location.href = '../index.php';</script>";
  }
}