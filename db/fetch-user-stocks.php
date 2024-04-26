<?php

/**
 * Class for loading user stocks.
 */
class UserStocksLoader {

  /**
   * Loads stocks with a given username.
   *
   * @param string $username
   *   The username whose stocks to load.
   *
   * @return string
   */
  public function loadUserStocks($username) {
    $conn = mysqli_connect('localhost', 'anish-hell', '928485', 'STOCKS');
    $query = "SELECT * FROM USER_STOCKS WHERE USERNAME = '$username'";

    $result = mysqli_query($conn, $query);
    $res = $result->fetch_all(MYSQLI_ASSOC);

    if (is_array($res)) {
      return json_encode($res);
    }
    else {
      return json_encode(["error" => "Cannot fetch data"]);
    }
  }

}

$stocksLoad = new UserStocksLoader();

if (isset($_GET['username'])) {
  $username = $_GET['username'];
  $userStocks = $stocksLoad->loadUserStocks($username);
  echo $userStocks;
}
else {
  echo json_encode(["error" => "Invalid username"]);
}
?>
