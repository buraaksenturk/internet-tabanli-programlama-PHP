<?php
// Medoo'yu çağırıyoruz
require '_base.php';

// Kayıt olmuş olan kullanıcıya giden maildeki yönlendirmeden değerler doğruysa aktif et kısmı 1'e dönüşüyor
if(isset($_GET["email"]) && isset($_GET["kod"])){
    $email=$_GET["email"];
    $aktivasyonDogrKod=$_GET["kod"];
    // Kayıtı çekiyoruz
    $user=$database->get("385215_tbl_users","users_id", ["AND" =>["email" => $email, "aktivasyon" => $aktivasyonDogrKod]]);
    if($user>0){
        //aktivasyon yap
        $data = $database->update("385215_tbl_users",["aktif_mi" => 1],["users_id" => $user]);
            echo '<link rel="stylesheet" href="../../static/css/aktifet.css">
            <link rel="icon" type="image/jpeg" href="../../static/img/kodomega.jpeg">
                <div class="container" id="container">
                    <div class="form-container sign-up-container">
                        <form action="../../index.html" method="POST">
                            <h1>Hesabınız aktif edildi. Aramıza katılmana çok sevindik. Hadi giriş yapalım <span style="font-size:100px;">&#128522;</span></h1>
                            <button>Giriş Yap</button>
                        </form>
                    </div>
                </div>';
    }else{
        header('Location: ../../index.html?m=kullanici_hata');
    }
    
}
?>
