<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Header</title>
    <style>
        .banner {
            display: flex;
            justify-content: center;
            padding: 20px;
            background-color: #1B0000;
            
        }
        .banner li {
            list-style-type: none;
            margin: 0 10px;
            list-style-type: none;
            margin: 0 10px;
            border-right: 1px solid gold;
            padding-right: 5px;
        }
        .banner li a {
            text-decoration: none;
            color: gold; 
            font-weight: bold;
            align-items:center; 
        }
        h1{
            margin:auto;
            color:gold;
            padding:10px;
            background-color:#1B0000;
            display:flex;
            justify-content:center;
            border-bottom: solid gold 3px;
        }
    </style>
</head>
<body>

<div>
    <h1>BUDGET TRACKER</h1>
</div>

<div class="banner">
    <li><a href="dashboard.php">Dashboard</a></li>
    <li><a href="profile.php">Profile</a></li>
    <li><a href="expense.php">Expense</a></li>
    <li><a href="monthly_budget.php">Monthly Budget</a></li>
    <li><a href="total_spending.php">Total Spending</a></li>
    <li><a href="goal.php">Goal</a></li>
    <li><a href="investment.php">Investment</a></li>
</div>

</body>
</html>
