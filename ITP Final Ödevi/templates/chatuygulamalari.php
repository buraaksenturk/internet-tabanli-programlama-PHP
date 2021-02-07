<?php
// Medooyu dahil ediyoruz
require 'layout/_base.php';
// Session'u başlıyoruz
session_start();
// Session kontrol
require 'sessionkontrol.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Uygulamaları - Kod Omega Chat</title>
    <link rel="icon" type="image/jpeg" href="../static/img/kodomega.jpeg">
    <!-- Bootstrap Css-->
    <link rel="stylesheet" href="../static/css/bootstrap.min.css">
</head>
<body class="d-flex flex-column w-100 h-100">
    <!-- Top Nav -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
        <div class="container">
            <a href="anasayfa.php" class="navbar-brand">Kod Omega Chat</a>
            <!-- Linkleri çağırıyoruz -->
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
                            <label for="" class="col-9">Chat Uygulamaları</label>
                            <a href="layout/_uygulamaekle.php"><button class="btn btn-primary btn-smlg my-2 my-sm-0" type="submit">Yeni Chat Uygulaması Ekle</button></a>
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
                                                    <h5>TÜM UYGULAMALAR</h5>
                                                </div>
                                            </th>
                                            <tr>
                                                <th scope="col">Uygulamalar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Uygulamaları tabloda listeliyoruz
                                            $uygulamalar = $database->select("385215_tbl_chatuygulamalari", "*");
                                            foreach($uygulamalar as $uygulamalar_){
                                                echo '
                                                    <tr>
                                                        <td scope="row"><h4 style="color:orange;">'.$uygulamalar_["chat_adi"].'</h4></td>
                                                        <td><a href="layout/_uygulamasil.php?id='.$uygulamalar_["chat_id"].'"><button type="button" class="btn btn-danger"">Sil</button></a></td>
                                                        <td><a href="layout/_uygulamaduzenle.php?id='.$uygulamalar_["chat_id"].'"><button type="button" class="btn btn-primary"">Düzenle</button></a></td>
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