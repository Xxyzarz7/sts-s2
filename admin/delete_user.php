<?php 
include("../databases.php");

$ids = $_GET["id"];

if (hapus_user($ids) > 0) {
    echo"
    <script>
        document.location.href = 'user_admin.php';
    </script>
    ";
} else {
    echo "
    <script>
        document.location.href = 'user_admin.php';
    </script>
    ";
}
?>