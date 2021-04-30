<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer(true);
try {
    //data server

    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                   // Specify main and backup SMTP servers EXAMPLE smtp.gmail.com
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'reportesavicolamadrono@gmail.com';              // SMTP username user@gmail.com
    $mail->Password = 'avicolamadrono';                           // SMTP password 
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;

    //**//

    $mail->setFrom('reportesavicolamadrono@gmail.com'/* , 'Quevin Martinez' */);
    $mail->addAddress('reportesavicolamadrono@gmail.com');
    /* Correos d epersonas a las que les llega reportes */
    $mail->addAddress('loren.padilla@avicolaelmadrono.com');
    $mail->addAddress('martha.rivera@avicolaelmadrono.com');
    $mail->addAddress('planta.cartagena@avicolaelmadrono.com');
    $mail->addAddress('sismary.babilonia@avicolaelmadrono.com');
    $mail->addAddress('camila.vergara@avicolaelmadrono.com');
    $mail->addAddress('irma.rodriguez@avicolaelmadrono.com');
    $mail->addAddress('felix.causil@avicolaelmadrono.com');
    $mail->addAddress('ernesto.rios@avicolaelmadrono.com');
    $mail->addAddress('pablo.vergara@avicolaelmadrono.com');
    $mail->addAddress('maryl.martinez@avicolaelmadrono.com');
    $mail->addAddress('david.delahoz@avicolaelmadrono.com');
    /* $mail->addCC('[email recipient with hide copy]'); */
    $area = "<b>Logistica</b>";


    $mail->IsHTML(true);
    $mail->Subject  = "Reporte de exceso de Gasto";
    $mail->Body =  "<h1 style='color:red;'>Area Mantenimiento</h1><br>
                    <p>El Centro de costo " . $area . " acaba de superar el presupuesto de " . "$" . number_format($_SESSION["presupuestoLogistica"], 2, ",", ".") .
        " con un gasto actual de " . "$" . number_format($_SESSION["logisticatotal"], 2, ",", ".")  . " dejando un exceso de: "
        . " $" .  number_format($_SESSION["excesoLogistica"], 2, ",", ".") . " </p>";

    /**/
    $mail->send();

    //**//

    /* echo "Enviado correctamnete"; */
} catch (Exception $exception) {
    // HANDLE 
    echo "Error al enviar";
}
