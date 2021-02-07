<?php
require '_base.php';
session_start();
error_reporting(0);

require '_sessionkontrol.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uygulama Düzenle - Kod Omega Chat</title>
    <link rel="icon" type="image/jpeg" href="../../static/img/kodomega.jpeg">
    <!-- Bootstrap Css-->
    <link rel="stylesheet" href="../../static/css/bootstrap.min.css">
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
                <li class="breadcrumb-item text-secondary">Uygulama Düzenleme Sayfası</li>
            </ol>
        </nav>
        <!-- Breadcrumb Nav-->
        <!-- H5 Title -->
        <div class="p-3 mb-2 bg-info text-white">
            <h5>Düzenleme Alanı</h5>
        </div>
        <!-- H5 Title -->
        <!-- Form -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="topic">Uygulama Adı</label>
                <?php
                $baslikcekme=$database->get("385215_tbl_chatuygulamalari","chat_adi", ["chat_id" => $_GET["id"]]);
                    echo '<input type="text" class="form-control" name="uygulamaadi" id="topic" value="'.$baslikcekme.'">';
                ?>
            </div>
            <div class="checkbox mb-4">
                <label class="col-11 text-danger"><input type="checkbox" name="remember"> Güncelleme sözleşmesini okudum, onaylıyorum</label>
                <button type="submit" class="align-self-center btn btn-primary">Güncelle</button>
            </div>
        </form>
        <!-- Form -->
    </div>
    <!-- Container Div -->
    <!-- Bootstrap JS -->
    <script src="../../static/js/bootstrap.bundle.min.js"></script>
    <script src="../../static/js/jquery.min.js"></script>
</body>
</html>
<?php
$duzenlenecekid=$_GET["id"];
$guygulama_adi="";
$gremember="";
if(isset($_POST["uygulamaadi"])){
    if($_POST["uygulamaadi"] != ""){
        if ($_POST["remember"] != ""){
            $guygulama_adi=$_POST["uygulamaadi"];
            $gremember=$_POST["remember"];

            $data = $database->update("385215_tbl_chatuygulamalari",["chat_adi" => $guygulama_adi],["chat_id" => $duzenlenecekid]);
            echo '<script>alert("Güncelleme işlemi başarılı bir şekilde gerçekleşti.")</script>';
        }else{
            echo '<script>alert("Sözleşme kabul edilmeden işleme devam edilemez.")</script>';
        }
    }else{
        echo '<script>alert("Boş alanlar var. Tekrar deneyiniz.")</script>';
    }
}
?>