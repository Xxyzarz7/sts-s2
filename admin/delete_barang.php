<?php 
include("../databases.php");

$ids = $_GET["id"];

if (hapus_barang($ids) > 0) {
    echo"
    <script>
        document.location.href = 'barang_admin.php';
    </script>
    ";
} else {
    echo "
    <script>
        document.location.href = 'barang_admin.php';
    </script>
    ";
}
?>