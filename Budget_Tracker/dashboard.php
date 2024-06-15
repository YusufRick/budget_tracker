<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78D1cv7wBOj3h/tz9M2Wen9mPcHzdjXu7xnyYBKSX5SxL8+Y0V0+vo7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Dashboard</title>
    <style>
        .icon-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content:space-evenly;
            margin-bottom: 20px;
        }

        .icon {
            font-size: 40px; 
        }

        .container{
        
            display:flex;
            justify-content:space-around;
            background-color:beige;
            flex-direction:column;
            align-content:space-around;
            flex-wrap:wrap;
        }
        .container div{
            width:33%;
            margin-top:20px;

            
        }
        .welcome{
            display:flex;
            justify-content:center;
            background-color:#1B0000;
            color:gold;
            margin:0;
            padding:20px;
        }

        a.logout{
            display:flex;
            justify-content:center;
            border-radius:25px;
            background-color:#1B0000;
            color:gold;
            width: 10%;
            padding:5px;
            margin:auto;
            margin-top:15px;
        }
        .budget{
            display:flex;
            justify-content:center;
            color:gold;
            background-color:#1B0000;
            padding:10px;
            font-weight:bold;
            margin:0;
            border-bottom: solid gold 3px;
        }
        body{
            margin:0;
        }
        .container div{
            display:flex;
            flex-wrap:wrap;
        }

    </style>
</head>
<body>
        <?php 
            include('includes/profile_details.php'); 
        ?>

     <h1 class="budget">BUDGET TRACKER</h1>
    <h2 class="welcome">Welcome, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'test'; ?></h2>

    <div class="container">
        <div>
            <div class="icon-container">
                <a href="profile.php"><i class="bi bi-person-circle icon"></i></a>
                <label>Profile</label>
            </div>
            <div class="icon-container">
                <a href="expense.php"><i class="bi bi-bar-chart-fill icon"></i></a>
                <label>Expense</label>
            </div>
            <div class="icon-container">
                <a href="monthly_budget.php"><i class="bi bi-bank icon"></i></a>
                <label>Monthly Budget</label>
            </div>
        </div>

        <div>

            <div class="icon-container">
                <a href="total_spending.php"><i class="bi bi-cash icon"></i></a>
                <label>Total Spending</label>
            </div>
            <div class="icon-container">
                <a href="goal.php"><i class="bi bi-trophy-fill icon"></i></a>
                <label>Goal</label>
            </div>
            <div class="icon-container">
                <a href="investment.php"><i class="bi bi-currency-pound icon"></i></a>
                <label>Investment</label>
            </div>
        </div>
    </div>
    
    <a class="logout" href="includes/logout.php">Logout</a>
</body>
</html>
