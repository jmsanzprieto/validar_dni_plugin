<?php

function shortcode_validar_dni_form() {
    ob_start();
    ?>
    <form action="" method="post">
        <label for="dni">Ingrese su DNI:</label>
        <input type="text" name="dni" id="dni" required>
        <input type="submit" name="validar" value="Validar">
    </form>

    <?php
    if (isset($_POST['validar'])) {
        $dni_ingresado = sanitize_text_field($_POST["dni"]);

        if (validar_dni_espanol($dni_ingresado)) {
            $mensaje = "El DNI $dni_ingresado es válido.";
            $clase_alert = 'success';
        } else {
            $mensaje = "El DNI $dni_ingresado no es válido.";
            $clase_alert = 'danger';
        }
        ?>
        <div class="alert alert-<?php echo esc_attr($clase_alert); ?>" role="alert">
            <?php echo esc_html($mensaje); ?>
        </div>
        <?php
    }


    $output = ob_get_clean();
    return $output;
}

add_shortcode('dni_validator_form', 'shortcode_validar_dni_form');