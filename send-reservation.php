<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $customer_name = $_POST['customer_name'];
    $service = $_POST['service'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $duration = $_POST['duration'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    if (empty($customer_name) || empty($service) || empty($date) || empty($time) || empty($duration) || empty($phone) || empty($email)) {
        die('Error: All fields are required.');
    }


    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'error404gandsl@gmail.com';
        $mail->Password = 'becq aqrv omhf ulty';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587; 

        $mail->setFrom('error404gandsl@gmail.com', 'Error 404 Gaming & Study Lounge');
        $mail->addAddress('error404gandsl@gmail.com');


        $mail->isHTML(true);
        $mail->Subject = 'New Reservation Request';
        $mail->Body    = "Customer Name: $customer_name<br>Service: $service<br>Date: $date<br>Time: $time<br>Duration: $duration hours<br>Phone: $phone<br>Email: $email";

        $mail->send();

        $mail->clearAddresses();
        $mail->addAddress($email);


        $mail->Subject = 'Thank You for Your Reservation';
        $mail->Body    = "Dear $customer_name,<br><br>Thank you for making a reservation with Error 404 Gaming & Study Lounge!<br>Your reservation for a $service on $date at $time for $duration hour(s) is being processed. We will contact you shortly regarding the availability and payment.<br><br>Best regards,<br>Error 404 Gaming & Study Lounge";

        $mail->send();

        header("Location: submitted.html");
        exit;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Error: Invalid request method.";
}
?>