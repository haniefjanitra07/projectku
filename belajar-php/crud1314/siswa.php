<?php
$sqlJurusan = "SELECT * FROM jurusan";
    $queryJurusan = $connect->query($sqlJurusan);
    // var_dump($queryJurusan);
    // die;    
    if ( !isset($_GET['dsu-id']) ) {
        if (isset($_POST["submit"])) {
            $nama_murid = trim(strip_tags($_POST["nama_murid"]));
            $kelas = trim(strip_tags($_POST["kelas"]));
            $jurusan_id = trim(strip_tags($_POST["jurusan_id"]));
    
            if (empty($nama_murid)) {
                $_SESSION['nama'] = 'Isi nama Murid!';
                $_SESSION['kelass'] = $kelas;
                header('Location: index.php');
                return false;
            }
            else if (empty($kelas)) {
                $_SESSION['kelas'] = 'isi kelas';
                $_SESSION['nama_murid'] = $nama_murid;
                header('Location: index.php');
                return false;
            }
            else if (empty($jurusan_id)) {
                $_SESSION['jurusan'] = 'Pilih jurusan';
                header('Location: index.php');
                return false;
            }
            else{

                if (!is_numeric($kelas)) {
                    $_SESSION['numeric'] = 'Masukkan Angka!';
                    $_SESSION['nama_murid'] = $nama_murid;
                   header('Location: index.php');
                   return false;
                }

                $sqlTambah = "INSERT INTO siswa VALUES ('', '$nama_murid', '$kelas', '$jurusan_id')";
                $query = $connect->query($sqlTambah); 
                $_SESSION['message'] = "<strong>Berhasil!</strong> Membuat Data Siswa";
                $_SESSION['type'] = "success";
                
                header('Location: index.php');

            }
        

        }
    }

    if (isset($_GET['ds-id']) || isset($_GET['dsu-id'])) {
        if (isset($_GET['ds-id'])) {
            $id = $_GET['ds-id'];
        }
        else{
            $id = $_GET['dsu-id'];
            if (isset($_POST['submit'])) {
                $idUpdate = $_POST['id'];
                $nama_murid = trim(strip_tags($_POST["nama_murid"]));
                $kelas = trim(strip_tags($_POST["kelas"]));
                $jurusan_id = trim(strip_tags($_POST["jurusan_id"]));

                if (empty($nama_murid)) {
                $_SESSION['nama'] = 'Isi nama Murid!';
                $_SESSION['kelass'] = $kelas;
                header('Location: index.php?dsu-id='. $idUpdate);
                return false;
                }
                else if (empty($kelas)) {
                    $_SESSION['kelas'] = 'isi kelas';
                    $_SESSION['nama_murid'] = $nama_murid;
                    header('Location: index.php?dsu-id='. $idUpdate);
                    return false;
                }
                else{
        
                $sqlUbah= "UPDATE siswa SET id = '$idUpdate',
                                                nama_murid = '$nama_murid',
                                                kelas = '$kelas',
                                                jurusan_id = '$jurusan_id'
                                                WHERE id = '$idUpdate'";
                $queryUbah = $connect->query($sqlUbah); 
                $_SESSION['message'] = "#" . $idUpdate. " <strong>Berhasil!</strong> Diubah";
                header('Location: index.php ');
                }
            }
        }
        $sqlViewSiswa = "SELECT * FROM siswa WHERE id = '$id'";
        if (!is_numeric($id)) {
            $_SESSION['message'] = "<strong>ID</strong> Tidak Valid";
            $_SESSION['type'] = "danger";
            header('Location: index.php ');
        }
        else{
            $queryViewSiswa = $connect->query($sqlViewSiswa);
            if ($queryViewSiswa->num_rows == 0) {
                $_SESSION['message'] = "<strong>ID</strong> Tidak ditemukan didatabase";
                $_SESSION['type'] = "danger";
                header('Location: index.php ');
            }else{
                $fetchViewSiswa = $queryViewSiswa->fetch_assoc();
            }
        }
    }


