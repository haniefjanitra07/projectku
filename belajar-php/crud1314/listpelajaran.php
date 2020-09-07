<?php
include 'connection.php';
    $sql = "SELECT * FROM pelajaran";
    $query = $connect->query($sql);

    
?>
<div class="card">
                    <div class="card-header bg-info text-light">
                        <h5 class="mb-0">List Mata Pelajaran</h5>
                        <!-- <a href="" class="text-primary">Tambah</a> -->
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Mata Pelajaran</th>
                                <th colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; 
                                while($fetch = $query->fetch_assoc()) : ?>
                                <tr>
                                    <th scope="row"><?= $i++;?></th>
                                    <td><?= $fetch["nama_mata_pelajaran"]?></td>
                                    <td>
                                        <a href="index.php?dp-id=<?= $fetch['id']?>" class="badge badge-pill badge-primary mr-2">Detail</a>
                                        <a href="index.php?up-id=<?= $fetch['id']?>" class="badge badge-pill badge-success mr-2">Ubah</a>
                                        <a href="hapus.php?id=<?= $fetch['id']?>&tb=pelajaran" class="badge badge-pill badge-danger">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile;?>
                            </tbody>
                            </table>
                    </div>
                </div>