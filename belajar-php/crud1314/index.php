<?php
session_start();
include 'connection.php';
    $sql = "SELECT siswa.*, jurusan.nama_jurusan
            FROM siswa 
            LEFT JOIN jurusan
            ON siswa.jurusan_id =  jurusan.id
            ";
    $query = $connect->query($sql);

 

    
?>




    

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>APP</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">APP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item <?= empty($_GET) || isset($_GET['ds-id']) || isset($_GET['dsu-id']) ? 'active' : ''?>">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?= isset($_GET['jurusan']) || isset($_GET['dj-id']) || isset($_GET['uj-id']) ? 'active' : ''?>">
                <a class="nav-link"  href=index.php?jurusan>Jurusan</a>
            </li>
            <li class="nav-item <?= isset($_GET['pelajaran']) || isset($_GET['dp-id']) || isset($_GET['up-id']) ? 'active' : ''?>">
                <a class="nav-link" href="index.php?pelajaran">Pelajaran</a>
            </li>
            <li class="nav-item <?= isset($_GET['guru']) || isset($_GET['dg-id']) || isset($_GET['ug-id']) ? 'active' : ''?>">
                <a class="nav-link" href="index.php?guru">Guru</a>
            </li>
            <li class="nav-item <?= isset($_GET['sp']) ||  isset($_GET['dsp-id']) || isset($_GET['usp-id'])   ? 'active' : ''?>">
                <a class="nav-link" href="index.php?sp">Siswa Pelajaran</a>
            </li>
            <li class="nav-item <?= isset($_GET['gsp']) ? 'active' : ''?>">
                <a class="nav-link" href="index.php?gsp">Guru Siswa Pelajaran</a>
            </li>
            </ul>
        </div>
        </div>
    </nav>
    <div class="container mt-5">
        <?php if (isset($_SESSION['message'])) :?>
        <div class="row">
            <div class="col-12">
             <div class="alert alert-<?= isset($_SESSION['type']) ? $_SESSION['type'] : 'success'?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php
                    unset($_SESSION['message']);
                    unset($_SESSION['type']);
                ?>
                 </div>
            </div>
         </div>   
        <?php endif;?>

        <div class="row">   
            <div class="col-4">
                <?php
                if (isset($_GET['jurusan'])  || isset($_GET['dj-id']) || isset($_GET['uj-id'])) {
                    include 'jurusan.php';
                }
                else if(isset($_GET['pelajaran']) || isset($_GET['dp-id']) || isset($_GET['up-id'])) {
                    include 'pelajaran.php';
                }
                else if (isset($_GET['guru']) || isset($_GET['dg-id']) || isset($_GET['ug-id'])){
                    include 'guru.php';
                }
                else if (isset($_GET['kelas']) || isset($_GET['dk-id']) || isset($_GET['uk-id'])){
                    include 'kelas.php';
                }
                else if (isset($_GET['sp']) || isset($_GET['dsp-id']) || isset($_GET['usp-id'])){
                    include 'siswapelajaran.php';
                }
                 else if (isset($_GET['gsp']) || isset($_GET['dgsp-id']) || isset($_GET['ugsp-id'])){
                    
                    include 'gsp.php';
                }
                else{
                    include 'siswa.php';
                }
                ?>
            </div>
            <div class="col-8">
                 <?php if (isset($_GET['jurusan']) || isset($_GET['uj-id']) || isset($_GET['dj-id']) ) {
                    include 'listjurusan.php';
                }
                else if(isset($_GET['pelajaran']) || isset($_GET['dp-id']) || isset($_GET['up-id'])) {
                    include 'listpelajaran.php';
                }
                else if (isset($_GET['guru']) || isset($_GET['dg-id']) || isset($_GET['ug-id'])){
                    include 'listguru.php';
                }
                
                else if (isset($_GET['kelas']) || isset($_GET['dk-id']) || isset($_GET['uk-id'])){
                    include 'listkelas.php';
                }
                else if (isset($_GET['sp']) || isset($_GET['dsp-id']) || isset($_GET['usp-id'])){
                    include 'listsiswapelajaran.php';
                }
                else if (isset($_GET['gsp']) || isset($_GET['dgsp-id']) || isset($_GET['ugsp-id']) ){
                    
                    include 'listgsp.php';
                }
                else{
                    include 'listsiswa.php';
                }
                 ?>
            </div>
        </div>
       
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  </body>
</html>