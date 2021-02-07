<?php
require '_base.php';
error_reporting(0);
session_start();

$email="";
$password="";
if(isset($_POST["email"]) && isset($_POST["password"])){
    if($_POST["email"]!="" && $_POST["password"]!=""){
        $email=$_POST["email"];
        $password=$_POST["password"];
        $kullanici = $database->get("385215_tbl_users", "*", ["AND" => ["email" => $email,"sifre"=>$password]]);
        if($kullanici['users_id']!=""){
            // Hesabın aktif olup olmadığı kontrol ediliyor
            if($kullanici['aktif_mi']==1){
                // Hesap aktifse Anasayfaya yönlendiriliyor
                $_SESSION["kullaniciID"]=$kullanici['users_id'];
                header('Location: ../anasayfa.php');
                exit;
            }else{
                // Hesap aktif değilse uyarı veriyor
                echo '<script>alert("Hesabınız henüz aktifleştirilmedi.")</script>';
            }
        }else{
            // Kullanıcı giriş bilgileri hatalı ya da tutarsız ise kullanıcıya tekrar girmesi için dönüt yapılıyor
            echo '<script>alert("E-Posta ve Şifre bilgileriniz eksik ya da hatalı. Lütfen Tekrar deneyiniz.")</script>';
        }       
    }else{
        // Eksik alanlar varsa bu uyarıyı veriyor
        echo '<script>alert("Eksik alanlar var. Lütfen bilgileri eksiksiz doldurunuz.")</script>';
    }    
}
?>