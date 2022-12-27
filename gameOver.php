<?php
session_start();
include "./connection.php";
$rid = $_SESSION['rid'];
$end = $_GET['end'];
$score = $_GET['score'];
$lives = $_GET['lives'];

$qryScr = "SELECT `score` FROM `registration` WHERE `rid`='$rid'";
$res = mysqli_query($con, $qryScr);
$row = mysqli_fetch_array($res);
$currentScore = $row['score'];

if ($end == 'no') {
    $_SESSION['score'] = $score;
    $_SESSION['lives'] = $lives;
    echo "<script>location='game.php'</script>";
} else {
    $qry = "INSERT INTO `points`(`rid`,`score`,`date`) VALUES ('$rid','$score',(SELECT SYSDATE()))";

    if ($currentScore < $score) {
        $qryUp = "UPDATE `registration` SET `score`='$score' WHERE `rid`='$rid'";
        if (mysqli_query($con, $qryUp) == TRUE) {
            echo "<script>alert('New High Score..')</script>";
        }
    }

    if (mysqli_query($con, $qry) == TRUE) {
        $_SESSION['score'] = 0;
        $_SESSION['lives'] = 3;
        echo "<script>location='game.php'</script>";
    }
}
