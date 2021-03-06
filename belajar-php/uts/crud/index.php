<?php
include "connection.php";
$query = $conn->query("SELECT * FROM warna");

if( isset($_POST["submit"]) ){
  $nama = htmlspecialchars($_POST["nama"]);

  $query = "INSERT INTO warna VALUES ('', '$nama')";

  $conn->query($query);

  if( mysqli_affected_rows($conn) > 0 ){
    echo "<script>
            alert('Berhasil!');
            document.location.href = 'index.php';
          </script>";
  }
  else{
    echo "<script>
            alert('Gagal!');
            document.location.href = 'index.php';
          </script>";
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
    <link rel="stylesheet" href="css/style.css">

    <title>Daftar Warna</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-6">
        <h1 class="h3">Daftar Warna</h1>
        <button type="button" class="btn btn-primary mb-3 mt-1" data-toggle="modal" data-target="#formModal">
          Tambah Warna
        </button>
            <ul class="list-group">
              <?php while ($row = $query->fetch_assoc()):?>
              <li class="list-group-item d-flex justify-content-between align-items-center"><?= $row["nama_warna"]?>
              <a href="detail.php?id=<?= $row["id"]?>"><span class="badge badge-primary badge-pill">detail</span></a>
              </li>
              <?php endwhile;?>
            </ul>
        </div>
      </div>
    </div>

    <form action="" method="post">
      <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Warna</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="nama">Nama Warna</label>
                <input type="text" name="nama" class="form-control" id="nama" aria-describedby="emailHelp" placeholder="lightskyblue" Required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="submit">Tambah Warna!</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>