<?php
include 'includes/config.php';
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Investment</title>
    <style>
        .add-button{
            text-align:center;
        }

    .investment{
        display:flex;
        justify-content:center;
    }

    .table thead th {
        background-color: black;
        color: white;
    }

    .table tbody td {
        color: black;
    }
    </style>

</head>
<body>

<?php
include 'includes/header.php';
session_start();
?>

<div class="container mt-4">
    <h2 class="investment">Investment</h2>

<?php

$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
if ($username) {
    $query = "SELECT account_Type FROM account WHERE username = ?";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, "s", $username);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['account_Type'] !== "professional") {
            echo "<div class='container'><p class='text-center'>Feature is not available for non-professional accounts.</p></div>";
            echo "</body></html>";
            exit(); 
        }
    } else {
        echo "<div class='container'><p class='text-center'>Username not found in session.</p></div>";
        echo "</body></html>";
        exit(); 
    }
}
?>

    <form action="includes/investment.add.php" method="post">
        <div class="row g-3">
            <div class="col-sm-6">
                <input type="text" name="date" class="form-control datepicker" placeholder="Date" required>
            </div>
            <div class="col-sm-6">
                <input type="text" name="name" class="form-control" placeholder="name" required>
            </div>
            <div class="col-sm-6">
                <input type="text" name="purchase_price" class="form-control" placeholder="purchase price" required>
            </div>
            <div class="col-sm-6">
                <input type="text" name="current_price" class="form-control" placeholder="current price" required>
            </div>
        </div>
        <div class="add-button">
            <button type="submit" class="btn btn-primary mt-3">ADD</button>
        </div>
    </form>
</div>

<?php

if ($row['account_Type'] === "professional") {
    echo "
        <div class='container'>
            <div class='table-responsive'>
                <table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Purchase Price</th>
                            <th>Current Price</th>
                            <th>Gain/Loss</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
                    <tbody>";
    $query = "SELECT i.investment_id,i.date, i.name, i.purchase_price, i.current_price 
                      FROM investment AS i 
                      INNER JOIN account AS a ON i.account_id = a.account_id 
                      WHERE a.username = ?";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, "s", $username);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $gain_loss = $row['current_price'] - $row['purchase_price'];
            echo "
                        <tr>
                            <td>" . $row['date'] . "</td>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['purchase_price'] . "</td>
                            <td>" . $row['current_price'] . "</td>
                            <td>" . $gain_loss . "</td>
                            <td>
                            <form action='includes/investment.delete.php' method='post'>
                            <input type='hidden' name='investment_id' value='" . $row['investment_id'] . "'>
                            <button type='submit' class='btn btn-danger'>Delete</button>
                            </form>
                            </td>
                        </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No investment details found.</td></tr>";
    }
    echo "
                    </tbody>
                </table>
            </div>
        </div>";
}

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>
    $(document).ready(function(){
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });
</script>

</body>
</html>
