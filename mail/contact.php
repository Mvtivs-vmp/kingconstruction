<?php
// Verificar si los campos están vacíos o si el email no es válido
if(empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400); // Cambiar a 400 Bad Request
    echo "Por favor complete todos los campos correctamente.";
    exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$to = "rosas.matias1655@gmail.com"; // Cambiar a tu email
$subject = "$m_subject:  $name";
$body = "Has recibido un nuevo mensaje desde el formulario de contacto de tu sitio web.\n\nAquí están los detalles:\n\nNombre: $name\n\nEmail: $email\n\nAsunto: $m_subject\n\nMensaje: $message";

// Encabezados de correo
$header = "From: $email\r\n";
$header .= "Reply-To: $email\r\n";
$header .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Enviar el correo
if(!mail($to, $subject, $body, $header)) {
    http_response_code(500); // Internal Server Error
    echo "No se pudo enviar el mensaje. Inténtalo de nuevo más tarde.";
}
?>
