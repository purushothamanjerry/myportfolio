<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Check if form is submitted and capture data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $gmail = $_POST['email'];
    $message = $_POST['message'];

    // Check if email is valid
    if (filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'purushothamanjerry@gmail.com';
            $mail->Password = 'cmij nazv dinn ryop';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Set the sender's email address and name
            $mail->setFrom('purushothamanjerry@gmail.com', 'Your Name');
            $mail->addAddress('purushothamanjerry@gmail.com');

            // Set email format to HTML
            $mail->isHTML(true);
            $mail->Subject = 'Message from ' . $name;
            $mail->Body = "<h1>Message from $name</h1><p>Email: $gmail</p><p>Message: $message</p>";
            $mail->AltBody = "Message from $name\n\nEmail: $gmail\n\nMessage: $message";

            $mail->send();
            echo '<script>alert("Your message has been sent successfully."); window.location.href = "index.html";</script>';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error: Invalid email address.";
    }
} else {
    echo "Error: Form was not submitted correctly.";
}
?>
