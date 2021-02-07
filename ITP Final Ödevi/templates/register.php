<?php
require 'layout/_base.php';

// PHPMailer sınıflarını çağırıyoruz 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Composer'ı çağırıyoruz  
require 'layout/vendor/autoload.php';

$mail = new PHPMailer(true);

// Kod üretiyoruz
$kodOlusturma1 = date('d.m.Y H:i:s');
$kodOlusturma2 = rand(0,20000);
$aktivasyonDogrKod = hash('sha256', $kodOlusturma2.$kodOlusturma1);

// Değişkenlerimizi tanımlıyoruz
$name = "";
$surname = "";
$email = "";
$password="";

// Fotoğraf için dosya yolumuzu belirtiyoruz ve gerekli değişkenleri atıyoruz
$hedef_klasor="../static/yuklenenler/";
$hedef_dosya=$hedef_klasor.basename($_FILES["fileToUpload"]["name"]);
$yuklemeyeUygunluk = 1;
$durum="";

// Dosyanın daha önceden yüklenip yüklenmediğini kontrol ediyoruz
if(file_exists($hedef_dosya)){
    $yuklemeyeUygunluk=0; 
    $durum.="Aynı dosya Var.";
}

// Boyutun 10MB'dan büyük olup olmadığını kontrol ediyoruz
if($_FILES["fileToUpload"]["size"]>10000000){
    $yuklemeyeUygunluk=0;
    $durum.="Dosya boyutu 10MB üstünde.";
}

// Yüklenmeye çalışılan dosyanın resim olup olmadığını kontrol ediyoruz
$resimKontrol=mime_content_type($_FILES["fileToUpload"]["tmp_name"]);
if(strpos($resimKontrol, "image") != false){
    $yuklemeyeUygunluk=0;
    $durum.="Resim dosyası değil.";
}

// Dosya uzantısı jpg, jpeg, png veya gif mi diye kontrol ediyoruz
$resimDosyaTur = strtolower(pathinfo($hedef_dosya,PATHINFO_EXTENSION));
if($resimDosyaTur!="jpg" && $resimDosyaTur!="jpeg" && $resimDosyaTur!="png" && $resimDosyaTur!="gif"){
    $yuklemeyeUygunluk=0;
    $durum.="png, jpg, jpeg ve gif uzantılı olmalı.";
}

