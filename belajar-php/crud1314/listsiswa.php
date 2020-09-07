<?php
include 'connection.php';
    $sql = "SELECT siswa.*, jurusan.nama_jurusan
            FROM siswa 
            LEFT JOIN jurusan
            ON siswa.jurusan_id =  jurusan.id
            ORDER BY nama_murid ASC
            ";
    $query = $connect->query($sql);

    
?>
<div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">List Siswa</h5>
                        <!-- <a href="" class="text-primary">Tambah</a> -->
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Murid</th>
                                <th scope="col">Kelas</th>
                                <th colspan="5">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if($query->num_rows > 0) :  
                                $i = 1; 
                                while($fetch = $query->fetch_assoc()) : ?>
                                <tr>
                                <th scope="row"><?= $i++;?></th>
                                <td><?= $fetch["nama_murid"]?></td>
                                <td><?= $fetch["kelas"]?></td>
                                <td>
                                    <a href="index.php?ds-id=<?= $fetch['id']?>" class="badge badge-pill badge-primary mr-2">Detail</a>
                                    <a href="index.php?dsu-id=<?= $fetch['id']?>" class="badge badge-pill badge-success mr-2">Ubah</a>
                                    <a href="hapus.php?id=<?= $fetch['id']?>&tb=siswa" class="badge badge-pill badge-danger">Hapus</a>
                                </td>
                                </tr>
                            <?php endwhile;?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">
                                    <div class="alert alert-danger text-center" role="alert">
                                            Tidak ada Data
                                         </div>
                                    </td>
                                </tr>
                            <?php endif;?>
                            </tbody>
                            </table>
                    </div>
                </div>