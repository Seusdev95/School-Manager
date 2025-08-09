<?php
// Evita el acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Devuelve una fecha en formato bonito: 3 de agosto de 2025
 */
function sm_format_fecha_bonita($fecha) {
    setlocale(LC_TIME, 'es_ES.UTF-8');
    return strftime('%e de %B de %Y', strtotime($fecha));
}

/**
 * Calcula el pago al profesor basado en porcentaje
 */
function sm_calcular_pago_profesor($precio_clase, $porcentaje = 70) {
    return ($precio_clase * $porcentaje) / 100;
}

/**
 * Valida si un campo está vacío y devuelve un mensaje
 */
function sm_validar_campo_obligatorio($campo, $nombre = "Campo") {
    if (empty($campo)) {
        return $nombre . " es obligatorio.";
    }
    return "";
}