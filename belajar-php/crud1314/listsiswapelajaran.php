<?php
include 'connection.php';
    $sqlSp= "SELECT siswa_pelajaran.*, siswa_pelajaran.id AS sp_id, siswa.*, siswa.id AS siswaid, pelajaran.*
            FROM siswa_pelajaran
            LEFT JOIN siswa
            ON siswa_pelajaran.siswa_id = siswa.id
            LEFT JOIN pelajaran
            ON siswa_pelajaran.pelajaran_id = pelajaran.id 
            ";
    $querySp= $connect->query($sqlSp);
    // var_dump($queryListKbm);
    // die;
    
?>
<div class="card">
                    <div class="card-header bg-dark">
                        <h5 class="mb-0 text-light">Daftar Yang Mengikuti Pelajaran</h5>
                        <!-- <a href="" class="text-primary">Tambah</a> -->
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Murid</th>
                                <th scope="col">Pelajaran</th>
                                <th colspan="3">Action</th>
                                </tr>
                            </thead>
                            <?php if($querySp->num_rows > 0) : ?>
                            <tbody>
                            <?php $i = 1; 
                                while($fetchSp= $querySp->fetch_assoc()) : ?>
                                <tr>
                                    <th scope="row"><?= $i++;?></th>
                                    <td><?= $fetchSp["nama_murid"]?></td>
                                    <td><?= $fetchSp["nama_mata_pelajaran"]?></td>
                                    <td>
                                        <a href="index.php?dsp-id=<?= $fetchSp['sp_id']?>" class="badge badge-pill badge-success mr-2">Detail</a>
                                        <a href="index.php?usp-id=<?= $fetchSp['sp_id']?>" class="badge badge-pill badge-primary mr-2">Ubah</a>
                                        <a href="hapus.php?id=<?= $fetchSp['sp_id']?>&tb=siswa_pelajaran" class="badge badge-pill badge-danger">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile;?>
                            </tbody>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5"> 
                                        <div class="alert alert-danger text-center" role="alert">
                                            Tidak ada Data
                                         </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </table>
                    </div>
                </div>