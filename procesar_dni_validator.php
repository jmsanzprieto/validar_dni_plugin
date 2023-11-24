<?php

function procesar_formulario_dni() {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $dni_ingresado = sanitize_text_field($_POST["dni"]);
    }
}
add_action('init', 'procesar_formulario_dni');