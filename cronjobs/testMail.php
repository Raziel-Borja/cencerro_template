<?php
$para = "irving@cencerro.com.mx";
$asunto = "Prueba simple de PHP mail()";
$mensaje = "Hola Irving,\n\nEste es un correo de prueba desde HostGator usando mail().";
$cabeceras = "From: notificaciones@cencerro.net\r\n";

if (mail($para, $asunto, $mensaje, $cabeceras)) {
    echo "✅ Correo enviado correctamente.";
} else {
    echo "❌ Error al enviar el correo.";
}
?>
