<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">


</head>
<body>

<div class="container">
<div class="row">
<div class="co-md-12">
<h1>Movies</h1>


<?php

if(isset($_SESSION['message'])){

    if($_SESSION['message'] == 'movieadded'){
    echo '<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> Movie Added.
    </div>';
    }

    if($_SESSION['message'] == 'movieupdated'){
      echo '<div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Success!</strong> Movie Updated.
      </div>';
      }

//moviedeleted
    if($_SESSION['message'] == 'moviedeleted'){
    echo '<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> Movie Deleted.
    </div>';
    }    

unset($_SESSION['message']);
}



if(isset($_POST['movie_id'])) {
  echo '<form action="updatemovie.php" method="POST">';
  echo '<input type="hidden" name ="movie_id" value="'.$_POST['movie_id'].'">';
}else {
  echo '<form action="process.php" method="POST">';
}
?>

  <div class="form-group">
    <label for="email">Title:</label>
    <input type="text" class="form-control" name="movie_title" placeholder="Enter Movie Title" 
        <?php if(isset($_POST['movie_title'])){echo 'value="'.$_POST['movie_title'].'"';} ?>>
  </div>
  <div class="form-group">
    <label>Genre:</label>
        <select name="movie_genre" class="form-control">
<?php
$movies=array("Action","Comedy","Kids and Family", "Drama","Fantasy","Horror","Mystery","Romance","Thriller","Western");


foreach($movies as $movie){
//compares post variable for genre to the current item in the array
if($movie == $_POST['movie_genre']){ 
    echo '<option value="'.$movie.'" selected>'.$movie.'</option>'; 
}else{
    echo '<option value="'.$movie.'">'.$movie.'</option>';
}
}  
?>
    </select>
  </div>

<?php
  if(isset($_POST['movie_id'])) {
  echo '<button type="submit" name="updatemovie" class="btn btn-info">Update Movie</button>';
}else {
  echo '<button type="submit" name="addmovie" class="btn btn-info">Add Movie</button>';
}
?>
  
</form>

<br><br>

<div class="img-responsive">
<table class = "table table-hover table-striped table-bordered">
<tr>
<th>ID</th>
<th>Title</th>
<th>Genre</th>
<th></th>
<th></th>
</tr>
<?php
include 'db.php';

$sql = "SELECT * FROM movies";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
  ?>
<tr>
<td><?=$row['movie_id']?></td>
<td><?=$row['movie_title']?></td>
<td><?=$row['movie_genre']?></td>
<td>
<form action="deletemovie.php" method="post">
<input type="hidden" name="movie_id" value="<?=$row['movie_id']?>">    
<button type="submit" name="deletemovie" class="btn btn-danger btn-sm">X</button>
</form>
</td>
<td>
<form action="index.php" method="post">
<input type="hidden" name="movie_id" value="<?=$row['movie_id']?>">
<input type="hidden" name="movie_title" value="<?=$row['movie_title']?>">    
<input type="hidden" name="movie_genre" value="<?=$row['movie_genre']?>">        
<button type="submit" name="editmovie" class="btn btn-success btn-sm">edit</button>

  
</td>

</form>
</td>
</tr>

<?php
  }
} else {
  echo "0 results";
}

mysqli_close($conn);
?>
</table></div>
</div>
</div>
</div>

</body>


<!--Get in the habit of putting JS to the end of the file since they can take a while to load-->
<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</html>