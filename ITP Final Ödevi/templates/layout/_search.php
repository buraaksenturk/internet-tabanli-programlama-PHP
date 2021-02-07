<?php
require '_base.php';
session_start();
// error_reporting(0);
require '_sessionkontrol.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kod Omega Chat</title>
    <link rel="icon" type="image/jpeg" href="../../static/img/kodomega.jpeg">
    <!-- Bootstrap Css-->
    <link rel="stylesheet" href="../../static/css/bootstrap.min.css">
    <!-- Css -->
    <link rel="stylesheet" href="../../static/css/search.css">
</head>
<body class="d-flex flex-column w-100 h-100">
    <!-- Top Nav -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
        <div class="container">
            <a href="../anasayfa.php" class="navbar-brand">Kod Omega Chat</a>
            <?php include('_link.php') ?>
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
                            <label for="aramasayfasi" class="col-7">Arama Sayfası</label>
                            <form class="form-inline ml-5" aciton="" method="POST">
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
                                            <?php
                                            // Search
                                            // Arama kısmında mesaj başlığına ait olan yazılan her şeyi listeleme
                                            $search="";
                                            $searchsecim="";
                                            if(isset($_POST["search"]) && isset($_POST["searchsecim"])){
                                                if($_POST["search"]!="" && $_POST["searchsecim"]!=""){
                                                    $search=$_POST["search"];
                                                    $searchsecim=$_POST["searchsecim"];
                                                    if ($searchsecim == 1) {
                                                        $gonderen= $database->select("385215_tbl_users", "*", ["ad[~]" => $search]);
                                                        foreach($gonderen as $gonder_en){
                                                            $sonuclar = $database->select("385215_tbl_mesajlar", "*", ["mesaji_gonderen[~]" => $gonder_en['users_id']]);
                                                            if ($sonuclar != ""){
                                                                foreach($sonuclar as $sonuc){
                                                                    $chatUygulamasi = $database->get("385215_tbl_chatuygulamalari", "*", ["chat_id" => $sonuc["chat_uygulamasi"]]);
                                                                    $users_ = $database->get("385215_tbl_users", "*", ["users_id" => $sonuc["mesaji_gonderen"]]);
                                                                    echo '
                                                                    <tr>
                                                                        <td scope="row"><h4 style="color:red;">'.$sonuc["mesaj_baslik"].'</h4>
                                                                            <p>'.$sonuc["mesaj_icerik"].'</p>
                                                                        </td>
                                                                        <td>
                                                                            <h5 style="color:orange;">'.$chatUygulamasi['chat_adi'].'</h5>by <b><span style="color: #5cacee;">'.$users_["ad"].' '.$users_["soyad"].'
                                                                            </span></b><br> '.$sonuc["gonderim_tarihi"].'
                                                                        </td>
                                                                    </tr>';
                                                                }
                                                            }
                                                        }
                                                    }else if($searchsecim == 2){
                                                        $sonuclar = $database->select("385215_tbl_mesajlar", "*", ["mesaj_baslik[~]" => $search]);
                                                        if ($sonuclar != ""){
                                                            foreach($sonuclar as $sonuc){
                                                                $chatUygulamasi = $database->get("385215_tbl_chatuygulamalari", "*", ["chat_id" => $sonuc["chat_uygulamasi"]]);
                                                                $users_ = $database->get("385215_tbl_users", "*", ["users_id" => $sonuc["mesaji_gonderen"]]);
                                                                echo '
                                                                <tr>
                                                                    <td scope="row"><h4 style="color:red;">'.$sonuc["mesaj_baslik"].'</h4>
                                                                        <p>'.$sonuc["mesaj_icerik"].'</p>
                                                                    </td>
                                                                    <td>
                                                                        <h5 style="color:orange;">'.$chatUygulamasi['chat_adi'].'</h5>by <b><span style="color: #5cacee;">'.$users_["ad"].' '.$users_["soyad"].'
                                                                        </span></b><br> '.$sonuc["gonderim_tarihi"].'
                                                                    </td>
                                                                </tr>';
                                                            }
                                                        }
                                                    }else{
                                                        $chatt= $database->select("385215_tbl_chatuygulamalari", "*", ["chat_adi[~]" => $search]);
                                                        foreach($chatt as $chatt_){
                                                            $sonuclar = $database->select("385215_tbl_mesajlar", "*", ["chat_uygulamasi[~]" => $chatt_['chat_id']]);
                                                            if ($sonuclar != ""){
                                                                foreach($sonuclar as $sonuc){
                                                                    $chatUygulamasi = $database->get("385215_tbl_chatuygulamalari", "*", ["chat_id" => $sonuc["chat_uygulamasi"]]);
                                                                    $users_ = $database->get("385215_tbl_users", "*", ["users_id" => $sonuc["mesaji_gonderen"]]);
                                                                    echo '
                                                                    <tr>
                                                                        <td scope="row"><h4 style="color:red;">'.$sonuc["mesaj_baslik"].'</h4>
                                                                            <p>'.$sonuc["mesaj_icerik"].'</p>
                                                                        </td>
                                                                        <td>
                                                                            <h5 style="color:orange;">'.$chatUygulamasi['chat_adi'].'</h5>by <b><span style="color: #5cacee;">'.$users_["ad"].' '.$users_["soyad"].'
                                                                            </span></b><br> '.$sonuc["gonderim_tarihi"].'
                                                                        </td>
                                                                    </tr>';
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- section bitiş -->
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="../../static/js/bootstrap.bundle.min.js"></script>
    <script src="../../static/js/jquery.min.js"></script>
</body>
</html>
