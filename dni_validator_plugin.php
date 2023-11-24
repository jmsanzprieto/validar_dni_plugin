
<?php
/*
Plugin Name: DNI Validator
Description: Plugin para validar DNI.
Version: 1.0
Author: Jose Manuel Sanz
*/


// Llamamos a las de funciones del proyecto
include('shortcode_dni_validator.php');
include('procesar_dni_validator.php');

// Enqueue de estilos en tu archivo principal del plugin
function enqueue_plugin_styles() {
      wp_enqueue_style('dni_validator-estilos', plugins_url('estilos_dni_validator.css', __FILE__));
}

// Engancha la función para enqueue en el hook 'wp_enqueue_scripts' (no se como explicarlo más claro, jejeje)
add_action('wp_enqueue_scripts', 'enqueue_plugin_styles');


function validar_dni_espanol($documento) {

    // Expresión regular para validar el formato del DNI y NIE
    $patron_dni_nie = "/^[XYZ0-9][0-9]{7}[A-Za-z]$/";


    if (preg_match($patron_dni_nie, $documento)) {
        // Extraer los dígitos y la letra del DNI/NIE
        $letra = strtoupper(substr($documento, -1));

        if ($documento[0] === 'X' || $documento[0] === 'Y' || $documento[0] === 'Z') {
            // NIE: Añadir 0, 1 o 2 al inicio para el cálculo
            $digitos = ($documento[0] === 'X') ? '0' . substr($documento, 1, 7) : (($documento[0] === 'Y') ? '1' . substr($documento, 1, 7) : '2' . substr($documento, 1, 7));
        } else {
            // DNI
            $digitos = substr($documento, 0, 8);
        }

        // Calcular la letra correspondiente a los dígitos
        $letras_validas = "TRWAGMYFPDXBNJZSQVHLCKE";

        // Verificar que la letra sea válida
        $posicion_letra_valida = $digitos % 23;

        if ($letra === $letras_validas[$posicion_letra_valida]) {
            return true;
        }
    }

    return false;
}








?>
