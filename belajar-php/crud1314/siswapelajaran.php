<?php
include 'connection.php';
$sqlViewSiswa = "SELECT * FROM siswa ORDER BY nama_murid ASC";
$queryViewSiswa = $connect->query($sqlViewSiswa); 

$sqlViewPelajaran = "SELECT * FROM pelajaran ORDER BY nama_mata_pelajaran ASC";
$queryViewPelajaran = $connect->query($sqlViewPelajaran); 
// var_dump($queryViewKbm);
// die;

if (isset($_POST["tambahkbm"])) {
    $nama_murid = trim(strip_tags($_POST["nama_murid"]));
    $nama_mata_pelajaran = trim(strip_tags($_POST["nama_mata_pelajaran"]));
    // var_dump($nama_mata_pelajaran);
    // die;

        $sqlTambahKbm= "INSERT INTO siswa_pelajaran VALUES ('', '$nama_murid','$nama_mata_pelajaran')";
        $queryKbm= $connect->query($sqlTambahKbm); 
        $_SESSION['message'] = "<strong>Berhasil!</strong> Membuat Data Siswa";
        header('Location: index.php?sp');
    }

    if (isset($_GET['dsp-id']) || isset($_GET['usp-id']) ) {
        if (isset($_GET['dsp-id']) ) {
            $id = $_GET['dsp-id'];
        }
        else if (isset($_GET['usp-id']) ){
            $id = $_GET['usp-id'];
        }
        else{
            $_SESSION['message'] = 'Data Tidak ditemukan diDalam Database';
            header('Location: index.php?sp');
            return false;
        }
    
       $sqlViewKbm3 =  "SELECT siswa_pelajaran.*,
                        siswa.nama_murid,
                        pelajaran.nama_mata_pelajaran 
                        FROM siswa_pelajaran 
                        LEFT JOIN siswa 
                        ON siswa_pelajaran.siswa_id = siswa.id 
                        LEFT JOIN pelajaran 
                        ON siswa_pelajaran.pelajaran_id = pelajaran.id 
                        WHERE siswa_pelajaran.id = '$id'";
       $queryViewKbm3 = $connect->query($sqlViewKbm3)->fetch_assoc();
    //    var_dump($queryViewKbm3);
    //    die;
       $nama_pelajaran= $queryViewKbm3["nama_mata_pelajaran"];


        if (isset($_POST["ubahkbm"])) {
            $nama_murid = trim(strip_tags($_POST["nama_murid"]));
            $nama_mata_pelajaran = trim(strip_tags($_POST["nama_mata_pelajaran"]));

            $sqlUbahKbm= "UPDATE siswa_pelajaran SET id ='$id', 
                                                            siswa_id = '$nama_murid',
                                                            pelajaran_id = '$nama_mata_pelajaran'
                                                            WHERE id ='$id';
                                                            ";
            $queryUbahKbm= $connect->query($sqlUbahKbm);
            $_SESSION['message'] = "#" . $id. " <strong>Berhasil!</strong> Diubah";
            header('Location: index.php?sp');
        }


    }


?>
 <div class="card">
                    <div class="card-header bg-dark text-light">
                        <?php if (isset($_GET['usp-id']) ) : ?>
                        <h5 class="mb-0">Ubah Siswa Pelajaran</h5>
                        <?php elseif (isset($_GET['dsp-id'])) : ?>
                        <h5  class="mb-0">Detail Siswa Pelajaran</h5>
                        <?php else : ?>
                        <h5  class="mb-0">Tambah Siswa Pelajaran</h5>
                        <?php endif;?>
                    </div>
                    <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" value="<?= isset($_GET['usp-id'])  ? $idViewUbah : ''?>" name="id"> 
                       <div class="form-group">
                            <label for="murid">Pilih Siswa</label>
                            <select class="form-control custom-select" id="murid" name="nama_murid" <?= isset($_GET['dsp-id'] ) ? 'disabled' : '' ?>>
                             <?php while($fetchSiswa = $queryViewSiswa->fetch_assoc() ) :?>
                                 <?php if (isset($_GET['dsp-id']) || isset($_GET['usp-id'])) {
                                if ($queryViewKbm3['siswa_id'] == $fetchSiswa['id']) {
                                    
                               ?>
                                    <option selected value="<?=$fetchSiswa ["id"]?>" ><?= $fetchSiswa ['nama_murid']?></option>
                             <?php } else{ ?>
                                    <option value="<?=$fetchSiswa ["id"]?>" ><?= $fetchSiswa ['nama_murid']?></option>
                             <?php } } else{  ?> 
                                    <option value="<?=$fetchSiswa ["id"]?>" ><?= $fetchSiswa ['nama_murid']?></option>
                               <?php } ?>   
                             <?php endwhile;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mata_pelajaran">Pilih Pelajaran</label>
                            <select class="form-control custom-select" id="mata_pelajaran" name="nama_mata_pelajaran" <?= isset($_GET['dsp-id'] ) ? 'disabled' : '' ?>>
                             <?php while($fetchPelajaran = $queryViewPelajaran->fetch_assoc() ) :?>
                              <?php if (isset($_GET['dsp-id']) || isset($_GET['usp-id'])) {
                                if ($queryViewKbm3['pelajaran_id'] == $fetchPelajaran['id']) {
                                    
                               ?>
                                    <option selected value="<?= $fetchPelajaran['id']?>"><?= $fetchPelajaran ['nama_mata_pelajaran']?></option>
                             <?php } else{ ?>
                                    <option value="<?=$fetchPelajaran['id'] ?>" ><?= $fetchPelajaran['nama_mata_pelajaran'] ?></option>
                             <?php } } else{  ?> 
                                    <option value="<?=$fetchPelajaran['id'] ?>" ><?= $fetchPelajaran ['nama_mata_pelajaran'] ?></option>
                               <?php } ?>   
                             <?php endwhile;?>
                            </select>
                        </div>
                        <?php if(!isset($_GET['sp'])) : ?>
                        <div class="form-group mb-0 float-right mt-4">
                            <a href="index.php?sp" class="text-danger float-right mb-0">Back</a>
                        </div>
                        <?php endif;?>
                            <?php if (isset($_GET['usp-id']) ) : ?>
                            <button type="submit" class="btn btn-dark text-light mb-0" name="ubahkbm">Ubah!</button>
                            <?php elseif (!isset($_GET['dsp-id'])): ?>
                            <button type="submit" class="btn btn-dark text-light mb-0" name="tambahkbm">Tambah!</button>
                            <?php endif;?>
                    </form>
                    </div>
                </div>