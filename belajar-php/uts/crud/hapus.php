<?php
require"connection.php";

$id = $_GET["id"];

$query = "DELETE FROM warna WHERE id = $id";

$conn->query($query);

if( mysqli_affected_rows($conn) > 0 ){
    echo "<script>
            alert('Berhasil diHapus!');
            document.location.href = 'index.php';
        </script>";
}
else{
    echo "<script>
            alert('Gagal diHapus!');
            document.location.href = 'index.php';
        </script>";
}

?>