?>
 <div class="card">
                    <div class="card-header bg-success text-white">
                        <?php if(isset($_GET['dsu-id'])) :?>
                        <h5 class="mb-0">Ubah Data Murid</h5>
                        <?php elseif(isset($_GET['ds-id'])) :?>
                        <h5 class="mb-0">Detail Data Murid</h5>
                        <?php else :?>
                        <h5 class="mb-0">Tambah Data Murid</h5>
                        <?php endif;?>
                    </div>
                    <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" value="<?= isset($_GET['dsu-id'])  ? $fetchViewSiswa['id'] : ''?>" name="id">    
                        <div class="form-group">
                            <label for="nama">Nama Murid</label>
                            <?php  if (isset($_SESSION['nama_murid']) || isset($_SESSION['numeric']) ) : ?>
                            <input type="text" class="form-control" name="nama_murid"  value="<?= $_SESSION['nama_murid']; ?>">
                            <?php elseif (isset($_SESSION['nama'])) :?>
                            <input type="text" class="form-control  <?= isset($_SESSION['nama']) ? 'is-invalid' : ''?>" id="nama" placeholder="Nama Murid" name="nama_murid" value="<?= isset($_GET['dsu-id']) || isset($_GET['ds-id']) ? $fetchViewSiswa['nama_murid'] : ''?>" <?= isset($_GET['ds-id']) ? 'readonly' : ''?>>
                            <small id="emailHelp" class="form-text text-danger"><?= $_SESSION['nama']?>.</small>
                            <?php else : ?>
                            <input type="text" class="form-control  <?= isset($_SESSION['nama']) ? 'is-invalid' : ''?>" id="nama" placeholder="Nama Murid" name="nama_murid" value="<?= isset($_GET['dsu-id']) || isset($_GET['ds-id']) ? $fetchViewSiswa['nama_murid'] : ''?>" <?= isset($_GET['ds-id']) ? 'readonly' : ''?>>
                            <?php  endif; ?>
                            <?php
                                unset($_SESSION['nama']);
                                unset($_SESSION['nama_murid']);
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <?php if (isset($_SESSION['kelass'])) :?>
                            <input type="text" class="form-control" id="kelas" placeholder="Nama Murid" name="kelas" value="<?= $_SESSION['kelass']?>">
                            <?php elseif (isset($_SESSION['kelas'])) :?>
                            <input type="text" class="form-control  <?= isset($_SESSION['kelas']) ? 'is-invalid' : ''?>" id="nama" placeholder="Nama Murid" name="kelas" value="<?= isset($_GET['dsu-id']) || isset($_GET['ds-id']) ? $fetchViewSiswa['nama_murid'] : ''?>" <?= isset($_GET['ds-id']) ? 'readonly' : ''?>>
                            <small id="kelas" class="form-text text-danger"><?= $_SESSION['kelas']?>.</small>
                            <?php elseif (isset($_SESSION['numeric'])) :?>
                            <input type="text" class="form-control  <?= isset($_SESSION['numeric']) ? 'is-invalid' : ''?>" id="nama" placeholder="Nama Murid" name="kelas" value="<?= isset($_GET['dsu-id']) || isset($_GET['ds-id']) ? $fetchViewSiswa['nama_murid'] : ''?>" <?= isset($_GET['ds-id']) ? 'readonly' : ''?>>
                            <small id="numeric" class="form-text text-danger"><?= $_SESSION['numeric']?>.</small>
                            <?php else : ?>
                            <input type="text" class="form-control  <?= isset($_SESSION['kelas']) ? 'is-invalid' : ''?>" id="kelas" placeholder="Kelas" name="kelas" value="<?= isset($_GET['dsu-id']) || isset($_GET['ds-id']) ? $fetchViewSiswa['kelas'] : ''?>" <?= isset($_GET['ds-id']) ? 'readonly' : ''?>>
                            <?php  endif; ?>
                            <?php
                                unset($_SESSION['kelas']);
                                unset($_SESSION['kelass']);
                                unset($_SESSION['numeric']);
                                ?>
                        </div>
                        <label for="<?= $fetchJurusan["nama_jurusan"]?>">
                                  Pilih jurusan
                        </label>
                        <select class="custom-select" name="jurusan_id" <?= isset($_GET['ds-id'] ) ? 'disabled' : '' ?>>
                            <?php while($fetchJurusan = $queryJurusan->fetch_assoc()) : 
                                // echo $fetchJurusan["id"];
                                
                                ?>
                             <?php if (isset($fetchViewSiswa)) {
                                 if ($fetchViewSiswa['jurusan_id'] == $fetchJurusan['id']) {
                                     
                                     ?>
                                     <option selected value="<?= $fetchJurusan["id"]?>"  id="<?= $fetchJurusan["nama_jurusan"]?>"><?= $fetchJurusan["nama_jurusan"]?></option>
                             <?php } else{ ?>
                                     <option value="<?= $fetchJurusan["id"]?>" name="jurusan_id" id="<?= $fetchJurusan["nama_jurusan"]?>"><?= $fetchJurusan["nama_jurusan"]?></option>
                             <?php } } else{  ?> 
                                     <option value="<?= $fetchJurusan["id"]?>" name="jurusan_id" id="<?= $fetchJurusan["nama_jurusan"]?>"><?= $fetchJurusan["nama_jurusan"]?></option>
                               <?php } ?>    
                        </div>
                        <?php endwhile; ?>
                                    </select>
                         <?php if(isset($_GET['ds-id'])) :?>
                        <div class="form-group mb-0 float-right mt-3">
                            <a href="index.php" class="text-danger float-right mb-0">Back</a>    
                        </div>
                            <?php elseif(isset($_GET['dsu-id'])):?>    
                            <button type="submit" class="btn btn-success mt-2 mb-0 d-block" name="submit">Submit</button>
                            <a href="index.php" class="text-danger float-right mb-0">Back</a> 
                            <?php else: ?>   
                            <button type="submit" class="btn btn-success mt-2 mb-0 d-block" name="submit">Submit</button>
                            <?php endif;?>    
                    </form>
                    </div>
                </div>