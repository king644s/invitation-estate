<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';


// Only process POST reqeusts.
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Get the form fields and remove whitespace.
//     $name = strip_tags(trim($_POST["inputName"]));
//             $name = str_replace(array("\r","\n"),array(" "," "),$name);
//     $email = filter_var(trim($_POST["inputEmail"]), FILTER_SANITIZE_EMAIL);
//     //$phone = filter_var(trim($_POST["inputPhone"], FILTER_SANITIZE_NUMBER_INT);
//     $message = trim($_POST["inputMessage"]);

//     // Check that data was sent to the mailer.
//     if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         // Set a 400 (bad request) response code and exit.
//         http_response_code(400);
//         echo "Oops! There was a problem Please complete the form and try again.";
//         exit;
//     }

//     // Set the recipient email address.
//     // FIXME: Update this to your desired email address.
//     $recipient = "vatsal.3mindsdigital@gmail.com"; /** DON'T FORGET TO PUT YOUR EMAIL HERE **/

//     // Set the email subject.
//     $subject = "Invitation Estate New message from $name";

//     // Making email content
//     $email_content = "Name: $name\n";
//     $email_content .= "Email: $email\n\n";
//     $email_content .= "Message:\n$message\n";

//     // Making email headers
    // $email_headers = "From: $name <$email>";

//     // Sending email.
//     if (mail($recipient, $subject, $email_content, $email_headers)) {
//         // Seting a 200 (okay) response code.
//         http_response_code(200);
//         echo "Great ! Your message has been sent !!"; // You may edit this value with your own
//     } else {
//         // Setting a 500 (internal server error) response code.
//         http_response_code(500);
//         echo "Oops! Something wrong and we couldn't send your message.";
//     }

// } else {
//     // Not a POST request, set a 403 (forbidden) response code.
//     http_response_code(403);
//     echo "There was a problem with your input, please try again.";
// }

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp-relay.brevo.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'vatsal.3mindsdigital@gmail.com';                     //SMTP username
        $mail->Password   = 'Qy7pt9vdTkHE2IXx';                               //SMTP password
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        //Recipients
        $mail->setFrom('vatsal.3mindsdigital@gmail.com', 'Mailer');
        $mail->addAddress('vatsal.3mindsdigital@gmail.com', 'Mailer');     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('vatsal.3mindsdigital@gmail.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        $name = strip_tags(trim($_POST["inputName"]));
                    $name = str_replace(array("\r","\n"),array(" "," "),$name);
            $email = filter_var(trim($_POST["inputEmail"]), FILTER_SANITIZE_EMAIL);
            //$phone = filter_var(trim($_POST["inputPhone"], FILTER_SANITIZE_NUMBER_INT);
            $message = trim($_POST["inputMessage"]);

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "Web Enquiry from $name";
        
        $mail->Body    = "Name: $name\n  Email: $email\n\n  Message:\n$message\n" ;

        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';

        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {

    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "There was a problem with your input, please try again.";
}


?>