<?php
include 'connection.php';

    if (isset($_POST["tambahpelajaran"])) {
        $nama_mata_pelajaran = trim(strip_tags($_POST["nama_mata_pelajaran"]));

        if (empty($nama_mata_pelajaran)) {
            $_SESSION['pelajaran'] = 'Field tidak boleh kosong';
            header('Location: index.php?pelajaran');
            return false;
        }else{
            $sqlTambahPelajaran= "INSERT INTO pelajaran VALUES ('', '$nama_mata_pelajaran')";
            $_SESSION['message'] =  "<strong>Berhasil!</strong> Ditambah";
    
            $queryPelajaran= $connect->query($sqlTambahPelajaran); 
            header('Location: index.php?pelajaran');
        }

    }

    if (isset($_GET['dp-id']) || isset($_GET['up-id'])) {
        if (isset($_GET['dp-id'])) {
            $id = $_GET['dp-id'];
        }
        else if (isset($_GET['up-id'])){
            $id = $_GET['up-id'];
        }

        if (!is_numeric($id)) {
          $_SESSION['message'] = 'ID tidak valid!';
           $_SESSION['type'] = 'danger';
           header('Location: index.php?pelajaran');
           return false;
        }

       $sqlViewPelajaran= "SELECT * FROM pelajaran WHERE id = '$id'";
       $queryViewPelajaran= $connect->query($sqlViewPelajaran);


       if ($queryViewPelajaran->num_rows < 1) {
           $_SESSION['message'] = 'ID tidak ditemukan didalam database';
           $_SESSION['type'] = 'danger';
           header('Location: index.php?pelajaran');
           return false;
       }
           $fetch = $queryViewPelajaran->fetch_assoc();
           $nama_pelajaran= $fetch["nama_mata_pelajaran"];

       
       if (isset($_POST["ubahpelajaran"])) {
           $id = trim(strip_tags($_POST['id']));
           $nama_pelajaran= trim(strip_tags($_POST["nama_mata_pelajaran"]));

         if (empty($nama_pelajaran)) {
            $_SESSION['pelajaran'] = 'Field tidak boleh kosong';
            header('Location: index.php?up-id=' . $id);
            return false;
        }else{
            $sqlUbahPelajaran= "UPDATE pelajaran SET id = '$id',
                                 nama_mata_pelajaran= '$nama_pelajaran'
                                 WHERE id = '$id'
                                ";
            $queryUbahPelajaran= $connect->query($sqlUbahPelajaran);
            $_SESSION['message'] =  "#".  $id ." <strong>Berhasil!</strong> Diubah";
            header('Location: index.php?pelajaran');
        }

    }


    }


?>
 <div class="card">
                    <div class="card-header bg-info text-light">
                        <?php if (isset($_GET['up-id']) ) : ?>
                        <h5 class="mb-0">Ubah Mata Pelajaran</h5>
                        <?php elseif (isset($_GET['dp-id'])) : ?>
                        <h5>Detail Mata Pelajaran</h5>
                        <?php else : ?>
                        <h5>Tambah Mata Pelajaran</h5>
                        <?php endif;?>
                    </div>
                    <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="jurusan">Nama Mata Pelajaran</label>
                            <input type="hidden" id='id' value="<?= isset($_GET['up-id']) || isset($_GET['dp-id']) ? $fetch['id'] : ''?>" name="id">
                            <input type="text" class="form-control <?= $_SESSION['pelajaran'] ? 'is-invalid' : ''?>" id="jurusan" value="<?=  isset($_GET['up-id']) || isset($_GET['dp-id']) ? $fetch['nama_mata_pelajaran'] : ''?>" name="nama_mata_pelajaran" <?= 
                            isset($_GET['dp-id']) ? 'readonly' : '' ?>>
                            <?php if(isset($_SESSION['pelajaran'])) :?>
                            <small class="text-danger"><?= $_SESSION['pelajaran']; ?></small>
                            <?php 
                                unset($_SESSION['pelajaran']);
                            endif;?>
                        </div>
                            <?php if(!isset($_GET['pelajaran'])) : ?> 
                            <div class="form-group mb-0 float-right mt-4">
                                <a href="index.php?pelajaran" class="text-danger float-right mb-0">Back</a>    
                            </div>
                          <?php endif; ?>    
                            <?php if (isset($_GET['up-id']) ) : ?>
                            <button type="submit" class="btn btn-info text-light mb-0" name="ubahpelajaran">Ubah!</button>
                            <?php elseif (isset($_GET['pelajaran'])): ?>
                            <button type="submit" class="btn btn-info text-light mb-0" name="tambahpelajaran">Tambah!</button>
                            <?php else : ?>
                            <?php endif;?>
                    </form>
                    </div>
                </div>