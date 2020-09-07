<?php
include 'connection.php';
    if (isset($_POST["tambahjurusan"])) {
        $nama_jurusan = trim(strip_tags($_POST["nama_jurusan"]));

        if (empty($nama_jurusan)) {
            $_SESSION['jurusan'] = 'Kolom jurusan harus diisi!';
            header('Location: index.php?jurusan');
            return false;
        }

        $sqlTambahJurusan = "INSERT INTO jurusan VALUES ('', '$nama_jurusan')";
        $queryJurusan = $connect->query($sqlTambahJurusan); 
        $_SESSION['message'] =  "<strong>Berhasil!</strong> Ditambah";
        header('Location: index.php?jurusan');
    }

    if (isset($_GET['uj-id']) || isset($_GET['dj-id'])) {
        if (isset($_GET['uj-id'])) {
            $id = $_GET['uj-id'];
        }
        else if (isset($_GET['dj-id'])){
            $id = $_GET['dj-id'];
            
        }

       $sqlViewJurusan = "SELECT * FROM jurusan WHERE id = '$id'";
       $queyViewJurusan = $connect->query($sqlViewJurusan)->fetch_assoc();
       $nama_jurusan = $queyViewJurusan["nama_jurusan"];
       
       if (isset($_POST["ubahjurusan"])) {
           $nama_jurusan = trim(strip_tags($_POST["nama_jurusan"]));
           $id = $_POST['id_jurusan'];
           
           
          if (empty($nama_jurusan)) {
            $_SESSION['jurusan'] = 'Kolom jurusan harus diisi!';
            header('Location: index.php?uj-id=' . $id);
            return false;
            }
            else{
                $sqlUbahJurusan = "UPDATE jurusan SET id = '$id',
                                     nama_jurusan = '$nama_jurusan'
                                     WHERE id = '$id'
                                    ";
                $queryUbahJurusan = $connect->query($sqlUbahJurusan); 
                $_SESSION['message'] =  "#".  $id ." <strong>Berhasil!</strong> Diubah";
                header('Location: index.php?jurusan');
            }

        }


    }


?>
 <div class="card">
                    <div class="card-header bg-primary">
                        <?php if (isset($_GET['uj-id']) ) : ?>
                        <h5 class="mb-0 text-light">Ubah Jurusan</h5>
                        <?php elseif (isset($_GET['dj-id'])) : ?>
                        <h5 class="mb-0 text-light">Detail Jurusan</h5>
                        <?php else : ?>
                        <h5 class="mb-0 text-light">Tambah Jurusan</h5>
                        <?php endif;?>
                    </div>
                    <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="jurusan">Nama Jurusan</label>
                            <input type="hidden" id='id' value="<?=  isset($_GET['uj-id']) || isset($_GET['dj-id']) ? $queyViewJurusan['id'] : ''?> " name="id_jurusan">
                            <input type="text" class="form-control <?= isset($_SESSION['jurusan']) ? 'is-invalid' : ''?>" id="jurusan" value="<?= isset($_GET['uj-id']) || isset($_GET['dj-id']) ? $queyViewJurusan['nama_jurusan'] : ''?>" name="nama_jurusan" <?= 
                            isset($_GET['dj-id']) ? 'readonly' : '' ?>>
                            <?php if (isset($_SESSION['jurusan'])) :?>
                            <small class="text-danger"><?= $_SESSION['jurusan']; ?></small>
                            <?php unset($_SESSION['jurusan']);
                             endif;?>
                        </div>
                          <?php if(!isset($_GET['jurusan'])) : ?> 
                            <div class="form-group mb-0 float-right mt-3">
                                <a href="index.php?jurusan" class="text-danger float-right mb-0">Back</a>    
                            </div>
                          <?php endif; ?>      
                            <?php if (isset($_GET['uj-id']) ) : ?>
                            <button type="submit" class="btn btn-primary mb-0 text-light" name="ubahjurusan">Ubah!</button>
                            <?php elseif (isset($_GET['jurusan'])): ?>
                            <button type="submit" class="btn btn-primary mb-0 text-light" name="tambahjurusan">Tambah!</button>
                            <?php endif;?>
                    </form>
                    </div>
                </div>