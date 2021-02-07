<?php
require '_base.php';
session_start();
error_reporting(0);


require '_sessionkontrol.php';
$kullanici = $database->get("385215_tbl_users", "*", ["users_id" => $_SESSION["kullaniciID"]]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Uygulama - Kod Omega Chat</title>
    <link rel="icon" type="image/jpeg" href="../../static/img/kodomega.jpeg">
    <!-- Bootstrap Css-->
    <link rel="stylesheet" href="../../static/css/bootstrap.min.css">
    <!-- Bootstrap Css -->
</head>
<body>
    <!-- Top Nav -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
        <div class="container">
            <a href="../anasayfa.php" class="navbar-brand">Kod Omega Chat</a>
            <?php include('_link.php') ?>
        </div>
    </nav>
    <!-- Top Nav -->
    <div class="container mt-3">
        <!-- Breadcrumb Nav-->
        <nav aria-label="breadcrumb" class="mt-5 pt-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-secondary">Yeni Uygulama Ekleme Sayfası</li>
            </ol>
        </nav>
        <!-- Breadcrumb Nav-->
        <!-- H5 Title -->
        <div class="p-3 mb-2 bg-info text-white">
            <h5>Uygulama Ekleme Alanı</h5>
        </div>
        <!-- H5 Title -->
        <!-- Form -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="topic" style="font-size:18px;"><b>Uygulama Adı:</b></label>
                <input type="text" class="form-control" name="uygulamaad" id="topic" placeholder="Uygulama Adı">
            </div>
            <div class="checkbox mb-4">
                <label class="col-11 text-danger"><input type="checkbox" name="remember"> Uygulama ekleme sözleşmesini okudum, onaylıyorum</label>
                <button type="submit" class="align-self-center btn btn-primary">Ekle</button>
            </div>
        </form>
        <!-- Form -->
    </div>
    <!-- Container Div -->
    <!-- Bootstrap JS -->
    <script src="../../static/js/bootstrap.bundle.min.js"></script>
    <script src="../../static/js/jquery.min.js"></script>
    <!-- Bootstrap JS -->
</body>
</html>
<?php
$yuygulamaad="";
$yremember="";
if(isset($_POST["uygulamaad"])){
    if($_POST["uygulamaad"] != ""){
        if ($_POST["remember"] != ""){
            $yuygulamaad=$_POST["uygulamaad"];
            $yremember=$_POST["remember"];

            $database->insert("385215_tbl_chatuygulamalari", ["chat_adi" => $yuygulamaad]);
            $son_eklenen_id = $database->id();
            if ($son_eklenen_id>0) {
                echo '<script>alert("Uygulama ekleme işlemi başarılı bir şekilde gerçekleşti.")</script>';
            }else {
                echo '<script>alert("Uygulama ekleme işlemi gerçekleşirken bir hata oluştu.")</script>';
            }
        }else{
            echo '<script>alert("Sözleşme kabul edilmeden işleme devam edilemez.")</script>';
        }
    }else{
        echo '<script>alert("Boş alanlar var. Tekrar deneyiniz.")</script>';
    }
}
?>