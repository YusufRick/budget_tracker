<!DOCTYPE html>
<?php
include 'includes/login.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST["username"];
    $_SESSION['username'] = $username;
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <title>Expense</title>
    <style>
        .expense-heading {
            text-align: center;
            padding: 10px;
            margin: auto;
        }

        .add-button {
            text-align: center;
        }
    </style>
</head>
<body>

<?php
include 'includes/header.php';
?>

<div class="container mt-4">
    <h2 class="expense-heading">Expense</h2>
    <form action="includes/expense.add.php" method="post">
        <div class="row g-3">
            <div class="col-sm-6">
                <input type="text" name="date" class="form-control" id="datepicker" placeholder="Date" required>
            </div>
            <div class="col-sm-6">
                <select name="category" class="form-control" required>
                    <option value="">Select Category</option>
                    <?php
                    $sql = "SELECT * FROM expense_category";
                    $result = mysqli_query($conn, $sql);
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['category_Name'] . "'>" . $row['category_Name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-sm-6">
                <input type="text" name="amount" class="form-control" placeholder="Amount" required>
            </div>
            <div class="col-sm-6">
                <input type="text" name="description" class="form-control" placeholder="Description">
            </div>
        </div>
        <div class="add-button">
            <button type="submit" class="btn btn-primary mt-3">ADD</button>
        </div>
    </form>
</div>

<div class="container">
    <h2 class="expense-heading">Expense Details</h2>
    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>Date</th>
            <th>Category</th>
            <th>Amount</th>
            <th>Description</th>
            <th>DELETE</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $query = "SELECT e.expense_id, e.date, ec.category_name, e.amount, e.description 
                    FROM expense AS e
                    INNER JOIN expense_category AS ec ON e.category_id = ec.category_id
                    INNER JOIN account AS a ON e.account_id = a.account_id
                    WHERE a.username = ?";
            $statement = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($statement, "s", $username);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);

            // Output expenses
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                    <tr>
                        <td>' . $row['date'] . '</td>
                        <td>' . $row['category_name'] . '</td>
                        <td>' . $row['amount'] . '</td>  
                        <td>' . $row['description'] . '</td>
                        <td>
                            <form action="includes/expense.delete.php" method="post">
                                <input type="hidden" name="expense_id" value="' . $row['expense_id'] . '">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>';
                }
            } else {
                echo "0 results found for expenses.";
            }
        } else {
            echo "Username not found or no account_id associated.";
        }
        ?>
        </tbody>
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(document).ready(function () {
        flatpickr('#datepicker', {
            dateFormat: 'Y-m-d',
            inline: false,
            time_24hr: true,
            allowInput: true,
            disableMobile: true

        });
    });
</script>

</body>
</html>
