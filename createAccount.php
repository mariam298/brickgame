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
                    <h1>SignUp Here</h1>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <input type="text" class="form-control" placeholder="Name" name="name" id="">
                </div>
                <div class="col-6">
                    <input type="text" class="form-control" placeholder="Email" name="email" id="">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <input type="text" class="form-control" placeholder="Phone" name="phone" id="">
                </div>
                <div class="col-6">
                    <input type="date" class="form-control" title="Date of Birth" name="dob" id="">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <input type="password" class="form-control" placeholder="Password" name="pass" oninput="passCheck(this.value)" id="pass">
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
                    <input type="submit" name="submit" class="form-control btn btn-primary" value="Register" id="subBtn">
                    <p class="mt-3 text-light">Already have an account? <a href="index.php">Sign In</a></p>
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
        $dob = $_POST['dob'];
        $pass = $_POST['pass'];
        $cPass = $_POST['cPass'];

        $qry = "SELECT COUNT(*) FROM `registration` WHERE `email`='$email'";
        $res = mysqli_query($con, $qry);
        $row = mysqli_fetch_array($res);
        $count = $row[0];
        if ($count > 0) {
            echo "<script>alert('User already exists')</script>";
        } else {
            $qryIns = "INSERT INTO `registration`(`name`,`email`,`phone`,`dob`,`password`) VALUES ('$name','$email','$phone','$dob','$pass')";
            if (mysqli_query($con, $qryIns) == TRUE) {
                echo "<script>alert('Registration Successful');location='index.php'</script>";
            }
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