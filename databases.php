<?php 
//koneksi ke databases
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'sts-s2');
$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) 
or die("Gagal menampilkan databases . mysqli_error"($connect));

function kuery($kueri)
{
    global $connect;
    $result = mysqli_query($connect, $kueri);
    $rows = [];                                                                             
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

//login
function cek_login($username, $password){
    global $connect;
    $uname = $username;
    $upass = $password;

    $hasil = mysqli_query($connect, "select * from user where username ='$uname' and password=MD5('$upass')");
    $cek = mysqli_num_rows($hasil);

    $sql = mysqli_fetch_array($hasil);
    if($cek > 0){
        $_SESSION['username'] = $sql['username'];
        $_SESSION['role'] = $sql['role'];
        return true;
    } else {
        return false;
    }
}

//data barang
function data_barang($query){
    global $connect;
    $sql = mysqli_query($connect, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $rows[] = $row;
    }
    return $rows;
}
//data peminjaman
function data_peminjaman($query){
    global $connect;
    $sql = mysqli_query($connect,$query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $rows[] = $row;
    }
    return $rows;
}
//data user
function data_user($query){
    global $connect;
    $sql = mysqli_query($connect, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $rows[] = $row;
    }
    return $rows;
}

//add barang
function tambah_barang($data){
    global $connect;
    
    $kode_barang = htmlspecialchars($data['kode_barang']);
    $nama_barang = htmlspecialchars($data['nama_barang']);
    $kategori = htmlspecialchars($data['kategori']);
    $merk = htmlspecialchars($data['merk']);
    $jumlah = htmlspecialchars($data['jumlah']);
    
    $sql = mysqli_query($connect, "INSERT INTO barang (id,kode_barang,nama_barang,kategori,merk,jumlah) VALUES (null, '$kode_barang', '$nama_barang' , '$kategori', '$merk' , '$jumlah')");
    return $sql;
    
}
//add peminjaman
function tambah_peminjaman($data){
    global $connect;

    $tgl_pinjam = htmlspecialchars($data['tgl_pinjam']);
    $tgl_kembali = htmlspecialchars($data['tgl_kembali']);
    $no_identitas = htmlspecialchars($data['no_identitas']);
    $kode_barang = htmlspecialchars($data['kode_barang']);
    $jumlah = htmlspecialchars($data['jumlah']);
    $keperluan = htmlspecialchars($data['keperluan']);
    $status = htmlspecialchars($data['status']);
    $id_login = htmlspecialchars($data['id_login']);

    $sql = mysqli_query($connect, "INSERT INTO peminjaman (id,tgl_pinjam,tgl_kembali,no_identitas,kode_barang,jumlah,keperluan,status,id_login) VALUES (null, '$tgl_pinjam', '$tgl_kembali' , '$no_identitas', '$kode_barang' , '$jumlah','$keperluan','$status','$id_login')");
    return $sql;
    
}
//add user
function tambah_user($data){
    global $connect;

    $no_identitas = htmlspecialchars($data['no_identitas']);
    $nama = htmlspecialchars($data['nama']);
    $status = htmlspecialchars($data['status']);
    $username = htmlspecialchars($data['username']);
    $password = md5(htmlspecialchars($data['password']));
    $role = htmlspecialchars($data['role']);

    $sql = mysqli_query($connect, "INSERT INTO user (id,no_identitas,nama,status,username,password,role) VALUES (null, '$no_identitas', '$nama' , '$status', '$username' , '$password','$role')");
    return $sql;
    
}

//edit barang
function ubah_barang($data){
    global $connect;

    $id = $data["id"];
    $kode_barang = htmlspecialchars($data['kode_barang']);
    $nama_barang = htmlspecialchars($data['nama_barang']);
    $kategori = htmlspecialchars($data['kategori']);
    $merk = htmlspecialchars($data['merk']);
    $jumlah = htmlspecialchars($data['jumlah']);

    $query = "UPDATE barang set 
    kode_barang = '$kode_barang',
    nama_barang = '$nama_barang',
    kategori = '$kategori',
    merk = '$merk',
    jumlah =  '$jumlah'
    WHERE id = '$id';
    ";
    $sql = mysqli_query($connect, $query);
    return $sql;
}
//edit peminjaman
function ubah_peminjaman($data){
    global $connect;

    $id = $data["id"];
    $tgl_pinjam = isset($data['tgl_pinjam']) ? date('Y-m-d', strtotime($data['tgl_pinjam'])) : '';
    $tgl_kembali = isset($data['tgl_kembali']) ? date('Y-m-d', strtotime($data['tgl_kembali'])) : '';
    $no_identitas = htmlspecialchars($data['no_identitas']);
    $kode_barang = htmlspecialchars($data['kode_barang']);
    $jumlah = htmlspecialchars($data['jumlah']);
    $keperluan = htmlspecialchars($data['keperluan']);
    $status = htmlspecialchars($data['status']);
    $id_login = htmlspecialchars($data['id_login']);

    $query = "UPDATE peminjaman set
        tgl_pinjam = '$tgl_pinjam',
        tgl_kembali = '$tgl_kembali',
        no_identitas = '$no_identitas',
        kode_barang = '$kode_barang',
        jumlah = '$jumlah',
        keperluan = '$keperluan',
        status = '$status',
        id_login = '$id_login'
        WHERE id = '$id';
    ";
    $sql = mysqli_query($connect, $query);
    return $sql;
}
//edit user
function ubah_user($data){
    global $connect;

    $id = $data["id"];
    $no_identitas = htmlspecialchars($data['no_identitas']);
    $nama = htmlspecialchars($data['nama']);
    $status = htmlspecialchars($data['status']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $role = htmlspecialchars($data['role']);

    $query = "UPDATE user set
        no_identitas = '$no_identitas',
        nama = '$nama',
        status = '$status',
        username = '$username',
        password = '$password',
        role = '$role'
        WHERE id = '$id';
    ";
    $sql = mysqli_query($connect, $query);
    return $sql;
}

//hapus barang
function hapus_barang($id){
 global $connect;

 $sql = mysqli_query($connect, "DELETE FROM barang WHERE id = '$id'");
 return $sql;
}
//hapus user
function hapus_user($id){
    global $connect;
    
    $sql = mysqli_query($connect, "DELETE FROM user WHERE id = '$id'");
    return $sql;
}
//hapus peminjaman
    function hapus_peminjaman($id){
    global $connect;

    $sql = mysqli_query($connect, "DELETE FROM peminjaman WHERE id = '$id'");
    return $sql;
}

//menampilkan semua barang
function total_barang($query){
    global $connect;
    $result = mysqli_query($connect, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($connect));
    }

    $row = mysqli_fetch_row($result);

    if (!$row) {
        die("No rows returned");
    }

    return $row[0];
}
//menampilkan semua user
function total_user($query){
    global $connect;
    $result = mysqli_query($connect, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($connect));
    }
    $row = mysqli_fetch_row($result);
    if (!$row) {
        die("No rows returned");
    }
    return $row[0];
}
//menampilkan semua user
function total_stok($query){
    global $connect;
    $result = mysqli_query($connect, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($connect));
    }
    $row = mysqli_fetch_row($result);
    if (!$row) {
        die("No rows returned");
    }
    return $row[0];
}
//menampilkan semua user
function total_dipinjam($query){
    global $connect;
    $result = mysqli_query($connect, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($connect));
    }
    $row = mysqli_fetch_row($result);
    if (!$row) {
        die("No rows returned");
    }
    return $row[0];
}

?>
