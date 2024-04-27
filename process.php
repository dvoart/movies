<?php
session_start();
if(!isset($_POST['addmovie'])){
header("Location: index.php");
}

include 'db.php';

$sql = "INSERT INTO movies (movie_title, movie_genre)
VALUES ('{$_POST['movie_title']}', '{$_POST['movie_genre']}')";
//test before putting into database
//echo $sql;die;
if (mysqli_query($conn, $sql)) {
$_SESSION['message'] = 'movieadded';
header("Location: index.php"); //redirecting if successful
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>