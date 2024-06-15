<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .user{
            margin:auto;
            justify-content:center;
            display:flex;
            padding:15px;
            border-radius:10px;
            background-color:beige;
        }
        .logout{
            display:flex;
            justify-content:center;
            border-radius:20px;
            width:15%;
            background-color:beige;
            margin-top:10px;
            margin-left:5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin:15px;

        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #333;
            color: #fff; 
            cursor: pointer;
        }
        th:hover {
            background-color: #555; 
        }
        .user {
            margin:auto;
            justify-content:left;
            display:flex;
            padding:15px;
            border-radius:20px;
            background-color: beige;
            display:flex;
            justify-content:center;
            width:25%;
            margin-top:10px;
            margin-bottom:10px;
            
        }
        .logout {
            display:flex;
            justify-content:center;
            border-radius:20px;
            width:10%;
            padding:5px;
            background-color: beige;
            margin-top:10px;
            margin-left:5px;
            display:flex;
        }
        form{
            display:flex;
            justify-content:center;
        }
        td{
         cursor:pointer;
         background-color:beige;
         border-bottom:2px solid black;
        }
        
    </style>
     <?php
    include 'includes/header.php';
    ?>
</head>
<body>
   
    <h2 class="user">User Profile</h2>
    <div>
        <?php 
            include('includes/profile_details.php');
        ?>
        <table>
            <tr>
                <th>Username</th>
                <td><?php echo $user['username']; ?></td>
            </tr>
            <tr>
                <th>First Name</th>
                <td><?php echo $user['First_Name']; ?></td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td><?php echo $user['Last_Name']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $user['email']; ?></td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td><?php echo $user['dob']; ?></td>
            </tr>
        </table>
    </div>

    <form action="includes/logout.php" method="post">
        <button type="submit" class="logout">Logout</button>
    </form>


  
</body>
</html>

