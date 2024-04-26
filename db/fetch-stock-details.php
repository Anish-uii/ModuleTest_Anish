<?php

/**
 * Class for fetching stock details.
 */
class StockFetch {

  /**
   * Fetches stock details by ID.
   *
   * @param int $stockID
   *   The ID of the stock.
   *
   * @return string
   */
  public function fetchStockDetails($stockID) {
    $conn = mysqli_connect('localhost', 'anish-hell', '928485', 'STOCKS');
    $query = "SELECT * FROM USER_STOCKS WHERE STOCK_ID = '$stockID'";

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

$stocksLoad = new StockFetch();

if (isset($_GET['stockID'])) {
  $stockID = $_GET['stockID'];
  $userStocks = $stocksLoad->fetchStockDetails($stockID);
  echo $userStocks;
}
else {
  echo json_encode(["error" => "Invalid stockID"]);
}
?>
