<?php
include 'connection.php';

    if (isset($_POST["tambahguru"])) {
        $nama_guru = trim(strip_tags($_POST["nama_guru"]));

        if (empty($nama_guru)) {
            $_SESSION['guru'] = 'Wajib diisi!';
            header('Location: index.php?guru');
            return false;
        }else{
            $sqlTambahGuru= "INSERT INTO guru VALUES ('', '$nama_guru')";
            $queryGuru= $connect->query($sqlTambahGuru);
            $_SESSION['message'] =  "<strong>Berhasil!</strong> Ditambah";
            header('Location: index.php?guru');
        }

    }

    if (isset($_GET['dg-id']) || isset($_GET['ug-id'])) {
        if (isset($_GET['dg-id'])) {
            $id = $_GET['dg-id'];
        }
        else if (isset($_GET['ug-id'])){
            $id = $_GET['ug-id'];
            
        }

       $sqlViewGuru= "SELECT * FROM guru WHERE id = '$id'";
       $queryViewGuru= $connect->query($sqlViewGuru)->fetch_assoc();
       $nama_guru= $queryViewGuru["nama_guru"];
    //    var_dump($queryViewguru);
    //    die;
       
       if (isset($_POST["ubahguru"])) {
           $id = trim(strip_tags($_POST['id']));
           $nama_guru= trim(strip_tags($_POST["nama_guru"]));

            if (empty($nama_guru)) {
                $_SESSION['guru'] = 'Wajib diisi!';
                header('Location: index.php?ug-id='.$id);
                return false;
            }
            else{
                $sqlUbahGuru= "UPDATE guru SET id = '$id',
                                     nama_guru= '$nama_guru'
                                     WHERE id = '$id'
                                    ";
                $queryUbahGuru= $connect->query($sqlUbahGuru); 
                $_SESSION['message'] =  "<strong>Berhasil!</strong> Diubah";
                header('Location: index.php?guru');
            }

    }


    }


?>
 <div class="card">
                    <div class="card-header bg-secondary text-light">
                        <?php if (isset($_GET['ug-id']) ) : ?>
                        <h5 class="mb-0">Ubah Guru</h5>
                        <?php elseif (isset($_GET['dg-id'])) : ?>
                        <h5 class="mb-0">Detail Guru</h5>
                        <?php else : ?>
                        <h5 class="mb-0">Tambah Guru</h5>
                        <?php endif;?>
                    </div>
                    <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="guru">Nama Guru</label>
                            <input type="hidden" id='id' value="<?= isset($_GET['ug-id']) || isset($_GET['dg-id']) ?  $id : '' ?>" name="id">
                            <input type="text" class="form-control <?= isset($_SESSION['guru']) ? 'is-invalid' : ''?>" id="guru" value="<?= isset($_GET['ug-id']) || isset($_GET['dg-id']) ?  $nama_guru : '' ?>" name="nama_guru" <?= 
                            isset($_GET['dg-id']) ? 'readonly' : '' ?>>
                            <?php if (isset($_SESSION['guru'])) :?>
                            <small class="text-danger"><?= $_SESSION['guru']; ?></small>
                            <?php
                            unset($_SESSION['guru']); 
                            endif;?>
                        </div>
                        <?php if(!isset($_GET['guru'])) : ?> 
                            <div class="form-group mb-0 float-right mt-3">
                                <a href="index.php?guru" class="text-danger float-right mb-0">Back</a>    
                            </div>
                          <?php endif; ?>   
                            <?php if (isset($_GET['ug-id']) ) : ?>
                            <button type="submit" class="btn btn-secondary text-light mb-0" name="ubahguru">Ubah!</button>
                            <?php elseif (isset($_GET['guru'])): ?>
                            <button type="submit" class="btn btn-secondary text-light mb-0" name="tambahguru">Tambah!</button>
                            <?php endif;?>
                    </form>
                    </div>
                </div>