<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

  session_start();
  if ($_SESSION['registered'] !== true){
    header('Location: /index.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="../styles/stock-entry.css">
  <title>Stock Entry</title>
</head>

<body>
  <main class="container">
    <section class="form-container">
      <form action="../db/stock-entry-check.php" class="stocks" method="post">
        <h3>Stock Details</h3>
        <div>
          <label for="stockName">Enter Stock Name :</label>
          <input type="text" name="stockName" id="stockName" placeholder="Stock Name">
        </div>
        <div>
          <label for="stockPrice">Enter Stock Price : </label>
          <input type="text" name="stockPrice" id="stockPrice" placeholder="Stock Price">
        </div>
        <input type="submit" value="Add Stock" name="submit">
      </form>
    </section>
    <section class="userStocks">
      <h2>Here are your stocks:</h2>
      <section class="stocks-table">
      </section>
    </section>
  </main>

  <script>
    var username = "<?php echo $_SESSION['username']?>";
  </script>
  <script src="../scripts/stocks.js"></script>

</body>
</html>