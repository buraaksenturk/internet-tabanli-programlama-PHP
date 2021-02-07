<?php
// Medoo bağlantısını çağırıyoruz
require 'layout/_base.php';
// Session'u başlatıyoruz
session_start();
// Sayfadan dönecek olan uyarıları kapatıyoruz
error_reporting(0);
// Session kontrol yapıyoruz
require 'sessionkontrol.php';
// Session'daki değere id ile users tablosundaki bütün kayıtlara erişiyoruz
$kullanici = $database->get("385215_tbl_users", "*", ["users_id" => $_SESSION["kullaniciID"]]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesajlar - Kod Omega Chat</title>
    <link rel="icon" type="image/jpeg" href="../static/img/kodomega.jpeg">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../static/css/bootstrap.min.css">
</head>
<body class="d-flex flex-column w-100 h-100">
    <!-- Top Nav -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
        <div class="container">
            <a href="anasayfa.php" class="navbar-brand">Kod Omega Chat</a>
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
                            <label for="" class="col-10">Mesajlarım</label>
                            <a href="layout/_mesajekle.php"><button class="btn btn-primary btn-smlg my-2 my-sm-0" type="submit">Yeni Mesaj Ekle</button></a>
                        </span>
                    </nav>
                </div>
                <div class="col-12">
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
                                            <!-- Veritabanı üzerinden kişiye ait olan yazılan bütün mesajları çekiyoruz -->
                                            <?php
                                            $mesajlar = $database->select("385215_tbl_mesajlar", "*", ["mesaji_gonderen" => $_SESSION["kullaniciID"]]);
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
                                                        <td><br><a href="layout/_mesajsil.php?id='.$mesaj["mesaj_id"].'"><button type="button" class="btn btn-danger"">Sil</button></a></td>
                                                        <td><br><a href="layout/_mesajduzenle.php?id='.$mesaj["mesaj_id"].'"><button type="button" class="btn btn-primary"">Düzenle</button></a></td>
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
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="../static/js/bootstrap.bundle.min.js"></script>
    <script src="../static/js/jquery.min.js"></script>
</body>
</html>