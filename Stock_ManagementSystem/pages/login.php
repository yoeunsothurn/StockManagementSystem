<?php require('session.php'); ?>
<?php if(logged_in()){ ?>
    <script type="text/javascript">
        window.location = "index.php";
    </script>
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Stock Control Management System</title>
    <link rel="icon" href="https://www.freeiconspng.com/uploads/sales-icon-7.png">

    <!-- Custom fonts and styles -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right,rgb(245, 245, 245),rgb(8, 147, 233));
        }
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .login-header {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4e73df;
        }
        .btn-primary {
            background-color: #4e73df;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            padding: 10px;
        }
        .btn-primary:hover {
            background-color: #2e59d9;
        }
        .form-control {
            border-radius: 25px;
        }
        .custom-checkbox .custom-control-label::before {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="col-lg-5">
            <div class="card o-hidden border-0 shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center">
                        <h1 class="login-header">Welcome Back!</h1>
                    </div>
                    <form class="user" action="processlogin.php" method="post">
                        <div class="form-group">
                            <input class="form-control form-control-user" placeholder="Username" name="user" type="text" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-user" placeholder="Password" name="password" type="password">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox small">
                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-user btn-block" type="submit" name="btnlogin">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
</body>
</html>
