<?php
session_start();
include 'connection.php';
if ($_GET['id'] && $_GET['tb']) {
    $id = trim(strip_tags($_GET['id']));
    $tb = $_GET['tb'];
    // var_dump($tb);
    // die;
    $sql = "SELECT * FROM  $tb  WHERE id = '$id'";
    $queryCheck = $connect->query($sql);
    // var_dump($queryCheck);
    // die;
    if ($queryCheck->num_rows < 1) {
        die;
    }
    else{
        $sqlDelete = "DELETE FROM $tb WHERE id = '$id' ";
        $queryDelete = $connect->query($sqlDelete);
        if ($tb !== 'siswa') {
            if ($tb == 'siswa_pelajaran') {
                $_SESSION['message'] = "#".$id." <strong>Berhasil!</strong> Dihapus";
                header('Location: index.php?sp');
            }
            else if ($tb == 'guru_siswa_pelajaran'){
                $_SESSION['message'] = "#".$id." <strong>Berhasil!</strong> Dihapus";
                header('Location: index.php?gsp');
            }
            else{
                $_SESSION['message'] = "#".$id." <strong>Berhasil!</strong> Dihapus";
                header('Location: index.php?'.$tb);
            }
        }else{
            $_SESSION['message'] = "#".$id." <strong>Berhasil!</strong> Dihapus";
            header('Location: index.php');
        }
    }

}

?>