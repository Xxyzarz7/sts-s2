<?php 
include("../databases.php");

$ids = $_GET["id"];

if (hapus_peminjaman($ids) > 0) {
    echo"
    <script>
        document.location.href = 'peminjaman_admin.php';
    </script>
    ";
}
?>