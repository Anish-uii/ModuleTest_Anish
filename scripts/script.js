$(document).ready(function () {
  displayStocks()

  $('.stocks-table').on('click', '[id^="delete-btnid"]', function (event) {
    event.preventDefault()
    var stockId = $(this).attr('id').replace('delete-btnid', '')
    deleteStock(stockId)
  })

  function displayStocks () {
    $.ajax({
      url: '../db/fetch-stocks.php',
      method: 'GET',
      success: function (response) {
        var stocks = JSON.parse(response)
        if (stocks.error) {
          console.error(stocks.error)
          return
        }
        console.log(stocks)
        loadStocks(stocks)
      },
      error: function (xhr) {
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
      if (stock.USERNAME == username) {
        tableHTML += `
          <tr>
            <td>${stock.STOCK_NAME}</td>
            <td>${stock.STOCK_PRICE}</td>
            <td>${stock.CREATED_DATE}</td>
            <td>${stock.LAST_UPDATED}</td>
            <td><span class="delete-btn" id="delete-btnid${stock.STOCK_ID}">Delete <i class="fa-solid fa-trash"></i></span></td>
          </tr>
          
        `
      }else {
        tableHTML += `
          <tr>
            <td>${stock.STOCK_NAME}</td>
            <td>${stock.STOCK_PRICE}</td>
            <td>${stock.CREATED_DATE}</td>
            <td>${stock.LAST_UPDATED}</td>
          </tr>
        `
      }
    })
    tableHTML += `
        </tbody>
      </table>
    `
    $('.stocks-table').html(tableHTML)
  }

  function deleteStock (stockId) {
    console.log(stockId)

    $.ajax({
      url: '../db/deleteStock.php',
      method: 'GET',
      data: { stockId: stockId },
      success: function (response) {
        var res = JSON.parse(response)
        if (res.error) {
          console.error(res.error)
          return
        }
        displayStocks();
      },
      error: function (xhr) {
        console.error(xhr.responseText)
      }
    })
  }
})
