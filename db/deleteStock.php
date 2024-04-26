<?php

/**
 * Class for deleting stocks.
 */
class DeleteStock {

  /**
   * Deletes a stock by its ID.
   *
   * @param int $stockId
   *   The ID of the stock record to delete.
   *
   * @return string
   */
  public function deleteStockById($stockId) {
    $conn = mysqli_connect('localhost', 'anish-hell', '928485', 'STOCKS');
    $query = "DELETE FROM USER_STOCKS WHERE STOCK_ID = $stockId";

    $result = mysqli_query($conn, $query);

    if ($result) {
      return json_encode(["success" => true]);
    }
    else {
      return json_encode(["error" => "Failed to delete the stock"]);
    }
  }

}

$deletedStocks = new DeleteStock();

if (isset($_GET['stockId'])) {
  $stockId = $_GET['stockId'];
  $userStocks = $deletedStocks->deleteStockById($stockId);
  echo $userStocks;
}
else {
  echo json_encode(["error" => "Invalid stockId"]);
}
?>
