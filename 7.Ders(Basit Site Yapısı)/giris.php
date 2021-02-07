<?php
require 'Medoo.php';
session_start();
// Using Medoo namespace
use Medoo\Medoo;
 
$database = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => 'ybs',
	'server' => 'localhost',
	'username' => 'root',
	'password' => '',
 
	// [optional]
	'charset' => 'utf8mb4',
	'collation' => 'utf8mb4_general_ci',
	'port' => 3306
]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Giriş Sayfası</h1>
    <form action="" method="post">
        E-Posta:<br><input type="email" name="eposta"><br><br>
        Şifre:<br><input type="password" name="sifre"><br><br>
        <input type="submit" value="Giriş Yap"><br>
        <a href="kayit.php">Kayıt Ol</a>
    </form>
</body>
</html>
<?php
$sifre="";
$ePosta="";
if(isset($_POST["eposta"]) && isset($_POST["sifre"])){
    if($_POST["eposta"]!="" && $_POST["sifre"]!=""){
        $ePosta=$_POST["eposta"];
        $sifre=$_POST["sifre"];
        $kullanici = $database->get("kullnicilar", "*", ["AND" => ["eposta" => $ePosta,"sifre"=>$sifre]]);
        if($kullanici['id']!=""){
            //Kullanıcı giriş bilgileri doğru
            //şimdi hesap aktif mi ona bakalım
            if($kullanici['aktif_mi']==1){
                //hesap aktif
                //profil sayfasına yönlendirelim
                $_SESSION["kullaniciID"]=$kullanici['id'];
                header('Location: profil.php');
                exit;
            }else{
                //hesap aktif değil
                //kullanıcıya uyarı ver
                echo '<script>alert("Hesabınız henüz aktifleştirilmedi.")</script>';
            }
        }else{
            //kullanıcı giriş bilgileri hatalı ya da tutarsız
            //kullanıcıya bilgi ver ve tekrar denesin
            echo '<script>alert("E-Posta ve Şifre bilgileriniz eksik ya da hatalı. Lütfen Tekrar deneyiniz.")</script>';
        }       

    }else{
        echo '<script>alert("Eksik alanlar var. Lütfen bilgileri eksiksiz doldurunuz.")</script>';
    }    
}
?>