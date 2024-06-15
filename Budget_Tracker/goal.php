<!DOCTYPE html>
<?php
session_start();
include('includes/config.php');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2024 Goal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
include 'includes/header.php';
?>

<div class="container mt-4">
    <form action="includes/goal.add.php" method="post">
        <div class="row g-3 align-items-center">
        <h5 for="goal" class="form-label"><strong>Set Your Goal</strong></h5>
            <div class="col-md-6">
                <input type="text" name="goal" class="form-control" id="goal" placeholder="2024 goal" required>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">ADD</button>
            </div>
        </div>
    </form>
</div>

<div class="container mt-4">
    <h2 class="text-center">2024 GOAL</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>2024 Goal</th>
                    <th>Monthly Savings</th>
                    <th>DELETE</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
                if ($username) {
                    $query = "SELECT i.goal_id, i.account_id, i.monthly_savings, i.`2024_goal`
                            FROM goal AS i 
                            INNER JOIN account AS a ON i.account_id = a.account_id 
                            WHERE a.username = ?";
                    $statement = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($statement, "s", $username);
                    mysqli_stmt_execute($statement);
                    $result = mysqli_stmt_get_result($statement);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '
                                <tr>
                                    <td>' . $row['2024_goal'] . '</td>
                                    <td>' . $row['monthly_savings'] . '</td>
                                    <td>
                                        <form action="includes/goal.delete.php" method="post">
                                            <input type="hidden" name="goal_id" value="' . $row['goal_id'] . '">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>';
                        }
                    } else {
                        echo "<tr><td colspan='3'>No details found.</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Username not found in session.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

