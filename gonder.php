<?php
// --- AYARLAR ---
$token = "BOT_TOKEN_BURAYA"; // BotFather'dan aldığın token
$chat_id = "CHAT_ID_BURAYA"; // Senin chat id numaran
$site_mail = "bilgi@seninsiten.com"; // Sunucundaki mail

if ($_POST) {
    $isim  = htmlspecialchars($_POST['isim']);
    $email = htmlspecialchars($_POST['email']);
    $turu  = htmlspecialchars($_POST['olay_turu']);
    $konu  = htmlspecialchars($_POST['konu']);
    $mesaj = htmlspecialchars($_POST['mesaj']);
    $tarih = date("d.m.Y H:i:s");

    // 1. TELEGRAM GÖNDERİMİ
    $tgMsg = "🚨 *YENİ İHBAR (USOM+BİREYSEL)* 🚨\n";
    $tgMsg .= "👤 Bildiren: $isim\n📂 Tür: $turu\n🌐 Hedef: $konu\n📝 Detay: $mesaj";
    
    $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=".urlencode($tgMsg)."&parse_mode=Markdown";
    file_get_contents($url);

    // 2. USOM E-POSTA GÖNDERİMİ
    $usom_mail = "ihbar@usom.gov.tr";
    $subject = "Gönüllü Siber İhbar Raporu: $konu";
    $content = "Sayın Yetkili,\n\nGönüllü siber asistanlık portalı üzerinden bir ihbar alınmıştır:\n\n";
    $content .= "TÜR: $turu\nHEDEF: $konu\nBİLDİREN: $isim ($email)\nDETAYLAR: $mesaj\n\nBu e-posta siber güvenlik birimlerine destek amaçlı otomatik iletilmiştir.";
    
    $headers = "From: $site_mail\r\nReply-To: $email";
    mail($usom_mail, $subject, $content, $headers);

    echo "success";
}
?>
