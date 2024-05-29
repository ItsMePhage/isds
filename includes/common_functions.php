<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'dompdf/autoload.inc.php';

function sendEmail($sendTo, $subject, $content)
{
    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'dti6.mis@gmail.com';
    $mail->Password = 'yepzyaoulceepexj';
    $mail->SMTPSecure = 'tls';
    $mail->isHTML(true);
    $mail->setFrom('dti6.mis@gmail.com', 'MIS Administrator');
    $mail->addAddress($sendTo);
    // $mail->AddBCC('angelopatrimonio@dti.gov.ph');
    // $mail->AddBCC('bemyjohncollado@dti.gov.ph');
    $mail->AddBCC('dace.phage@gmail.com');
    $mail->Subject = $subject;
    $mail->Body = $content;
    $mail->send();
}

function encryptID($id, $key)
{
    $iv = substr(md5($key), 0, 16);
    $encrypted = openssl_encrypt($id, 'AES-256-CBC', $key, 0, $iv);
    $safeEncoded = base64_encode($encrypted);
    $chunks = str_split($safeEncoded, 4);

    return implode('-', $chunks);
}

function decryptID($encrypted, $key)
{
    $chunks = explode('-', $encrypted);
    $safeEncoded = implode('', $chunks);
    $encrypted = base64_decode($safeEncoded);
    $iv = substr(md5($key), 0, 16);
    $decrypted = openssl_decrypt($encrypted, 'AES-256-CBC', $key, 0, $iv);

    return $decrypted;
}

function verifyCaptcha($recaptchaResponse, $secretKey)
{
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => $secretKey,
        'response' => $recaptchaResponse
    );

    $options = array(
        'http' => array(
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $responseData = json_decode($response, true);
    return $responseData['success'];
}

function generatePassword()
{
    $characters = '012345678AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz';
    $password = '';
    $length = 6;

    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $password;
}

function calculateAge($date_birth)
{
    $birthday = new DateTime($date_birth);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthday);

    return $age->y;
}

function calculateDateOfBirth($age)
{
    $currentDate = new DateTime();
    $birthday = $currentDate->sub(new DateInterval('P' . $age . 'Y'));

    return $birthday->format('Y-m-d');
}

function generatePDF($html)
{

    $dompdf = new Dompdf();

    ob_start();
    include $html;
    $html = ob_get_clean();

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'landscape');

    $dompdf->render();

    $dompdf->stream('hakdog.pdf', array('Attachment' => false));
}