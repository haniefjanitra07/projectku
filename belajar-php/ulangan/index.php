<?php
session_start();
require_once 'connect.php';
if (!isset($_SESSION["login"])) {
  header('Location: login.php');
}
$username =  $_SESSION["display"]; 
$sql = "SELECT * FROM users";
$query = $conn->query($sql);
// var_dump($query);
// die;
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>App</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="index.php">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <span class="navbar-text">
              You are logged as  <strong><?= $username; ?></strong> 
            </span>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div> 
    </nav>

    <div class="container mt-5">
      <div class="row">
        <div class="col-sm-11">
           <?php if (isset($_SESSION["error"])): ?>
                 <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Error!</strong> <?= $_SESSION["error"]; ?>.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                  <?php unset($_SESSION["error"]); ?>
                <?php endif; ?>
                 <?php if (isset($_SESSION["success"])): ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> <?= $_SESSION["success"] ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <?php unset($_SESSION["success"]); ?>
                <?php endif; ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 mt-3">
          <?php 
            if (isset($_GET["update-data"])) {
              include 'update.php';
            }
            else if (isset($_GET["view-data"])) {
              include 'view.php';
            }
            else{
              include 'register.php';
            }
           ?>
        </div>
        <div class="col-md-7 mt-3">
          <div class="card">
            <div class="card-header bg-primary">
                <p class="lead text-white mb-0">Manage Data</p>
            </div>
            <div class="card-body">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th>Edit</th>
                    <th>Detail</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($query->num_rows > 0): ?>
                    <?php $i = 1; 
                    while ($fetch = $query->fetch_assoc()): ?>
                      <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= $fetch["username"]; ?></td>
                        <td><a href="index.php?update-data=<?= $fetch["id"]; ?>">Edit</a></td>
                        <td><a href="index.php?view-data=<?= $fetch["id"]; ?>">Detail</a></td>
                        <td><a href="delete.php?id=<?= $fetch["id"]; ?>">Delete</a></td>
                      </tr>
                    <?php endwhile ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="5" class="text-center bg-primary text-white">There is no data</td>
                      </tr>
                  <?php endif; ?>
                </tbody>
              </table>
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
    <script src="js/app.js"></script>
  </body>
</html>