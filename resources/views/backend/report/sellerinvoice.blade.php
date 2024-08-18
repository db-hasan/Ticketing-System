<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice PDF</title>
    <link rel="stylesheet" href="{{ public_path('backend/vendor/bootstrap/css/bootstrap.min.css') }}">
</head>

<body>

    <div class="row justify-content-center">
        <div class="row mb-3">
            <div class="col-12">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col" class="text-uppercase">Name</th>
                      <th scope="col" class="text-uppercase">Ride</th>
                      <th scope="col" class="text-uppercase text-end">Unit Price</th>
                      <th scope="col" class="text-uppercase text-end">QTY</th>
                      <th scope="col" class="text-uppercase text-end">Amount</th>
                    </tr>
                  </thead>
                  <tbody class="table-group-divider">
                    <tr>
                      <th rowspan="3" class="text-center align-middle">Seller 1</th>
                      <td>Ride 1 - This is Ride 1</td>
                      <td class="text-end">75</td>
                      <td class="text-end">2</td>
                      <td class="text-end">150</td>
                    </tr>
                    <tr>
                      <td>Ride 2 - This is Ride 2</td>
                      <td class="text-end">100</td>
                      <td class="text-end">3</td>
                      <td class="text-end">300</td>
                    </tr>
                    <tr>
                      <td>Ride 3 - This is Ride 3</td>
                      <td class="text-end">150</td>
                      <td class="text-end">3</td>
                      <td class="text-end">450</td>
                    </tr>
                    <tr>
                      <th scope="row" colspan="4" class="text-uppercase text-end">Total</th>
                      <th class="text-end">Tk. 950</th>
                    </tr>
                    <tr>
                      <th rowspan="3" class="text-center align-middle">Seller 2</th>
                      <td>Ride 1 - This is Ride 1</td>
                      <td class="text-end">75</td>
                      <td class="text-end">2</td>
                      <td class="text-end">150</td>
                    </tr>
                    <tr>
                      <td>Ride 2 - This is Ride 2</td>
                      <td class="text-end">100</td>
                      <td class="text-end">3</td>
                      <td class="text-end">300</td>
                    </tr>
                    <tr>
                      <td>Ride 3 - This is Ride 3</td>
                      <td class="text-end">150</td>
                      <td class="text-end">3</td>
                      <td class="text-end">450</td>
                    </tr>
                    <tr>
                      <th scope="row" colspan="4" class="text-uppercase text-end">Total</th>
                      <th class="text-end">Tk. 950</th>
                    </tr>
                    <tr>
                      <th rowspan="3" class="text-center align-middle">Seller 3</th>
                      <td>Ride 1 - This is Ride 1</td>
                      <td class="text-end">75</td>
                      <td class="text-end">2</td>
                      <td class="text-end">150</td>
                    </tr>
                    <tr>
                      <td>Ride 2 - This is Ride 2</td>
                      <td class="text-end">100</td>
                      <td class="text-end">3</td>
                      <td class="text-end">300</td>
                    </tr>
                    <tr>
                      <td>Ride 3 - This is Ride 3</td>
                      <td class="text-end">150</td>
                      <td class="text-end">3</td>
                      <td class="text-end">450</td>
                    </tr>
                    <tr>
                      <th scope="row" colspan="4" class="text-uppercase text-end">Total</th>
                      <th class="text-end">Tk. 950</th>
                    </tr>
                    <tr>
                      <th scope="row" colspan="4" class="text-uppercase text-end">Grand Total</th>
                      <th class="text-end ">Tk. 2850</th>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
    
    <script src="{{ public_path('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
</body>

</html>