// Bütün kontrollerden sorna uygunluk bir ise işlemleri gerçekleştiriyoruz
if($yuklemeyeUygunluk==1){
    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $hedef_dosya)){
        if(isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["email"]) && isset($_POST["password"])){
            if($_POST["name"] != "" && $_POST["surname"] != "" && $_POST["email"] != "" && $_POST["password"] != ""){
                // Gelen Değeri Değişkenlerimize Atıyoruz
                $name=$_POST["name"];
                $surname=$_POST["surname"];
                $email=$_POST["email"];
                $password=$_POST["password"];
                
                //Kayıt işlemi yapıyoruz
                $database->insert("385215_tbl_users", ["ad" => $name,"soyad" => $surname,"email" => $email, "sifre" => $password, "fotograf" => $hedef_dosya, "aktivasyon" => $aktivasyonDogrKod]);
                $son_eklenen_id = $database->id();
                if($son_eklenen_id>0){
                    #try-catch yapısını oluşturuyoruz ve e-posta gönderme işlemlerini gerçekleştiriyoruz
                    try {
                        //Server ayarlarını yapıyoruz
                        $mail->SMTPDebug = 0;                                         // Hata ayıklama çıktısını etkinleştirme SMTP::DEBUG_SERVER; etkinleştirir 0 boş döndürür
                        $mail->isSMTP();                                              // SMTP kullanarak gönderme
                        $mail->Host       = 'smtp.gmail.com';                         // SMTP sunucusunu gönderecek şekilde ayarlama
                        $mail->SMTPAuth   = true;                                     // SMTP kimlik doğrulamasını etkinleştirme
                        $mail->Username   = 'phpmaildeneme1@gmail.com';               // SMTP kullanıcı adı
                        $mail->Password   = 'php?deneme1';                            // SMTP şifresi
                        $mail->CharSet = 'utf-8';                                     // SMTP karakter düzenleme
                        $mail->SMTPSecure = 'tls';                                    // TLS şifrelemesini etkinleştirme; `PHPMailer :: ENCRYPTION_SMTPS` önerilir
                        $mail->Port       = 587;                                      // Bağlanılacak TCP bağlantı noktası, yukarıdaki `PHPMailer :: ENCRYPTION_SMTPS` için 465 kullanın Gmail için 587
                    
                        // Alıcı
                        $mail->setFrom('phpmaildeneme1@gmail.com', 'Kod Omega Chat Ailesi');
                        $mail->addAddress($email, $name.' '.$surname);           // Alıcı ekleme
                    
                        // İçerik
                        $mail->isHTML(true);                                  // E-posta biçimini HTML olarak ayarlama
                        $mail->Subject = 'Kod Omega Chat Hesap Aktivasyon İşlemi';
                        $mail->Body    ='<b>Kod Omega Chat</b> ailesine kayıt olduğunuz için teşekkür ederiz, <br> Hemen bizimle beraber eğlenmek için hesabınızı aktif etmeniz gerekmektedir. <br> Hesabınızı aktif etmek için <a href="http://localhost/385215/templates/layout/_aktifet.php?email='.$email.'&kod='.$aktivasyonDogrKod.'"><b>TIKLAYINIZ</b>.</a>';
                        $mail->AltBody = 'Kod Omega Chat tarafından Windows 10 üzerinden Posta ile gönderildi';
                        
                        // Mail gönderildiyse gösterilecek sayfa
                        if ($mail->send()){
                            echo '<link rel="stylesheet" href="../static/css/aktive.css">
                            <link rel="icon" type="image/jpeg" href="../static/img/kodomega.jpeg">
                            <div class="container" id="container">
                                <div class="form-container sign-up-container">
                                    <form action="../index.html" method="POST">
                                        <h1>Aktivasyon Kodunuz Mail Adresinize Gönderildi. Onay Bekleniyor..</h1>
                                    </form>
                                </div>
                            </div>';
                        }else {
                            echo '<link rel="stylesheet" href="../static/css/aktivehata.css">
                            <link rel="icon" type="image/jpeg" href="../static/img/kodomega.jpeg">
                            <div class="container" id="container">
                                <div class="form-container sign-up-container">
                                    <form action="../index.html" method="POST">
                                        <h1>Aktivasyon Kodunuz Mail Adresinize Gönderilemedi. Tekrar Deneyiniz.</h1>
                                        <button>Kayıt Ol</button>
                                    </form>
                                </div>
                            </div>';
                        }
                    } catch (Exception $e) {
                        echo '<link rel="stylesheet" href="../static/css/aktivehata.css">
                        <link rel="icon" type="image/jpeg" href="../static/img/kodomega.jpeg">
                            <div class="container" id="container">
                                <div class="form-container sign-up-container">
                                    <form action="../index.html" method="POST">
                                        <h1>Aktivasyon Kodunuz Mail Adresinize Gönderilemedi. '.$mail->ErrorInfo.'.</h1>
                                        <button>Kayıt Ol</button>
                                    </form>
                                </div>
                            </div>';
                    }                    
                }else{
                    echo '<link rel="stylesheet" href="../static/css/aktivehata.css">
                    <link rel="icon" type="image/jpeg" href="../static/img/kodomega.jpeg">
                    <div class="container" id="container">
                        <div class="form-container sign-up-container">
                            <form action="../index.html" method="POST">
                                <h1>Aktivasyon Kodunuz Mail Adresinize Gönderilemedi. Tekrar Deneyiniz.</h1>
                                <button>Kayıt Ol</button>
                            </form>
                        </div>
                    </div>';
                }
            }else{
                echo '<link rel="stylesheet" href="../static/css/aktivehata.css">
                <link rel="icon" type="image/jpeg" href="../static/img/kodomega.jpeg">
                    <div class="container" id="container">
                        <div class="form-container sign-up-container">
                            <form action="../index.html" method="POST">
                                <h1>Eksik alanlar var. Lütfen bilgileri eksiksiz doldurunuz.</h1>
                                <button>Kayıt Ol</button>
                            </form>
                        </div>
                    </div>';
            }
        }else {
            echo '<link rel="stylesheet" href="../static/css/aktivehata.css">
            <link rel="icon" type="image/jpeg" href="../static/img/kodomega.jpeg">
                        <div class="container" id="container">
                            <div class="form-container sign-up-container">
                                <form action="../index.html" method="POST">
                                    <h1>Girilen Değerler Gönderilemedi!</h1>
                                    <button>Kayıt Ol</button>
                                </form>
                            </div>
                        </div>';
        }
    }else {
        echo '<link rel="stylesheet" href="../static/css/aktivehata.css">
        <link rel="icon" type="image/jpeg" href="../static/img/kodomega.jpeg">
                    <div class="container" id="container">
                        <div class="form-container sign-up-container">
                            <form action="../index.html" method="POST">
                                <h1>HATA!</h1>
                                <button>Kayıt Ol</button>
                            </form>
                        </div>
                    </div>';
    }
}else{
    echo '<link rel="stylesheet" href="../static/css/aktivehata.css">
    <link rel="icon" type="image/jpeg" href="../static/img/kodomega.jpeg">
                    <div class="container" id="container">
                        <div class="form-container sign-up-container">
                            <form action="../index.html" method="POST">
                                <h1>Kriterler Sağlanamadı. '.$durum.' </h1>
                                <button>Kayıt Ol</button>
                            </form>
                        </div>
                    </div>';
}
?>
