<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';
use ICal\ICal;

// 🔹 CONEXIÓN A BD
$dbhost = "127.0.0.1";
$dbuser = "root";
$dbpass = '';
$db = "plataforma_base";
$conn = new mysqli($dbhost, $dbuser, $dbpass, $db);
if ($conn->connect_error) die("Error conexión: " . $conn->connect_error);

// 🔹 URLs de calendarios Airbnb
$calendarios = [
    'https://www.airbnb.mx/calendar/ical/22507191.ics?s=75b5a508d214760f29e93f0698b532b4' => 'SF 214',
    'https://www.airbnb.mx/calendar/ical/729050873355380408.ics?s=f6889ab96e98cab1a5f0e6adebbd6242' => 'Mazatlán',
    'https://www.airbnb.mx/calendar/ical/38232293.ics?s=1b854e129bc4043d4872910580d5d6c8' => 'SF 507',
    'https://www.airbnb.mx/calendar/ical/44941876.ics?s=84f5eff6fce7f87528421af98dc7a075' => 'ATL 104',
    'https://www.airbnb.mx/calendar/ical/1047039446123360071.ics?s=6c692902ba0bf5d9551f690f40ec7855' => 'AO 302',
];

// 🔹 Extraer huésped desde la descripción o título
function extraerHuesped($descripcion, $titulo) {

    // Caso 1: aparece "Guest: ..."
    if (preg_match('/Guest:\s*(.+)/i', $descripcion, $m)) {
        return trim($m[1]);
    }

    // Caso 2: Airbnb deja el nombre en el título
    if (preg_match('/\((.*?)\)$/', $titulo, $m)) {
        return trim($m[1]);
    }

    return "Huésped desconocido";
}

// 🔹 Leer archivo ICS
function getReservas($url) {
    try {
        $ical = new ICal($url, ['defaultTimeZone' => 'America/Mexico_City']);
        $events = $ical->events();
        $reservas = [];

        foreach ($events as $event) {
            $reservas[] = [
                'uid' => $event->uid ?? uniqid(),
                'inicio' => $ical->iCalDateToDateTime($event->dtstart)->format('Y-m-d H:i:s'),
                'fin' => $ical->iCalDateToDateTime($event->dtend)->format('Y-m-d H:i:s'),
                'titulo' => $event->summary ?? '',
                'descripcion' => $event->description ?? ''
            ];
        }
        return $reservas;

    } catch (Exception $e) {
        echo "❌ Error leyendo calendario: {$e->getMessage()}\n";
        return [];
    }
}

// 🔹 Guardar reservas en BD
function saveReservas($conn, $reservas) {
    $sql = "INSERT INTO reservas (uid, inicio, fin, titulo, descripcion, departamento, huesped)
            VALUES (?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
                inicio=VALUES(inicio), fin=VALUES(fin),
                titulo=VALUES(titulo), descripcion=VALUES(descripcion),
                departamento=VALUES(departamento), huesped=VALUES(huesped)";
    $stmt = $conn->prepare($sql);

    foreach ($reservas as $r) {

        // Sanitizar strings (evita errores)
        $r['titulo'] = $conn->real_escape_string($r['titulo']);
        $r['descripcion'] = $conn->real_escape_string($r['descripcion']);
        $r['departamento'] = $conn->real_escape_string($r['departamento']);

        $stmt->bind_param("sssssss",
            $r['uid'], $r['inicio'], $r['fin'],
            $r['titulo'], $r['descripcion'],
            $r['departamento'], $r['huesped']
        );
        $stmt->execute();
    }
}

// 🔹 Generar limpiezas (solo las que faltan)
function generarLimpiezas($conn) {
    $sql = "
        INSERT INTO limpiezas (reserva_uid, fecha_limpieza, hora_limpieza, departamento, huesped)
        SELECT uid, DATE(fin), TIME(fin), departamento, huesped
        FROM reservas
        WHERE DATE(fin) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 DAY)
        AND uid NOT IN (SELECT reserva_uid FROM limpiezas)
    ";
    $conn->query($sql);
}

// ---------------------------------------------------------------
// 🔹 PROCESO PRINCIPAL
// ---------------------------------------------------------------

$todas = [];

foreach ($calendarios as $url => $departamentoNombre) {

    $reservas = getReservas($url);

    foreach ($reservas as &$r) {

        // Asignar el departamento
        $r['departamento'] = $departamentoNombre;

        // Extraer huésped
        $r['huesped'] = extraerHuesped($r['descripcion'], $r['titulo']);
    }

    $todas = array_merge($todas, $reservas);
}

if (!empty($todas)) {

    saveReservas($conn, $todas);
    generarLimpiezas($conn);

    // Obtener limpiezas de hoy
    $limpiezasHoy = $conn->query("
        SELECT fecha_limpieza, hora_limpieza, departamento, huesped
        FROM limpiezas
        WHERE DATE(fecha_limpieza) = CURDATE()
        ORDER BY hora_limpieza ASC
    ");

    if ($limpiezasHoy->num_rows > 0) {

        $mensaje = "🧹 *Limpiezas programadas para hoy*\r\n\r\n";

        while ($row = $limpiezasHoy->fetch_assoc()) {

            $mensaje .= "🏠 Departamento: {$row['departamento']}\r\n";
            $mensaje .= "👤 Huésped: " . ($row['huesped'] ?: "N/A") . "\r\n";
            $mensaje .= "📆 Fecha: {$row['fecha_limpieza']}\r\n";
            $mensaje .= "⏰ Hora estimada: {$row['hora_limpieza']}\r\n";
            $mensaje .= "-------------------------\r\n\r\n";
        }

        // 🔹 Configurar correo
        $para = "irving@cencerro.com.mx";
        $asunto = "Limpiezas programadas hoy";

        $cabeceras = "From: notificaciones@cencerro.net\r\n";
        $cabeceras .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $cabeceras .= "Content-Transfer-Encoding: 8bit\r\n";

        mail($para, $asunto, $mensaje, $cabeceras);
    }

    echo "✅ Reservas y limpiezas actualizadas.\n";

} else {
    echo "⚠️ No se encontraron eventos.\n";
}

$conn->close();
