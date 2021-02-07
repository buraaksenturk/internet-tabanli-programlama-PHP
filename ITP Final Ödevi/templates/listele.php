<?php
// Medoo'yu çağırıyoruz
require 'layout/_base.php';
// Session'ı başlatıyoruz
session_start();
// Dönecek olan uyarıların sayfada görünmesini engelliyoruz
error_reporting(0);
// Session'ı kontrol ediyoruz
require 'sessionkontrol.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uygulama Listele - Kod Omega Chat</title>
    <link rel="icon" type="image/jpeg" href="../static/img/kodomega.jpeg">
    <!-- Bootstrap Css-->
    <link rel="stylesheet" href="../static/css/bootstrap.min.css">
</head>
<body class="d-flex flex-column w-100 h-100">
    <!-- Top Nav -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
        <div class="container">
            <a href="anasayfa.php" class="navbar-brand">Kod Omega Chat</a>
            <!-- Link sayfasından sayfanın üst kısmında yer alan linkleri çekiyoruz -->
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
                            <label for="" class="col-10">Listeleme</label>
                        </span>
                    </nav>
                </div>
                <div class="col-12">
                    <form action="" method="post">
                        <label for="uygulamalisteleme" class="ml-3 mr-3 text-danger">Listelemek İstediğiniz Chat Uygulamasını Seçiniz:</label>
                        <select class="ml-3 w-25 text-info" name="listelenecekuyg">
                            <?php
                            // Veritabanında chat alanında yer alan bütün kayıtları optionların içine çekiyoruz
                            $chatUygulamalarıı = $database->select("385215_tbl_chatuygulamalari", "*");
                            foreach ($chatUygulamalarıı as $chatUyg_) {
                                echo '<option value="'.$chatUyg_['chat_id'].'">'.$chatUyg_['chat_adi'].'</option>';
                            }
                            ?>
                        </select>
                        <button type="submit" class="btn btn-secondary">ARA</button>
                    </form>
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
                                                    <h5>LİSTELENECEK MESAJLAR</h5>
                                                </div>
                                            </th>
                                            <tr>
                                                <th scope="col">Mesajlar</th>
                                                <th scope="col">Mesaj Detay</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Optionda seçilecek olan chat uygulamasına ait olan bütün kayıtları tabloda listeliyoruz
                                            $mesajlar = $database->select("385215_tbl_mesajlar", "*", ["chat_uygulamasi" => $_POST['listelenecekuyg']]);
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
                    <!-- section bitişi -->
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="../static/js/bootstrap.bundle.min.js"></script>
    <script src="../static/js/jquery.min.js"></script>
</body>
</html>