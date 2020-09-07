<?php

   if (isset($_GET['gsp'])  || isset($_GET['dgsp-id']) || isset($_GET['ugsp-id'])) {
        $sqlKBM = "SELECT guru_siswa_pelajaran.*, 
                   guru_siswa_pelajaran.id AS gsp_id ,
                   guru.nama_guru,
                   guru.id AS guru_id, 
                   siswa_pelajaran.*, 
                   siswa.nama_murid,
                   siswa.id AS siswa_id,
                   pelajaran.nama_mata_pelajaran,
                   pelajaran.id AS id_pelajaran
                   FROM guru_siswa_pelajaran 
                   LEFT JOIN guru
                   ON guru_siswa_pelajaran.guru_id = guru.id
                   LEFT JOIN siswa_pelajaran
                   ON guru_siswa_pelajaran.siswa_pelajaran_id = siswa_pelajaran.id 
                   LEFT JOIN siswa
                   ON siswa_pelajaran.siswa_id = siswa.id
                   LEFT JOIN pelajaran
                   ON siswa_pelajaran.pelajaran_id = pelajaran.id ";
        $queryKBM = $connect->query($sqlKBM);
        // $siswa_id = $queryKBM->fetch_assoc();           
        // var_dump($queryKBM)['guru_id'];
        // die;

    }


?>


<div class="card">
                    <div class="card-header bg-dark">
                        <h5 class="mb-0 text-light">Monitor KBM</h5>
                        <!-- <a href="" class="text-primary">Tambah</a> -->
                    </div>
                    <div class="card-body">
                        <table class="table  <?= $queryKBM->num_rows > 0 ? 'table-hober' : ''?>">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Guru</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Pelajaran</th>
                                <th colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if($queryKBM->num_rows > 0 ) :?>
                                    <?php $i= 1;
                                    // $idGuru = [];
                                    // $siswaId = [];
                                    // $idPelajaran = [];
                                    while( $fetchKBM = $queryKBM->fetch_assoc() ) :?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $fetchKBM['nama_guru']; ?></td>
                                            <td><?= $fetchKBM['nama_murid']  ?> </td>
                                            <td><?= $fetchKBM['nama_mata_pelajaran']; ?></td>
                                            <td>
                                                <a href="index.php?dgsp-id=<?= $fetchKBM['gsp_id']?>" class="badge badge-pill badge-success mr-2">Detail</a>
                                                <a href="index.php?ugsp-id=<?= $fetchKBM['gsp_id']?>" class="badge badge-pill badge-primary mr-2">Ubah</a>
                                                <a href="hapus.php?id=<?= $fetchKBM['gsp_id']?>&tb=guru_siswa_pelajaran" class="badge badge-pill badge-danger">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endwhile;?>
                                <?php else:?>
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-danger text-center" role="alert">
                                            Tidak ada Data
                                         </div>
                                    </td>
                                </tr>
                            </tbody>
                                <?php endif;?>
                            </table>
                    </div>
                </div>