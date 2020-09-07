 <?php
include 'connection.php';
$sqlGSP= "SELECT * FROM guru";
$queryGSP= $connect->query($sqlGSP); 

$sqlGSP2 = "SELECT 
                siswa_pelajaran.pelajaran_id, 
                siswa_pelajaran.id,
                pelajaran.nama_mata_pelajaran,
                siswa.nama_murid,
                siswa.id AS siswa_id
                FROM  siswa_pelajaran
                LEFT JOIN pelajaran
                ON siswa_pelajaran.pelajaran_id = pelajaran.id
                LEFT JOIN siswa
                ON siswa_pelajaran.siswa_id = siswa.id";
$queryGSP2 = $connect->query($sqlGSP2);
// var_dump($queryGSP2);
// die;

    
        if (isset($_POST["tambahgsp"])) {
             $guru_id = trim(strip_tags($_POST["guru_id"]));
             $sp = $_POST['sp_id'];
             $sqlTambahKbm = "INSERT INTO guru_siswa_pelajaran VALUES ('', '$guru_id', '$sp')";
             $queryKbm= $connect->query($sqlTambahKbm); 
               //    header('Location: index.php?kbm');
            $_SESSION['message'] = '<strong>Berhasil!</strong> KBM sedang berlangsung';
         }
       

            
            
     if (isset($_GET['ugsp-id']) || isset($_GET['dgsp-id']) ) {
        if (isset($_GET['ugsp-id'])  ) {
            $id = $_GET['ugsp-id'];

             if (isset($_POST['ubahgsp'])) {
                $guru_id = trim(strip_tags($_POST["guru_id"]));
                $sp = $_POST['sp_id'];
                $sqlTambahKbm = "UPDATE guru_siswa_pelajaran 
                                 SET id = '$id', 
                                 guru_id =  '$guru_id', 
                                 siswa_pelajaran_id = '$sp'
                                 WHERE id = '$id' ";
                $queryKbm= $connect->query($sqlTambahKbm); 
                //    header('Location: index.php?kbm');
                $_SESSION['message'] = '<strong>Berhasil!</strong> KBM sedang berlangsung';
            }
        }
        else if (isset($_GET['dgsp-id']) ){
            $id = $_GET['dgsp-id'];

        }
        else{
            $_SESSION['message'] = 'Data Tidak ditemukan diDalam Database';
        }
        
    
        
       $sqlGSP3= "SELECT 
                 guru_siswa_pelajaran.*,
                 guru.id AS id_guru,
                 siswa_pelajaran.id AS id_siswa_pelajaran
                 FROM guru_siswa_pelajaran
                 LEFT JOIN guru
                 ON guru_siswa_pelajaran.guru_id = guru.id
                 LEFT JOIN siswa_pelajaran
                 ON guru_siswa_pelajaran.siswa_pelajaran_id = siswa_pelajaran.id 
                 WHERE guru_siswa_pelajaran.id = '$id';
                 ";
       $queryGSP3= $connect->query($sqlGSP3)->fetch_assoc();
        // var_dump($queryGSP3);
        // die;


            
        }
        
        
        ?>
 
 
 <div class="card">
                    <div class="card-header bg-dark text-light">
                        <?php if (isset($_GET['ugsp-id']) ) : ?>
                        <h5 class="mb-0">Ubah #<?= $_GET['ugsp-id']?></h5>
                        <?php elseif (isset($_GET['dgsp-id'])) : ?>
                        <h5  class="mb-0">Detail  #<?= $_GET['dgsp-id']?></h5>
                        <?php else : ?>
                        <h5  class="mb-0">Tambah Guru Siswa Pelajaran</h5>
                        <?php endif;?>
                    </div>
                    <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" value="<?= isset($_GET['ugsp-id'])  ? $idViewUbah : ''?>" name="id"> 
                       <div class="form-group">
                            <label for="guru">Pilih Guru</label>
                            <select class="form-control custom-select" id="guru" name="guru_id" <?= isset($_GET['dgsp-id'] ) ? 'disabled' : '' ?>>
                             <?php while($fetchGSP= $queryGSP->fetch_assoc() ) :?>
                                 <?php if (isset($_GET['ugsp-id']) || isset($_GET['dgsp-id'])) {
                                if ($queryGSP3['id_guru'] == $fetchGSP['id']) {
                                    
                                    ?>
                                    <option selected value="<?=$fetchGSP["id"]?>" ><?= $fetchGSP['nama_guru']?></option>
                             <?php } else{ ?>
                                    <option value="<?=$fetchGSP["id"]?>" ><?= $fetchGSP['nama_guru']?></option>
                             <?php } } else{  ?> 
                                    <option value="<?=$fetchGSP["id"]?>" ><?= $fetchGSP['nama_guru']?></option>
                               <?php } ?>   
                             <?php endwhile;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="guru">Pilih Siswa Pelajaran</label>
                            <select class="form-control custom-select" id="sp" name="sp_id" <?= isset($_GET['dgsp-id'] ) ? 'disabled' : '' ?>>
                             <?php while($fetchSP2 = $queryGSP2->fetch_assoc() ) :?>
                                 <?php if (isset($_GET['ugsp-id']) || isset($_GET['dgsp-id'])) {
                                if ($queryGSP3['id_siswa_pelajaran'] == $fetchSP2['id']) {
                                    
                                    ?>
                                    <option selected value="<?=$fetchSP2 ["id"]?>" ><?= $fetchSP2 ['nama_murid'] .':   ' . $fetchSP2['nama_mata_pelajaran']?></option>
                             <?php } else{ ?>
                                    <option value="<?=$fetchSP2 ["id"]?>" ><?= $fetchSP2 ['nama_murid'] . ':  '. $fetchSP2['nama_mata_pelajaran']?></option>
                             <?php } } else{  ?> 
                                    <option value="<?=$fetchSP2 ["id"]?>" ><?= $fetchSP2 ['nama_murid'] . ':  ' . $fetchSP2['nama_mata_pelajaran']?></option>
                               <?php } ?>   
                             <?php endwhile;?>
                            </select>
                        </div>
                       
                        <?php if(!isset($_GET['gsp'])) : ?>
                        <div class="form-group mb-0 float-right mt-4">
                            <a href="index.php?gsp" class="text-danger float-right mb-0">Back</a>
                        </div>
                        <?php endif;?>
                            <?php if (isset($_GET['ugsp-id']) ) : ?>
                            <button type="submit" class="btn btn-dark mb-0 text-light" name="ubahgsp">Ubah</button>
                            <?php elseif (isset($_GET['gsp'])): ?>
                            <button type="submit" class="btn btn-dark mb-0 text-light" name="tambahgsp">Submit!</button>
                            <?php endif;?>
                    </form>
                    </div>
                </div>

