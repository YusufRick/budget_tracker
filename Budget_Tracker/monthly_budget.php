<!DOCTYPE html>
<?php
include('includes/config.php');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Budget</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        .mt-3{
            text-align:center;
        }
    </style>
</head>
<body>

<?php
session_start();

$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;


if (!isset($conn)) {
    die("Database connection is not properly configured.");
}
?>

<?php
include 'includes/header.php';
?>

<div class="container mt-4">
    <form action="includes/monthly_budget.add.php" method="post">
        <div class="row g-3">
            <div class="col-sm-6">
                <select name="month" class="form-control" required>
                    <option value="">Month</option>
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
            </div>
            <div class="col-sm-6">
                <input type="text" name="budget" class="form-control" placeholder="Budget" required>
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">ADD</button>
        </div>
    </form>
</div>

<div class="container mt-4">
    <h2 class="text-center"> Monthly Budget</h2>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Month</th>
                <th>Budget</th>
                <th>DELETE</th>
            </tr>
        </thead>
        <tbody>

        <?php

            $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

            // $sql = "SELECT account_id FROM monthly budget WHERE username = ?";



            // $stmt = $conn->prepare($sql);
            // $stmt->bind_param("s", $username);
        
            // // Execute query
            // $stmt->execute();
        
            // // Get result
            // $result = $stmt->get_result();
        
            // // Check if any row is returned
            // if ($result->num_rows > 0) {
            //     // Fetch row
            //     $row = $result->fetch_assoc();
            //     // Print account ID
            //     echo "Account ID: " . $row["account_id"];
            // } else {
            //     // Username not found
            //     echo "No account found for username: $username";
            // }
            if ($username) {
                $query = "SELECT i.budget_id,i.account_id,i.month, i.budget
                        FROM monthly_budget AS i 
                        INNER JOIN account AS a ON i.account_id = a.account_id 
                        WHERE a.username = ?";

                $statement = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($statement, "s", $username);
                mysqli_stmt_execute($statement);
                $result = mysqli_stmt_get_result($statement);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $month_name = date("F", mktime(0, 0, 0, $row['month'], 10));
                        
                        echo '
                            <tr>
                                <td>' . $month_name . '</td>
                                <td>' . $row['budget'] . '</td>
                                <td>
                                <form action="includes/monthly_budget.delete.php" method="post">
                                <input type="hidden" name="budget_id" value="' . $row['budget_id'] . '">
                                <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                </td>
                            </tr>';
                    }
                } else {
                    echo "<tr><td colspan='6'>No details found.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Username not found in session.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
