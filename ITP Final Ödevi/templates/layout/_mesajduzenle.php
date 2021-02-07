<?php
require '_base.php';
error_reporting(0);
session_start();

require '_sessionkontrol.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesaj Düzenle - Kod Omega Chat</title>
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
                <li class="breadcrumb-item text-secondary">Mesaj Düzenleme Sayfası</li>
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
                <label for="topic">Mesaj Başlığı</label>
                <?php
                $baslikcekme=$database->get("385215_tbl_mesajlar","mesaj_baslik", ["mesaj_id" => $_GET["id"]]);
                    echo '<input type="text" class="form-control" name="mesaj_baslik" id="topic" value="'.$baslikcekme.'">';
                ?>
            </div>
            <div class="form-group">
                <label for="comment">Mesajın Yollandığı Chat Uygulaması:</label>
                <select class="form-control" name="chatuyg">
                    <?php
                    $mesajlar_ = $database->select("385215_tbl_mesajlar", "*",["mesaji_gonderen" => $_SESSION["kullaniciID"]]);
                    foreach ($mesajlar_ as $mesaj_) {
                        $chatUygulamasi = $database->get("385215_tbl_chatuygulamalari", "*", ["chat_id" => $mesaj_["chat_uygulamasi"]]);
                        if ($chatUygulamasi['chat_id']==$chatUygulamasi['chat_id']) {
                            echo '<option value="'.$chatUygulamasi['chat_id'].'">'.$chatUygulamasi['chat_adi'].'</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="comment">Mesaj İçerik:</label>
                <?php
                $icerikcekme=$database->get("385215_tbl_mesajlar","mesaj_icerik", ["mesaj_id" => $_GET["id"]]);
                echo '<textarea class="form-control" name="mesaj_icerik" id="comment" rows="10">'.$icerikcekme.'</textarea>';
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
$gmesaj_baslik="";
$gchatuyg="";
$gmesaj_icerik="";
$gremember="";
if(isset($_POST["mesaj_baslik"]) && isset($_POST["chatuyg"]) && isset($_POST["mesaj_icerik"])){
    if($_POST["mesaj_baslik"] != "" && $_POST["chatuyg"] != "" && $_POST["mesaj_icerik"] != ""){
        if ($_POST["remember"] != ""){
            $gmesaj_baslik=$_POST["mesaj_baslik"];
            $gchatuyg=$_POST["chatuyg"];
            $gmesaj_icerik=$_POST["mesaj_icerik"];
            $gremember=$_POST["remember"];

            // Güncelleme işlemi yapılıyor
            $data = $database->update("385215_tbl_mesajlar",["chat_uygulamasi" => $gchatuyg, "mesaj_baslik" => $gmesaj_baslik, "mesaj_icerik" => $gmesaj_icerik],["mesaj_id" => $_GET["id"]]);
            echo '<script>alert("Güncelleme işlemi başarılı bir şekilde gerçekleşti.")</script>';
        }else{
            echo '<script>alert("Sözleşme kabul edilmeden işleme devam edilemez.")</script>';
        }
    }else{
        echo '<script>alert("Boş alanlar var. Tekrar deneyiniz.")</script>';
    }
}
?>