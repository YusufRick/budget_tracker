<?php
    session_start();
    include 'config.php';
    
    if(isset($_SESSION['username']) && isset($_POST['month'])) {
        $username = $_SESSION['username'];
        $month = $_POST['month']; 
        
        $expense_query = "SELECT e.date, ec.category_name, e.amount, e.description 
                          FROM expense AS e
                          INNER JOIN expense_category AS ec ON e.category_id = ec.category_id
                          INNER JOIN account AS a ON e.account_id = a.account_id
                          WHERE a.username = ? AND MONTH(e.date) = ?";
        $expense_statement = mysqli_prepare($conn, $expense_query);
        mysqli_stmt_bind_param($expense_statement, "ss", $username, $month);
        mysqli_stmt_execute($expense_statement);
        $expense_result = mysqli_stmt_get_result($expense_statement);
        
        // Output expenses
        if ($expense_result && mysqli_num_rows($expense_result) > 0) {
            echo '
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>';
            while($row = mysqli_fetch_assoc($expense_result)) {
                echo '
                        <tr>
                            <td>' . $row['date'] . '</td>
                            <td>' . $row['category_name'] . '</td>
                            <td>' . $row['amount'] . '</td>  
                            <td>' . $row['description'] . '</td>
                        </tr>';
            }
            echo '
                    </tbody>
                </table>';
        } else {
            echo '<p>No expenses found for the selected month.</p>';
        }
    } else {
        echo '<p>Username not found or month not selected.</p>';
    }
?>
