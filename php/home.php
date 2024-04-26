<?php

  session_start();
  if ($_SESSION['registered'] !== true){
    header('Location: ../index.php');
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
  <link rel="stylesheet" href="../styles/home.css">
  <title>Welcome</title>
</head>

<body>
  <header>
    <section class="navbar container">
      <div class="logo">
        <img src="../images/logo.png" alt="">
        <a href="">Stocks.com</a>
      </div>
      <nav>
        <a href="">Home</a>
        <a href="../php/stock-entry.php">Add Stocks</a>
        <a href="../php/logout.php" id="logout-btn">Logout</a>
      </nav>
    </section>
  </header>

  <main class="container">
  <h1>Welcome to Stocks.com !</h1>
  <section class="stocks">
    <h2>Here are the stocks :</h2>
    <section class="stocks-table">

    </section>
  </section>
  </main>
  
  <script>
    var username = "<?php echo $_SESSION['username']?>";
  </script>
  <script src="../scripts/script.js"></script>

</body>
</html>