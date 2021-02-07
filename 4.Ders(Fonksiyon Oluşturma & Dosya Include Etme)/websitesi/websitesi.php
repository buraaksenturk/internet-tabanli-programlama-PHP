<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table>
    <tr>
        <td>
            <ul>
                <li><a href="?s=anasayfa">Anasayfa</a></li>
                <li><a href="?s=hakkinda">Hakkında</a></li>
                <li><a href="?s=urunler">Ürünler</a></li>
                <li><a href="?s=iletisim">İletişim</a></li>
            </ul>
        </td>
        <td>
<?php
$anasayfa_i="<h1>Ana Sayfa</h1><p>Ana sayfa içeriği</p>";
$hakkinda_i="<h1>Hakkında Sayfası</h1><p>Sitemiz hakkında bilgi</p>";
$urunler_i="<h1>Ürünler Sayfası</h1><p>Ürün Listesi</p>";
$iletisim_i="<h1>İletisim Sayfası</h1><p>İletisim bilgilerimiz</p>";
if(isset($_GET["s"])){
    $sayfa=$_GET["s"];
    switch($sayfa){
        case "anasayfa":include("anasayfa.html");break;
        case "hakkinda":echo $hakkinda_i;break;
        case "urunler":echo $urunler_i;break;
        case "iletisim":echo $iletisim_i;break;
        default:echo $anasayfa_i;break;
    }
}else{
    echo $anasayfa_i;
}
?>
        </td>
    </tr>
</table>
</body>
</html>