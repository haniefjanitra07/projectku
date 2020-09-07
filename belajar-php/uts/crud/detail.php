<?php
include "connection.php";
$id = $_GET["id"];
$query = $conn->query("SELECT * FROM warna WHERE id = $id")->fetch_assoc();


if( isset($_POST["submit"]) ){
  $nama = htmlspecialchars($_POST["nama"]);

  $query = "UPDATE warna SET nama_warna = '$nama' WHERE id = $id";

  $conn->query($query);

  if( mysqli_affected_rows($conn) > 0 ){
    echo "<script>
            alert('Berhasil diubah!');
            document.location.href = 'index.php';
          </script>";
  }
  else{
    echo "<script>
            alert('Gagal diubah!');
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

    <title>Detail Warna <?= $query["nama_warna"];?></title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-6">
          <div class="card bg-dark text-white">
          <h5 class="card-title mt-3 text-center">Warna <span style="color: <?= $query["nama_warna"]?>;" class="font-weight-bold"><?= $query["nama_warna"]?></span> </h5>
            <div class="card-body">
               <table class="table table-dark">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Aksi</th>
                      <th scope="col">Nama Warna</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td> 
                         <a href="" data-toggle="modal" data-target="#formModal">Ubah</a> | 
                         <a href="hapus.php?id=<?= $id ?>">Hapus</a>
                       </td>
                      <td style="color: <?= $query["nama_warna"]?>;" class="font-weight-bold"
                      
                      ><?= $query["nama_warna"]?></td>
                    </tr>
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <form action="" method="post">
      <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ubah Warna</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="nama">Nama Warna</label>
                <input type="text" name="nama" class="form-control" id="nama" aria-describedby="emailHelp" placeholder="lightskyblue" value="<?= $query["nama_warna"]?>" Required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="submit">Ubah Warna!</button>
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