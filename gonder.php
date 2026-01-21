<?php
$token = "8412069744:AAH8tnhlIEujbQs6l9xayz4RH1pcK33NWv8"; 
$chat_id = "7038362008"; 

if ($_POST) {
    $isim  = htmlspecialchars($_POST['isim']);
    $email = htmlspecialchars($_POST['email']);
    $turu  = htmlspecialchars($_POST['olay_turu']);
    $konu  = htmlspecialchars($_POST['konu']);
    $mesaj = htmlspecialchars($_POST['mesaj']);

    $tgMsg = "🚨 *ÜCRETSİZ PORTAL - YENİ İHBAR* 🚨\n";
    $tgMsg .= "👤 Bildiren: $isim\n📂 Tür: $turu\n🌐 Hedef: $konu\n📝 Detay: $mesaj";
    
    // Telegram'a gönder
    $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=".urlencode($tgMsg)."&parse_mode=Markdown";
    
    // Ücretsiz hostinglerde file_get_contents bazen kapalıdır, curl deneyelim
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);

    echo "success";
}
?>
