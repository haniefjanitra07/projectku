<?php
include 'connection.php';
    $sqlListKbm = "SELECT siswa_pelajaran.*, siswa_pelajaran.id AS sp_id, siswa.*, siswa.id AS siswaid, pelajaran.*
            FROM siswa_pelajaran
            LEFT JOIN siswa
            ON siswa_pelajaran.siswa_id = siswa.id
            LEFT JOIN pelajaran
            ON siswa_pelajaran.pelajaran_id = pelajaran.id 
            ";
    $queryListKbm = $connect->query($sqlListKbm);
    // var_dump($queryListKbm['sp_id']);
    // die;
    
?>
<div class="card">
                    <div class="card-header bg-dark">
                        <h5 class="mb-0 text-light">List KBM</h5>
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
                            <tbody>
                            <?php $i = 1; 
                                while($fetchListKbm = $queryListKbm->fetch_assoc()) : ?>
                                <tr>
                                <th scope="row"><?= $i++;?></th>
                                <td><?= $fetchListKbm["nama_murid"]?></td>
                                <td><?= $fetchListKbm["nama_mata_pelajaran"]?></td>
                                <td><a href="index.php?ukbm-id=<?= $fetchListKbm['siswa_id']?>&p-id=<?= $fetchListKbm['pelajaran_id']?>&sp-id=<?= $fetchListKbm['sp_id']?>" class="text-primary">Ubah</a></td>
                                <td><a href="index.php?dkbm-id=<?= $fetchListKbm['siswa_id']?>&p-id=<?= $fetchListKbm['pelajaran_id'] ?>" class="text-success">Detail</a></td>
                                <td><a href="hapus.php?id=<?= $fetchListKbm['sp_id']?>&tb=siswa_pelajaran" class="text-danger">Hapus</a></td>
                                </tr>
                            <?php endwhile;?>
                            </tbody>
                            </table>
                    </div>
                </div>