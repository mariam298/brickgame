<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prosto+One&display=swap" rel="stylesheet">
    <title>Brick Game</title>
    <style>
        body {
            background-image: URL("./Static/images/bg.png");
            background-position: absolute;
            background-size: cover;
            background-repeat: no-repeat;
            font-family: 'Prosto One', cursive;
        }

        .forForm {
            margin-top: 25vh;
        }

        h1 {
            color: yellow;

        }
    </style>
</head>

<body class="container-fluid">
    <div class="form col-4 text-center" style="margin:auto; text-align:center">
        <form method="post" class="forForm">
            <div class="row mt-5">
                <div class="col-12">
                    <h1>LogIn Here</h1>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <input type="text" class="form-control" placeholder="Username" name="uname" id="">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <input type="password" class="form-control" placeholder="Password" name="pass" id="">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <input type="submit" name="submit" class="form-control btn btn-primary" value="login" id="">
                    <p class="mt-3 text-light">Don't have an account? <a href="createAccount.php">Sign up</a></p>
                </div>
            </div>
        </form>
    </div>

    <?php
    include "./connection.php";
    if (isset($_POST['submit'])) {
        $uname = $_POST['uname'];
        $pass = $_POST['pass'];

        $qry = "SELECT * FROM `registration` WHERE `email`='$uname'";
        $res = mysqli_query($con, $qry);
        $row = mysqli_fetch_array($res);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            if ($row['password'] == $pass) {
                $_SESSION['rid'] = $row['rid'];
                $_SESSION['score'] = 0;
                $_SESSION['lives'] = 3;
                echo "<script>location='game.php'</script>";
            } else {
                echo "<script>alert('Password Dosent Match..');location='index.php'</script>";
            }
        } else {
            echo "<script>alert('User dosent exists')</script>";
        }
    }

    ?>



    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>