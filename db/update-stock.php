<?php

if (isset($_POST["submit"])) {
  session_start();
  try {
    $conn = mysqli_connect('localhost', 'anish-hell', '928485', 'STOCKS');
    if ($conn->connect_error) {
      throw new Exception('Failed to connect to database: ' . $conn->connect_error);
    } else {
      $updateStockName = $_POST['updateStockName'];
      $updateStockPrice = $_POST['updateStockPrice'];

      if (empty($updateStockName) || empty($updateStockPrice)) {
        throw new Exception("Please fill in all fields");
      }
      date_default_timezone_set('Asia/Kolkata');
      $createdDate = date('Y-m-d H:i:s', time());

        $conn->begin_transaction();
        $query = "UPDATE USER_STOCKS SET (STOCK_NAME, STOCK_PRICE, LAST_UPDATED) VALUES (?, ?, ?) WHERE STOCK_NAME = '$updateStockName'";
        $stmt = $conn->prepare($query);

        $stmt->bind_param("sss", $updateStockName, $updateStockPrice, $updatedDate);
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