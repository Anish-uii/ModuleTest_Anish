<?php

if (isset($_POST["submit"])) {
  session_start();
  try {
    $conn = mysqli_connect('localhost', 'anish-hell', '928485', 'STOCKS');
    if ($conn->connect_error) {
      throw new Exception('Failed to connect to database: ' . $conn->connect_error);
    } else {
      $stockName = $_POST['stockName'];
      $stockPrice = $_POST['stockPrice'];

      if (empty($stockName) || empty($stockPrice)) {
        throw new Exception("Please fill in all fields");
      }
      date_default_timezone_set('Asia/Kolkata');
      $createdDate = date('Y-m-d H:i:s', time());
      $updatedDate = $createdDate;
      $username = $_SESSION["username"];

        $conn->begin_transaction();
        $query = "INSERT INTO USER_STOCKS (USERNAME, STOCK_NAME, STOCK_PRICE, CREATED_DATE, LAST_UPDATED) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        $stmt->bind_param("sssss", $username, $stockName, $stockPrice, $createdDate, $updatedDate);
        if (!$stmt->execute()) {
          throw new Exception("Error: " . $stmt->error);
        } else {
          $conn->commit();
          echo "<script>window.location.href = '../php/home.php';</script>";
          exit;
        }
    }
  } catch (Exception $e) {
    echo "<script>alert('Oops: " . addslashes($e->getMessage()) . "');</script>";
    echo "<script>window.location.href = '../php/stock-entry.php';</script>";
    exit;
  } finally {
    if (isset($conn)) {
      $conn->close();
    }
  }
}