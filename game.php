<?php
session_start();
include "./connection.php";
$rid = $_SESSION['rid'];
$qry = "SELECT * FROM `registration` WHERE `rid`='$rid'";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_array($res);
?>
<!DOCTYPE html>
<html lang="en=US">

<head>
    <meta charset='utf-8'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prosto+One&display=swap" rel="stylesheet">
    <title>My Game</title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }

        canvas {
            background: #404040;
            display: block;
            margin: 0 auto;
        }

        body {
            background-image: URL("./Static/images/bg2.jpg");
            background-position: absolute;
            background-size: cover;
            background-repeat: no-repeat;
            font-family: 'Prosto One', cursive;
        }

        .menu {
            width: 100%;
            height: 10vh;
            background-color: #000;
            color: #fff;
            text-align: center;
        }

        .nav {
            padding-top: 4.8vh;
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

<body>
    <div class="menu">
        <div class="nav">
            <a href="viewProfile.php">Profile</a>
            <a href="viewHighScores.php">High Score</a>
            <a href="index.php">Logout</a>
        </div>
    </div>
    <canvas id="myCanvas" width="480" height="640"></canvas>

    <script>
        const canvas = document.getElementById("myCanvas");

        const ctx = canvas.getContext("2d");



        let x = canvas.width / 2;
        let y = canvas.height - 30;
        let dx = 2;

        let dy = -2;
        const ballRadius = 10;

        var hex;
        var color = chColor();

        let score = 0;
        let tscore = <?php echo $_SESSION['score'] ?>;

        let lives = <?php echo $_SESSION['lives'] ?>;

        const paddleHeight = 10;
        const paddleWidth = 75;
        let paddleX = (canvas.width - paddleWidth) / 2;

        let rightPressed = false;
        let leftPressed = false;

        const brickRowCount = 5;
        const brickColumnCount = 5;
        const brickWidth = 75;
        const brickHeight = 20;
        const brickPadding = 10;
        const brickOffsetTop = 30;
        const brickOffsetLeft = 30;

        const bricks = [];
        for (let c = 0; c < brickColumnCount; c++) {

            bricks[c] = [];

            for (let r = 0; r < brickRowCount; r++) {

                bricks[c][r] = {
                    x: 0,
                    y: 0,
                    status: 1
                };
            }
        }




        function convertToColor(num) {

            return '#' + ('00000' + (num | 0).toString(16)).substr(-6)
        }

        function chColor() {

            number = Math.floor(Math.random() * 100000 + 1);
            color = convertToColor(number);
            return color;
        }


        function drawBall() {

            ctx.beginPath();
            ctx.arc(x, y, ballRadius, 0, Math.PI * 2);
            ctx.fillStyle = color;
            ctx.fill();
            ctx.strokeStyle = "#ffffff";
            ctx.stroke();
            ctx.closePath();

        }

        function drawPaddle() {

            ctx.beginPath();
            ctx.rect(paddleX, canvas.height - paddleHeight, paddleWidth, paddleHeight);
            ctx.fillStyle = "orange";
            ctx.fill();
            ctx.closePath();
        }

        function draw() {

            ctx.clearRect(0, 0, canvas.width, canvas.height);
            drawBricks();
            drawBall();
            drawPaddle();
            drawScore();
            drawUser();
            drawLives();
            collisionDetection();


            if (y + dy < ballRadius) {

                color = chColor();
                dy = -dy;

            } else if (y + dy > canvas.height - ballRadius) {

                if (x > paddleX && x < paddleX + paddleWidth) {

                    dy = -dy;

                } else {

                    lives--;
                    if (!lives) {

                        alert("GAME OVER");
                        document.location = `gameOver.php?score=${tscore}&end=yes&lives=${lives}`;
                        clearInterval(interval);

                    } else {
                        x = canvas.width / 2;
                        y = canvas.height - 30;
                        dx = 2;
                        dy = -2;
                        paddleX = (canvas.width - paddleWidth) / 2;
                    }



                }
            }

            if (x + dx > canvas.width - ballRadius || x + dx < ballRadius) {

                color = chColor();
                dx = -dx;

            }


            if (rightPressed) {

                paddleX = Math.min(paddleX + 7, canvas.width - paddleWidth);

            } else if (leftPressed) {

                paddleX = Math.max(paddleX - 7, 0);
            }

            x += dx;
            y += dy;
            requestAnimationFrame(draw);
        }



        document.addEventListener("keydown", keyDownHandler, false);
        document.addEventListener("keyup", keyUpHandler, false);
        document.addEventListener("mousemove", mouseMoveHandler, false);


        function mouseMoveHandler(e) {

            const relativeX = e.clientX - canvas.offsetLeft;
            if (relativeX > 0 && relativeX < canvas.width) {

                paddleX = relativeX - paddleWidth / 2;
            }
        }

        function keyDownHandler(e) {

            if (e.key === "Right" || e.key === "ArrowRight") {

                rightPressed = true;

            } else if (e.key === "Left" || e.key === "ArrowLeft") {

                leftPressed = true;
            }
        }

        function keyUpHandler(e) {

            if (e.key === "Right" || e.key === "ArrowRight") {

                rightPressed = false;

            } else if (e.key === "Left" || e.key === "ArrowLeft") {

                leftPressed = false;
            }

        }

        function collisionDetection() {

            for (let c = 0; c < brickColumnCount; c++) {

                for (let r = 0; r < brickRowCount; r++) {

                    const b = bricks[c][r];

                    if (b.status === 1) {

                        if (x > b.x && x < b.x + brickWidth && y > b.y && y < b.y + brickHeight) {

                            dy = -dy;
                            b.status = 0;
                            score++;
                            tscore++;

                            if (score === brickRowCount * brickColumnCount) {

                                alert("Level Cleared");
                                document.location = `gameOver.php?score=${tscore}&end=no&lives=${lives}`;
                                clearInterval(interval);
                                // document.location.reload();
                            }
                        }
                    }
                }
            }
        }

        function drawScore() {

            ctx.font = "16px Arial";
            ctx.fillStyle = "#0095DD";
            ctx.fillText(`Score: ${tscore}`, 8, 20);
        }

        function drawUser() {

            ctx.font = "16px Arial";
            ctx.fillStyle = "#0095DD";
            ctx.fillText(`<?php echo "$row[name]($row[score])" ?>`, 225, 20);
        }


        function drawLives() {

            ctx.font = "16px Arial";
            ctx.fillStyle = "#0095DD";
            ctx.fillText(`Lives: ${lives}`, canvas.width - 65, 20);
        }

        function drawBricks() {

            for (let c = 0; c < brickColumnCount; c++) {
                for (let r = 0; r < brickRowCount; r++) {
                    if (bricks[c][r].status === 1) {
                        const brickX = c * (brickWidth + brickPadding) + brickOffsetLeft;
                        const brickY = r * (brickHeight + brickPadding) + brickOffsetTop;
                        bricks[c][r].x = brickX;
                        bricks[c][r].y = brickY;
                        ctx.beginPath();
                        ctx.rect(brickX, brickY, brickWidth, brickHeight);
                        ctx.fillStyle = "red";
                        ctx.fill();
                        ctx.closePath();
                    }
                }
            }
        }



        draw();
    </script>

</body>

</html>