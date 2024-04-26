<?php

/**
 * Class for loading stocks.
 */
class StocksLoader {

  /**
   * Loads all stocks from the database.
   *
   * @return string
   */
  public function loadStocks() {
    $conn = mysqli_connect('localhost', 'anish-hell', '928485', 'STOCKS');
    $query = "SELECT * FROM USER_STOCKS";

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

$stocksLoad = new StocksLoader();
$stocks = $stocksLoad->loadStocks();
echo $stocks;
?>
