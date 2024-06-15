<!DOCTYPE html>
<?php
include('includes/config.php');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <style>
        h2{
            font-size:x-large;
            background-color:maroon;
            border-radius:20px;
            color:white;
            width:25%;
            margin:auto;
            padding: 15px;
        }
        label{

            font-weight:bold;
        }
        div button{

            color:white;
            background-color:maroon;
            margin:auto;
            border-radius:15px;
            text-align:center;
            margin:auto;
        }
        .btn{
            text-align:center;
        }
        .title{
        display:flex;
        justify-content:center;
        background-color:black;
        color:white;
        font-weight:bold;
        padding:20px;
    }
        


    </style>
</head>
<body>

<h1 class="title">BUDGET TRACKER</h1>

<div class="container">
    
    <h2 class="text-center mb-4">Sign Up</h2>
    <form action="includes/add.php" method="post">
        <div class="form-container">
        <div class="mb-3 row">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="re_enter_password" class="col-sm-2 col-form-label">Re-enter Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="re_enter_password" name="re_enter_password" placeholder="Re-enter password" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="FirstName" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="First Name" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="LastName" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="LastName" name="LastName" placeholder="Last Name" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="dob" class="col-sm-2 col-form-label">Date Of Birth</label>
            <div class="col-sm-10">
                <input type="text" class="form-control datepicker" id="dob" name="dob" placeholder="Date Of Birth" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="accountType" class="col-sm-2 col-form-label">Account Type</label>
            <div class="col-sm-10">
                <select name="accountType" id="accountType" class="form-select" required>
                    <option value="">Select account type</option>
                    <option value="student">Student</option>
                    <option value="professional">Professional</option>
                </select>
            </div>
        </div>
        </div>
        <div class="mb-3 row">
            <div class="btn">
                <button type="submit" class="button">Register</button>
            </div>
        </div>
    </form>

    <p> already have an account? <a href="login_form.php">login</a></p>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
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
