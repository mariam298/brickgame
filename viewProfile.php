<?php
session_start();
$rid = $_SESSION['rid'];
include "./connection.php";
$qry = "SELECT * FROM `registration` WHERE `rid`='$rid'";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_array($res);
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

        .menu {
            width: 100%;
            height: 10vh;
            background-color: #000;
            color: #fff;
            text-align: center;
        }

        .nav {
            padding-top: 3vh;
            margin: auto;
            width: 25%;
            display: flex;
            justify-content: space-around;
        }

        .nav a {
            color: #000;
            text-decoration: none;
            background-color: #fff;
            padding: 10px;
            border-radius: 7px;
        }
    </style>
</head>

<body class="">
    <div class="menu">
        <div class="nav">
            <a href="viewHighScores.php">High Score</a>
            <a href="game.php">Game</a>
            <a href="index.php">Logout</a>
        </div>
    </div>
    <div class="form col-4 text-center container-fluid" style="margin:auto; text-align:center">
        <form method="post" class="forForm container-fluid">
            <div class="row mt-5">
                <div class="col-12">
                    <h1>Profile</h1>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <input type="text" class="form-control" placeholder="Name" value="<?php echo $row['name'] ?>" name="name" id="">
                </div>
                <div class="col-6">
                    <input type="text" class="form-control" placeholder="Email" value="<?php echo $row['email'] ?>" name="email" id="">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <input type="text" class="form-control" placeholder="Phone" value="<?php echo $row['phone'] ?>" name="phone" id="">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <input type="password" class="form-control" placeholder="Password" value="<?php echo $row['password'] ?>" name="pass" oninput="passCheck(this.value)" id="pass">
                </div>
                <div class="col-6">
                    <input type="password" class="form-control" placeholder="Confirm Password" name="cPass" oninput="passCheck(this.value)" id="cPass">
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-12" style="display: none;" id="passMsgDiv">
                    <p class="text-center text-warning">Password Dosen't Match..</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <input type="submit" name="submit" class="form-control btn btn-primary" value="Update" id="subBtn">
                </div>
            </div>
        </form>
    </div>

    <?php
    include "./connection.php";
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pass = $_POST['pass'];
        $cPass = $_POST['cPass'];

        $qry = "UPDATE `registration` SET `name`='$name',`email`='$email',`phone`='$phone',`password`='$pass' WHERE `rid`='$rid'";
        if (mysqli_query($con, $qry) == TRUE) {
            echo "<script>alert('Profile Updated');location='viewProfile.php'</script>";
        }
    }

    ?>

    <script>
        function passCheck(p) {
            let passw = document.getElementById('pass').value
            let cPassw = document.getElementById('cPass').value
            if (passw != cPassw) {
                document.getElementById('passMsgDiv').style.display = 'block'
                document.getElementById('subBtn').disabled = true

            } else {
                document.getElementById('passMsgDiv').style.display = 'none'
                document.getElementById('subBtn').disabled = false
            }
        }
    </script>

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>