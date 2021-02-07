<?php 

$sayi = 10;
$sayi2 = 5;
if($sayi>9 && $sayi2==5){
    echo "Koşul Sağlandı...";
}else{
    echo "Koşul Sağlanamadı";
}
echo "<br>----------<br>";
switch(true){
    case $sayi>10; echo "Sayı 10'dan büyüktür.."; break;
    case $sayi==10; echo "Sayı 10'a eşittir.."; break;
    case $sayi<10; echo "Sayı 10'dan küçüktür.."; break;
    default: echo "Sonuç yok"; break;
}
/*
--Bir diğer kullanım--

switch($sayi){
    case 11; echo "Sayı 10'dan büyüktür.."; break;
    case 10; echo "Sayı 10'a eşittir.."; break;
    case 9; echo "Sayı 10'dan küçüktür.."; break;
    default: echo "Sonuç yok"; break;
}
*/

/* 
&& => ve(and) operatörüdür
|| => veya(or) operatörüdür

$sayi = 10;
$sayi2 = 5;
if($sayi>9 && $sayi2==5){
    echo "Koşul Sağlandı...";
}else{
    echo "Koşul Sağlanamadı";
}

?>
*/