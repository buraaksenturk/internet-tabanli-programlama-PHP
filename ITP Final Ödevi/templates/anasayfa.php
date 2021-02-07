<?php
// Medooyu dahil ediyoruz
require 'layout/_base.php';
// Session'u başlıyoruz
session_start();
// Session kontrol
require 'sessionkontrol.php';
// Değişkenler atanıyor
$kullanici = $database->get("385215_tbl_users", "*", ["users_id" => $_SESSION["kullaniciID"]]);
$foto = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kod Omega Chat</title>
    <link rel="icon" type="image/jpeg" href="../static/img/kodomega.jpeg">
    <!-- Bootstrap Css-->
    <link rel="stylesheet" href="../static/css/bootstrap.min.css">
    <link rel="stylesheet" href="../static/css/search.css">
</head>
<body class="d-flex flex-column w-100 h-100">
    <!-- Top Nav -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
        <div class="container">
            <a href="anasayfa.php" class="navbar-brand">Kod Omega Chat</a>
            <!-- Linkleri Çekiyoruz -->
            <?php include('link.php') ?>
        </div>
    </nav>
    <!-- Top Nav -->
    <!-- Container Div -->
    <div class="container mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="container-fluid ">
                    <nav class="mt-3 pt-5 navbar-row navbar-light bg-light ">
                        <span class="breadcrumb navbar-text">
                            <label for="" class="col-7">Anasayfa</label>
                            <!-- Arama Alanı -->
                            <form class="form-inline ml-5" action="layout/_search.php" method="POST">
                                <input class="form-control-sm mr-sm-2" type="search" id="search" name="search" placeholder="Arama Yap.." aria-label="Search">
                                <select name="searchsecim" style="background-color:#e9ecef;border:none;color:darkgreen;margin-left:10px;padding:5px 10px;">
                                    <option value="1">Gönderenin Adına Göre</option>
                                    <option value="2">Mesaj Başlığına Göre</option>
                                    <option value="3">Chat Uygulamasına Göre</option>
                                </select>
                            </form>
                        </span>
                    </nav>
                </div>
                <div class="col-9">
                    <!-- section -->
                    <section id="forumCategory">
                        <div class="forum-content">
                            <div class="row">
                                <div class="container">
                                    <table class="table  table-striped table-bordered">
                                        <thead>
                                            <th colspan="4" class="bg-info">
                                                <div class="text-white">
                                                    <h5>TÜM MESAJLAR</h5>
                                                </div>
                                            </th>
                                            <tr>
                                                <th scope="col">Mesajlar</th>
                                                <th scope="col">Mesaj Detay</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Kayıt edilmiş bütün mesajlar bu sayfada çekiliyor(yazan kişi ve uygulama adıyla beraber)
                                            $mesajlar = $database -> select("385215_tbl_mesajlar","*");
                                            foreach($mesajlar as $mesaj){
                                                $chatUygulamasi = $database->get("385215_tbl_chatuygulamalari", "*", ["chat_id" => $mesaj["chat_uygulamasi"]]);
                                                $users_ = $database->get("385215_tbl_users", "*", ["users_id" => $mesaj["mesaji_gonderen"]]);
                                                echo '
                                                    <tr>
                                                        <td scope="row"><h4 style="color:red;">'.$mesaj["mesaj_baslik"].'</h4>
                                                            <p>'.$mesaj["mesaj_icerik"].'</p>
                                                        </td>
                                                        <td>
                                                            <h5 style="color:orange;">'.$chatUygulamasi["chat_adi"].'</h5>by <b><span style="color: #5cacee;">'.$users_["ad"].' '.$users_["soyad"].'
                                                            </span></b><br> '.$mesaj["gonderim_tarihi"].'
                                                        </td>
                                                    </tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- section bitişi -->
                <div class="col-3">
                    <!-- Fotoğraf Alanı -->
                    <div class="container">
                        <h3><i>Merhaba Sayın </i> <span style="color:#483d8b;"> <?php echo $kullanici["ad"].' '.$kullanici["soyad"]; ?></span></h3>
                        <?php
                        $foto = $database->get("385215_tbl_users","fotograf",["users_id" => $_SESSION["kullaniciID"]]);
                        echo '<img src="'.$foto.'" style="width:200px;border: 5px solid #555;box-shadow:5px 5px 5px #999;" alt="Profil Fotosu">';
                        ?>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="../static/js/bootstrap.bundle.min.js"></script>
    <script src="../static/js/jquery.min.js"></script>
</body>
</html>