<?php
include 'connection.php';
    $sql = "SELECT * FROM jurusan";
    $query = $connect->query($sql);
    // var_dump($query);
    // die;
    
?>
<div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0 text-light">List Jurusan</h5>
                        <!-- <a href="" class="text-primary">Tambah</a> -->
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Jurusan</th>
                                <th colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; 
                                while($fetch = $query->fetch_assoc()) : ?>
                                <tr>
                                <th scope="row"><?= $i++;?></th>
                                <td><?= $fetch["nama_jurusan"]?></td>
                                <td>
                                    <a href="index.php?dj-id=<?= $fetch['id']?>" class="badge badge-pill badge-primary mr-2">Detail</a>
                                    <a href="index.php?uj-id=<?= $fetch['id']?>" class="badge badge-pill badge-success mr-2">Ubah</a>
                                    <a href="hapus.php?id=<?= $fetch['id']?>&tb=jurusan" class="badge badge-pill badge-danger">Hapus</a>
                                </td>
                                </tr>
                            <?php endwhile;?>
                            </tbody>
                            </table>
                    </div>
                </div>