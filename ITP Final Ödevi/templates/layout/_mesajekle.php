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
    <title>Yeni Mesaj - Kod Omega Chat</title>
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
                <li class="breadcrumb-item text-secondary">Yeni Mesaj Sayfası</li>
            </ol>
        </nav>
        <!-- Breadcrumb Nav-->
        <!-- H5 Title -->
        <div class="p-3 mb-2 bg-info text-white">
            <h5>Mesaj Ekleme Alanı</h5>
        </div>
        <!-- H5 Title -->
        <!-- Form -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="topic" style="font-size:18px;"><b>Mesaj Başlığı:</b></label>
                <input type="text" class="form-control" name="mesaj_baslik" id="topic" placeholder="Başlık">
            </div>
            <div class="form-group">
                <label for="comment" style="font-size:18px;"><b>Mesajın Yollanacağı Chat Uygulaması:</b></label>
                <select class="form-control" name="chatuyg">
                    <?php
                    $chatUygulamalarıı = $database->select("385215_tbl_chatuygulamalari", "*");
                    foreach ($chatUygulamalarıı as $chatUyg_) {
                        echo '<option value="'.$chatUyg_['chat_id'].'">'.$chatUyg_['chat_adi'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="comment" style="font-size:18px;"><b>Mesaj İçerik:</b></label>
                <textarea class="form-control" name="mesaj_icerik" id="comment" rows="10" placeholder="İçerik"></textarea>
            </div>
            <div class="checkbox mb-4">
                <label class="col-11 text-danger"><input type="checkbox" name="remember"> Mesaj ekleme sözleşmesini okudum, onaylıyorum</label>
                <button type="submit" class="align-self-center btn btn-primary">Ekle</button>
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
$ymesaj_baslik="";
$ychatuyg="";
$ymesaj_icerik="";
$yremember="";
if(isset($_POST["mesaj_baslik"]) && isset($_POST["chatuyg"]) && isset($_POST["mesaj_icerik"])){
    if($_POST["mesaj_baslik"] != "" && $_POST["chatuyg"] != "" && $_POST["mesaj_icerik"] != ""){
        if ($_POST["remember"] != ""){
            $ymesaj_baslik=$_POST["mesaj_baslik"];
            $ychatuyg=$_POST["chatuyg"];
            $ymesaj_icerik=$_POST["mesaj_icerik"];
            $yremember=$_POST["remember"];

            // yeni mesaj ekleme
            $database->insert("385215_tbl_mesajlar", ["chat_uygulamasi" => $ychatuyg,"mesaji_gonderen" => $_SESSION["kullaniciID"],"mesaj_baslik" => $ymesaj_baslik, "mesaj_icerik" => $ymesaj_icerik]);
            $son_eklenen_id = $database->id();
            if ($son_eklenen_id>0) {
                echo '<script>alert("Mesaj ekleme işlemi başarılı bir şekilde gerçekleşti.")</script>';
            }else {
                echo '<script>alert("Mesaj ekleme işlemi gerçekleşirken bir hata oluştu.")</script>';
            }
        }else{
            echo '<script>alert("Sözleşme kabul edilmeden işleme devam edilemez.")</script>';
        }
    }else{
        echo '<script>alert("Boş alanlar var. Tekrar deneyiniz.")</script>';
    }
}
?>