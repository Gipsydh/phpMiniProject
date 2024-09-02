<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'mailer/src/Exception.php';
require 'mailer/src/PHPMailer.php';
require 'mailer/src/SMTP.php';

if (isset($_POST['send'])) {

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ecommercenode11@gmail.com';
    $mail->Password = 'mqcqzgtmtzvowqhw';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('ecommercenode11@gmail.com');
    $mail->addAddress($_POST['email']);
    $mail->isHTML(true);
    $mail->Subject = 'Your One Time Password';
    $mail->Body = $_POST['otp'] . ' is your OTP.';
    $verifyotp = $_POST['otp'];
    if ($mail->send()) {

        echo '<script>alert("Email is sent successfully.")</script>';
    } else {
        echo '<script>alert("Email is not sent. Please try again.")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP verification</title>
    <link rel="icon" href="icons8-favicon-96.png" type="image/png" />
    <link rel="stylesheet" href="verifyotp.css" />
</head>

<body>
    <div class="container">
        <div class="login-form">
            <div class="logo">
                <img src="logo.jpg" alt="Logo" />
            </div>
            <h2>OTP Verification</h2>
            <form action="submitotp.php" method="post">
                <div class="input-group">
                    <input
                        type="number"
                        name="checkotp"
                        placeholder="Enter your 6 digit OTP"
                        required />

                    <input type="hidden" name="verifyotp" value="<?php echo $verifyotp; ?>">
                </div>
                <button type="submit">Verify</button>
            </form>
        </div>
        <div class="graphics"></div>
    </div>
</body>

</html>