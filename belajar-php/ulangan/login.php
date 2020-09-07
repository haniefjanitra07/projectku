<?php
session_start();
if (isset($_SESSION["login"])) {
  header('location: index.php');
}
    if( isset($_POST["submit"]) ){
       require_once 'connect.php'; 
        $username = strtolower(trim(strip_tags($_POST["username"])));
        $password = strip_tags(trim($conn->real_escape_string($_POST["password"])));

        $query = $conn->query("SELECT * FROM users WHERE username = '$username'")->fetch_assoc();
        if ($username == $query["username"]) {
            if (password_verify($password, $query["password"])) {
              $_SESSION["login"] = "Success to login";
              $_SESSION["display"] = $query["username"];
              header('Location: index.php');
            }
            else{
              $_SESSION["password"] = "Password is Wrong!";
            }
        } 
        if ($username !== $query["username"]) {
            $_SESSION["username"] = "Username is Wrong!";
        }

    }



?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>

  <style>
    .h-100{
        margin-top: 100px;
    }
  </style>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="index.php">App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="login.php">Login</a>
            </li>
          </ul>
        </div>
      </div> 
    </nav>

  <div class="container mt-3 h-100">
    <div class="row justify-content-center">
        <div class="col-4">
          <div class="card">
            <div class="card-header">
              <p class="lead mb-0">Login</p>
            </div>
            <div class="card-body">
              <form action="" method="post">
              <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control <?= isset($_SESSION["username"]) ? 'is-invalid' : '' ?>" id="username" name="username" placeholder="Enter Username">
                  <?php if(isset($_SESSION["username"])) :?>
                  <small id="wrong" class="form-text text-danger"><?= $_SESSION["username"]; ?></small>
                  <?php
                      session_unset();
                  ?>
                  <?php endif;?>
              </div>
              <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control <?= isset($_SESSION["password"])  ? 'is-invalid':'' ?>" id="password" name="password" placeholder="Password">
                  <?php if(isset($_SESSION["password"])) :?>
                  <small id="wrong" class="form-text text-danger"><?= $_SESSION["password"]; ?></small>
                  <?php
                      session_unset();
                  ?>
                  <?php endif;?>
              </div>
              <button type="submit" class="btn btn-primary" name="submit">Submit</button>
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>