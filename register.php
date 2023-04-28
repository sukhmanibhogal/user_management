<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
// Database connection
$host = 'localhost';
$dbname = 'php_registration';
$user = 'root';
$password = '';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Form validation
$errors = array();

if (isset($_POST['username'], $_POST['email'], $_POST['phone'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Validate username
    if (strlen($username) < 3) {
        $errors[] = 'Username must be at least 3 characters long.';
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    // Check if email already exists in database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=:email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $errors[] = 'Email already exists.';
    }

    // If no errors, insert user data into database
    if (empty($errors)) {
        $code = rand(9999, 1000);
        $stmt = $conn->prepare("INSERT INTO users (name, email, mobile,code) VALUES (:name, :email, :mobile,:code)");
        $stmt->bindParam(':name', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mobile', $phone);
        $stmt->bindParam(':code', $code);
        $stmt->execute();



        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = 'smtp-email-here'; //SMTP username
            $mail->Password = 'password-here'; //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
            $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('email-here', 'Mailer');
            $mail->addAddress($email, 'Joe User');

            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = 'Email verification';
            $mail->Body = 'Your code ' . $code;

            $mail->send();

            $id = $conn->lastInsertId();
            ?>
            <script>
                alert('Please Verify your Email')
                window.location.href = 'verify.php?id=' + <?php echo $id ?>;
            </script>
            <?php
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }


    }
}

// Display errors
if (!empty($errors)) {
    echo '<div class="errors">';
    foreach ($errors as $error) {
        echo '<p>' . $error . '</p>';
    }
    echo '</div>';
}