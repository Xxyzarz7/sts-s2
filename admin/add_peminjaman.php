<?php 
include("../databases.php");

if (isset($_POST["submit"])) {
    if (tambah_peminjaman($_POST) > 0) {
        echo"
        <script>
            document.location.href = 'peminjaman_admin.php';
        </script>
        ";
    } else {
        echo "
        <script>
            document.location.href = 'peminjaman_admin.php';
        </script>
        ";
    }
}

$sql_barang = "SELECT kode_barang,nama_barang FROM barang";
$result_barang = mysqli_query($connect, $sql_barang);

$sql_user = "SELECT id,nama FROM user WHERE role = 'admin'";
$result_user = mysqli_query($connect, $sql_user);

?>

<?php 
session_start();
if($_SESSION['status']!="login"){
    header("location:../loginpage.php?msg=belum_login");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Peminjaman - admin</title>
    <link rel="icon" href="img/logo.png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom fonts and styles -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .logo {
            width: 45px;
        }
        .box {
            background-color: white;
            color: black;
            padding: auto;
        }
        .content {
            padding: 25px;
        }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img class="logo" src="img/logo.png" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">BN666.</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- home -->
            <li class="nav-item">
                <a class="nav-link" href="home_admin.php">
                    <i class="bi bi-house"></i>
                    <span>Home</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="bi bi-journals"></i>
                    <span>Master</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">List Data</h6>
                        <a class="collapse-item" href="barang_admin.php">Barang</a>
                        <a class="collapse-item" href="user_admin.php">User</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="peminjaman_admin.php">
                    <i class="bi bi-box"></i>
                    <span>Peminjam</span>
                </a>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                       required          <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><b><?= $_SESSION['username'] ?></b></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>    
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Content -->
                <div class="container-fluid">
                    <div class="box">
                        <div class="content">
                            <h3 class="add"><b>Peminjaman</b></h3> <hr>
                            <form action="" method="post">
                                <div class="mb-2">
                                    <label for="tgl_pinjam" class="form-label"><b>tanggal pinjam</b></label>
                                    <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" required>
                                </div>
                                <div class="mb-2">
                                    <label for="tgl_kembali" class="form-label"><b>tanggal kembali</b></label>
                                    <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali">
                                </div>
                                <div class="mb-2">
                                    <label for="no_identitas" class="form-label"><b>no identitas</b></label>
                                    <input type="text" class="form-control" id="no_identitas" name="no_identitas" required>
                                </div>
                                <div class="mb-2">
                                    <label for="kode_barang" class="form-label"><b>kode barang</b></label>
                                    <select name="kode_barang" class="form-select" aria-label="Default select example" id="floatingselect1">
                                        <option selected>pilih</option>
                                        <?php 
                                            if(mysqli_num_rows($result_barang)> 0){
                                                while($row = mysqli_fetch_assoc($result_barang)){
                                                    echo "<option value='" . $row['kode_barang'] . "'>" . $row['kode_barang'] . " - " . $row['nama_barang'] . "</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="jumlah" class="form-label"><b>jumlah</b></label>
                                    <input type="text" class="form-control" id="jumlah" name="jumlah" required>
                                </div>
                                <div class="mb-2">
                                    <label for="keperluan" class="form-label"><b>keperluan</b></label>
                                    <input type="text" class="form-control" id="keperluan" name="keperluan" required>
                                </div> <br>
                                <div class="mb-2">
                                    <label for="status" class="form-label"><b>status</b></label>
                                    <input type="text" class="form-control" id="status" name="status" required>
                                </div> <br>
                                <div class="mb-2">
                                <label for="id_login" class="form-label"><b>id login</b></label>
                                <select name="id_login" class="form-select" aria-label="Default select example" id="floatingselect2">
                                    <option selected>pilih</option>
                                    <?php 
                                        if(mysqli_num_rows($result_user)> 0){
                                            while($row = mysqli_fetch_assoc($result_user)){
                                                echo "<option value='" . $row['id'] . "'>" . $row['id'] . " - " . $row['nama'] . "</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div> <br>
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
