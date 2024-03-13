<?php
 include_once "databases.php";
 session_start();
 if (isset($_POST["login"])) {
  $username = $_POST["username"];
  if (cek_login($_POST['username'], $_POST['password'])){
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    if ($_SESSION['role'] =="admin"){
      header("location:admin/home_admin.php");
    } else {
      header("location:user/home_user.php");
    }
  } else {
    header("location:loginpage.php?msg=gagal");
  }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login</title>
    <style>
        html, body {
            height: 100%;
            display: flex;
        }
        .box {
            background-color: #4e73df;
            text-align: center;
            width: 500px;
            height: 100%;
            padding-top: 225px;
        }
        .logo {
            width: 125px;
        }
        .title {
            padding-top: 10px;
            color: white;
        }
        .login {
            margin-left: 90px;
            margin-top: 125px;
        }
    </style>
</head>
<body>
    <div class="box">
        <div class="group">
            <img class="logo" src="image/logo.png" alt="" srcset="">
            <h5 class="title">
                <b>SMK BAKTI NUSANTARA 666</b>
            </h5>
        </div>
    </div>
    <!-- Form login -->
    <div class="login">
        <form action="" method="post">
            <div>
                <h2>Login</h2>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" style="width: 600px;" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" style="width: 600px;" name="password">
            </div> <br> <br>
            <button type="submit" class="btn btn-primary" style="width: 600px;" name="login">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>