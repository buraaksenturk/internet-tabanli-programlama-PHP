<?php
// If you installed via composer, just use this code to require autoloader on the top of your projects.
require 'Medoo.php';

// Using Medoo namespace
use Medoo\Medoo;

$database = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => 'itp_vt',
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
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITP Vize Ödevi</title>
    <style>
    /* Tabloya ait Css kodları*/
        table.blueTable {
        border: 1px solid #1C6EA4;
        background-color: #EEEEEE;
        width: 100%;
        text-align: left;
        border-collapse: collapse;
        }
        table.blueTable td, table.blueTable th {
        border: 1px solid #AAAAAA;
        padding: 3px 2px;
        }
        table.blueTable tbody td {
        font-size: 13px;
        }
        table.blueTable tr:nth-child(even) {
        background: #D0E4F5;
        }
        table.blueTable thead {
        background: #1C6EA4;
        background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        border-bottom: 2px solid #444444;
        }
        table.blueTable thead th {
        font-size: 15px;
        font-weight: bold;
        color: #FFFFFF;
        border-left: 2px solid #D0E4F5;
        }
        table.blueTable thead th:first-child {
        border-left: none;
        }

        table.blueTable tfoot td {
        font-size: 14px;
        }
        table.blueTable tfoot .links {
        text-align: right;
        }
        table.blueTable tfoot .links a{
        display: inline-block;
        background: #1C6EA4;
        color: #FFFFFF;
        padding: 2px 8px;
        border-radius: 5px;
        }
    </style>
</head>
<body>
<!-- Form Alanımız -->
<form action="" method="GET">
    Hangi Chat Uygulamasını Kullanıyorsunuz? <input type="text" name="chat_uygulamasinin_adi"><br>
    Kullanıcı Adınız Nedir? <input type="text" name="kullanici_adi"><br>
    Günde Ortalama Kaç Saat Kullanıyorsunuz? <input type="text" name="ort_kac_saat"><br>
    Kullanımı Rahat Mı? <input type="text" name="rahat_mi"><br>
    <input type="submit" value="Gönder">
    <input type="reset" value="Temizle"><br><br><hr>
</form>
<?php
/* Veri Tabanına Kayıt Ettiğimiz Alan */
$chatUygulamasininAdi="";
$kullaniciAdi="";
$ortKacSaat="";
$rahatMi="";
/* 'if' komutu gelen değer olup olmadığımızı kontrol ediyoruz */
if(isset($_GET["chat_uygulamasinin_adi"]) && isset($_GET["kullanici_adi"]) && isset($_GET["ort_kac_saat"]) && isset($_GET["rahat_mi"])){
    /* Gelen değerler varsa bu değerler yukarıda atadığımız değişkenlere atanıyor */
    $chatUygulamasininAdi=$_GET["chat_uygulamasinin_adi"];
    $kullaniciAdi=$_GET["kullanici_adi"];
    $ortKacSaat=$_GET["ort_kac_saat"];
    $rahatMi=$_GET["rahat_mi"];
    if ($chatUygulamasininAdi=="" || $kullaniciAdi=="" || $ortKacSaat=="" || $rahatMi=="") {
        echo '<script>alert("!! Lütfen boş alan bırakmayınız !!");</script>';   
    }else {
        $database->insert("tbl_385215", ["chat_uygulamasinin_adi" => $chatUygulamasininAdi,"kullanici_adi" => $kullaniciAdi,"ort_kac_saat" => $ortKacSaat,"rahat_mi" => $rahatMi]);
        $sonEklenen=0;
        $sonEklenen = $database->id();
        /* 'if & else' ile değerler doğru şekilde atanıp atanamadığı kontrol ediliyor ve 'alert' ile uyarı veriliyor  */
        if($sonEklenen>0){
            echo '<script>alert("Bilgileriniz başarılı bir şekilde alınmıştır. Teşekkür ederiz.");</script>';
        }else{
            echo '<script>alert("Bilgileriniz alınırken hata oluştu. Lütfen kontrol edip tekrar deneyiniz.");</script>';
        }
    }
}
?>
<!-- Tablo Başlangıcı -->
<table class="blueTable">
<thead>
<!-- Tablomuzda bulanacak alanların isimleri 'th'lerin içerisine yazılıyor -->
<tr>
<th>ID</th>
<th>Kullandığınız Chat Uygulamasının Adı</th>
<th>Kullanıcı Adınız</th>
<th>Günde Ortalama Kaç Saat Kullanıyorsunuz?</th>
<th>Rahat Mı?</th>
</tr>
</thead>
<tbody>
<!-- Bu alanda sürekli dönecek olan alanlarımız Php içinde 'foreach' ile döndürülüyor -->
<?php
$kayitlar = $database->select("tbl_385215", "*");
/* 'idSira' ile veri tabanından kayıt silinince oluşacak olan bozuk görüntü engelleniyor  */
$idSira=1;
foreach($kayitlar as $kayit){
    echo "<tr>
    <td>$idSira</td>
    <td>".$kayit["chat_uygulamasinin_adi"]."</td>
    <td>".$kayit["kullanici_adi"]."</td>
    <td>".$kayit["ort_kac_saat"]."</td>
    <td>".$kayit["rahat_mi"]."</td>
    </tr>";
    /* 'idSira' Bu alanda her seferinde bir arttırılır */
    $idSira++;
}
?>
</tbody>
</table>
</body>
</html>