<?php
include 'connection.php';
    $sql = "SELECT * FROM guru";
    $query = $connect->query($sql);

    
?>
<div class="card">
                    <div class="card-header bg-secondary">
                        <h5 class="mb-0 text-light">List Guru</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Guru</th>
                                <th colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; 
                                while($fetch = $query->fetch_assoc()) : ?>
                                <tr>
                                <th scope="row"><?= $i++;?></th>
                                <td><?= $fetch["nama_guru"]?></td>
                                <td>
                                    <a href="index.php?dg-id=<?= $fetch['id']?>" class="badge badge-pill badge-primary mr-2">Detail</a>
                                    <a href="index.php?ug-id=<?= $fetch['id']?>" class="badge badge-pill badge-success mr-2">Ubah</a>
                                    <a href="hapus.php?id=<?= $fetch['id']?>&tb=guru" class="badge badge-pill badge-danger">Hapus</a>
                                </td>
                                </tr>
                            <?php endwhile;?>
                            </tbody>
                            </table>
                    </div>
                </div>