<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <title>Login</title>
</head>

<style>
    .title{
        display:flex;
        justify-content:center;
        background-color:black;
        color:white;
        font-weight:bold;
        padding:20px;
    }

</style>
<body>
    <h1 class="title">BUDGET TRACKER</h1>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h2 class="text-center">Login</h2>
                    </div>
                    <div class="card-body">
                        <form action="includes/login.php" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-secondary" name="login">Login</button>
                            </div>
                        </form>
                        <p> Doesn't have an account? <a href="registration.php">register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
