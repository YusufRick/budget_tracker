<!DOCTYPE html>
<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
include 'includes/config.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Total Spending</title>
    <style>
        .add-button {
            text-align: center;
        }
        .heading {
            margin:auto;
            justify-content:center;
            display:flex;
        }

        .spending {
            display:flex;
            justify-content:center;
        }

        .container2 {
            height:500px;
            width:500px;
            display:flex;
            justify-content:center;
            align-items:center;
            margin:auto;
        }
        .container3 {
            display:flex;
            justify-content:space-around;
        }
    </style>
</head>
<body>

<?php
include 'includes/header.php';
?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="" method="post">
                <div class="input-group mb-3">
                    <select name="month" class="form-select" required>
                        <option value="">MONTH</option>
                        <option value="1">JANUARY</option>
                        <option value="2">FEBRUARY</option>
                        <option value="3">MARCH</option>
                        <option value="4">APRIL</option>
                        <option value="5">MAY</option>
                        <option value="6">JUNE</option>
                        <option value="7">JULY</option>
                        <option value="8">AUGUST</option>
                        <option value="9">SEPTEMBER</option>
                        <option value="10">OCTOBER</option>
                        <option value="11">NOVEMBER</option>
                        <option value="12">DECEMBER</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mt-4">
    <table class="table table-bordered">
        <thead class ="table-dark">
            <tr>
                <th>Date</th>
                <th>Category</th>
                <th>Amount(£)</th>
                <th>Description</th>
                <th>Balance(£)</th>
            </tr>
        </thead>
        <tbody>
            
        <?php
        if(isset($_SESSION['username']) && isset($_POST['month'])) {
            $username = $_SESSION['username'];
            $month = $_POST['month'];
            
            // fetch monthly budget
            $sql_budget = "SELECT budget FROM monthly_budget WHERE account_id IN (SELECT account_id FROM account WHERE username = ?) AND month = ?";
            $stmt_budget = $conn->prepare($sql_budget);
            $stmt_budget->bind_param("ss", $username, $month);
            $stmt_budget->execute();
            $result_budget = $stmt_budget->get_result();
            
            if ($result_budget && $result_budget->num_rows > 0) {
                $budget_row = $result_budget->fetch_assoc();
                $monthly_budget = $budget_row['budget'];
            
                $expense_query = "SELECT e.*, ec.category_name
                                  FROM expense AS e
                                  INNER JOIN expense_category AS ec ON e.category_id = ec.category_id
                                  INNER JOIN account AS a ON e.account_id = a.account_id
                                  WHERE a.username = ? AND MONTH(e.date) = ?";
                $expense_statement = $conn->prepare($expense_query);
                $expense_statement->bind_param("ss", $username, $month);
                $expense_statement->execute();
                $expense_result = $expense_statement->get_result();

                if ($expense_result && $expense_result->num_rows > 0) {
                    $total_spending = 0;
                    $current_balance = $monthly_budget;
                    $categories = [];
                    $amounts = []; 
                    
                    while($row = $expense_result->fetch_assoc()) {
                        $total_spending += $row['amount'];
                        $current_balance -= $row['amount'];

                        
                        $categories[] = $row['category_name'];
                        $amounts[] = $row['amount'];

                        echo '
                            <tr>
                                <td>' . $row['date'] . '</td>
                                <td>' . $row['category_name'] . '</td>
                                <td>' . $row['amount'] . '</td>  
                                <td>'. $row['description'] .'</td>
                                <td>'. $current_balance . '</td>
                            </tr>';
                    }

                    // Display total spending and monthly budget
                    echo '<div class="container3">';
                    $month_name = date("F", mktime(0, 0, 0, $month, 10));
                    echo '<h2 class="spending"> Month: '. $month_name . '</h2>';
                    echo '<h2 class="spending"> Monthly Budget: '. '£'. $monthly_budget . '</h2>';
                    echo '<h2 class="spending">Total Spending: ' . '£'. $total_spending . '</h2>';
                    echo '</div>';
                } 
        ?>
        </tbody>
    </table>
    <div class="container2 mt-4 text-center">
        <canvas id="myChart"></canvas>
    </div>
    <?php

        $expense_query = "SELECT SUM(e.amount) AS total_amount, ec.category_name
        FROM expense AS e
        INNER JOIN expense_category AS ec ON e.category_id = ec.category_id
        INNER JOIN account AS a ON e.account_id = a.account_id
        WHERE a.username = ? AND MONTH(e.date) = ?
        GROUP BY ec.category_name";

        $expense_statement = $conn->prepare($expense_query);
        $expense_statement->bind_param("ss", $username, $month);
        $expense_statement->execute();
        $expense_result = $expense_statement->get_result();
        
        $categories_group = array(); 
        $amounts_group = array(); 
        while ($row = $expense_result->fetch_assoc()) {
            $categories_group[] = $row['category_name'];
            $amounts_group[] = $row['total_amount'];
        }
        
        //for pie chart
        echo '<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>';
        echo '<script>';
        echo 'var ctx = document.getElementById("myChart").getContext("2d");';
        echo 'var myChart = new Chart(ctx, {';
        echo 'type: "pie",';
        echo 'data: {';
        echo 'labels: ' . json_encode($categories_group) . ','; 
        echo 'datasets: [{';
        echo 'label: "Total Spending by Category",';
        echo 'data: ' . json_encode($amounts_group) . ','; 
        echo 'backgroundColor: [';
        // colours
        for ($i = 0; $i < count($categories); $i++) {
            echo '"' . sprintf('#%06X', mt_rand(0, 0xFFFFFF)) . '",';
        }
        echo ']';
        echo '}],';
        echo '},';
        echo 'options: {';
        echo 'legend: { display: true },';
        echo '}';
        echo '});';
        echo '</script>';
        ?>
    <?php
    } else {
        echo '<tr><td colspan="5">No expenses found for the selected month.</td></tr>';
    }
} else {
    echo '<tr><td colspan="5">No budget found for the selected month.</td></tr>';
}

?>
        </tbody>
    </table>
</div>
</div>

</body>
</html>
