$(document).ready(function () {
  $('form.stocks').submit(function (e) {
    var stockPriceInput = $('#stockPrice').val()
    if (!validateStockPrice(stockPriceInput)) {
      e.preventDefault()
      alert('Please enter a valid decimal number for the stock price.')
    }
  })
  displayUserStocks(username)
  function validateStockPrice (input) {
    var decimalRegex = /^\d+(\.\d{1,2})?$/
    return decimalRegex.test(input)
  }
  function displayUserStocks (username) {
    $.ajax({
      url: '../db/fetch-user-stocks.php',
      method: 'GET',
      data: {username: username},
      success: function (response) {
        var stocks = JSON.parse(response)
        if (stocks.error) {
          console.error(stocks.error)
          return
        }
        loadStocks(stocks)
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText)
      }
    })
  }
  function loadStocks (stocks) {
    var tableHTML = `
      <table>
        <thead>
          <tr>
            <th>Stock Name</th>
            <th>Stock Price</th>
            <th>Created Date</th>
            <th>Last Updated</th>
          </tr>
        </thead>
        <tbody>
    `
    stocks.forEach(function (stock) {
      tableHTML += `
          <tr>
            <td>${stock.STOCK_NAME}</td>
            <td>${stock.STOCK_PRICE}</td>
            <td>${stock.CREATED_DATE}</td>
            <td>${stock.LAST_UPDATED}</td>
            <td><span class="update-btn" id="update-btnid${stock.STOCK_ID}">Update <i class="fa-solid fa-pen-to-square"></i></span></td>
          </tr>
        `
    })
    tableHTML += `
        </tbody>
      </table>
    `
    $('.stocks-table').html(tableHTML)
  }
  $('.stocks-table').on('click', '[id^="update-btnid"]', function () {
    var stockID = $(this).attr('id').replace('update-btnid', '')

    $.ajax({
      url: '../db/fetch-stock-details.php',
      method: 'GET',
      data: { stockID: stockID },
      success: function (response) {
        var stockDetails = JSON.parse(response)
        updateStock(stockDetails)
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText)
      }
    })
  })
  function updateStock(stockDetails) {
    var updateFormHTML = `
      <form id="updateForm" class="stocks" action="../db/update-stock.php" method="post">
        <h3>Update Stock</h3>
        <input type="hidden" name="stockID" value="${stockDetails[0].STOCK_ID}">
        <div>
          <label for="updateStockName">Stock Name :</label>
          <input type="text" name="updateStockName" id="updateStockName" value="${stockDetails[0].STOCK_NAME}" placeholder="Stock Name">
        </div>
        <div>
          <label for="updateStockPrice">Stock Price : </label>
          <input type="text" name="updateStockPrice" id="updateStockPrice" value="${stockDetails[0].STOCK_PRICE}" placeholder="Stock Price">
        </div>
        <input type="submit" value="Update Stock" name="submit">
      </form>
    `;
  
    $('.form-container').html(updateFormHTML);
  }
  
})
