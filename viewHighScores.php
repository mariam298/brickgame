<?php
session_start();
$rid = $_SESSION['rid'];
include "./connection.php";
$qry = "SELECT * FROM `registration` ORDER BY `score` DESC LIMIT 10";
$res = mysqli_query($con, $qry);
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
            margin-top: 12vh;
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
            width: 20%;
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

        ul {
            list-style: none;
        }

        ul li {
            color: #fff
        }
    </style>
</head>

<body class="">
    <div class="menu">
        <div class="nav">
            <a href="viewProfile.php">Profile</a>
            <a href="game.php">Game</a>
            <a href="index.php">Logout</a>
        </div>
    </div>
    <div class="form col-4 text-center container-fluid" style="margin:auto; text-align:center">
        <form method="post" class="forForm container-fluid">
            <div class="row mt-2">
                <div class="col-12">
                    <h1>High Score</h1>
                </div>
            </div>
            <ul>
                <?php
                while ($row = mysqli_fetch_array($res)) {
                    echo "<li>$row[name] - $row[score]</li>";
                }
                ?>
            </ul>
        </form>
    </div>

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