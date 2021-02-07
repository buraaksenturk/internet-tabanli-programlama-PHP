<?php
require 'Medoo.php';
 
// Using Medoo namespace
use Medoo\Medoo;
 
$database = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => 'itp',
	'server' => 'localhost',
	'username' => 'root',
	'password' => ''
]);

if(isset($_GET["kad"]) && isset($_GET["sifre"])){
    $kAd=$_GET["kad"];
    $sifre=$_GET["sifre"];
    //Kayıt işlemi yapmalıyız
    $user=$database->get("users","id", ["AND" =>["kad" => $mail, "aktivasyon" => $kod]]);
    if($user>0){
        //aktivasyon yap
        $data = $database->update("users",["aktif_mi" => 1],["id" => $user]);
        header('Location:panel.php');
    }else{
        header('Location:giris.php?m=kullanici_hata');
    }
}
?>