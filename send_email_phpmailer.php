<?php
// Prevent any output before JSON immediately
ob_start();
error_reporting(0);
ini_set('display_errors', 0);

/**
 * send_email.php - PHPMailer Version for InfinityFree
 * This version uses PHPMailer with Gmail SMTP
 */

header('Content-Type: application/json; charset=utf-8');

// Check if PHPMailer is available
// Check if PHPMailer is available
if (!file_exists('PHPMailer-7.0.1/src/PHPMailer.php')) {
    ob_end_clean();
    echo json_encode([
        'success' => false, 
        'message' => 'PHPMailer library not found. Please check path: PHPMailer-7.0.1/src/',
        'help' => 'Ensure PHPMailer folder is present'
    ]);
    exit;
}

// Register shutdown function to catch fatal errors
register_shutdown_function(function() {
    $error = error_get_last();
    if ($error !== null && $error['type'] === E_ERROR) {
        ob_end_clean(); // Clean buffer
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'success' => false,
            'message' => 'PHP Fatal Error: ' . $error['message'],
            'file' => $error['file'],
            'line' => $error['line']
        ]);
        exit;
    }
});

// Load PHPMailer
require 'PHPMailer-7.0.1/src/PHPMailer.php';
require 'PHPMailer-7.0.1/src/SMTP.php';
require 'PHPMailer-7.0.1/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

// Get the raw POST data
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['email']) || !isset($input['pdfData']) || !isset($input['name'])) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
    exit;
}

$to = $input['email'];
$name = $input['name'];
$pdfData = $input['pdfData'];

// Validate email
if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
    exit;
}

// Clean base64 string
if (strpos($pdfData, ',') !== false) {
    $pdfData = explode(',', $pdfData)[1];
}
$pdfContent = base64_decode($pdfData);

if ($pdfContent === false || strlen($pdfContent) < 100) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Invalid PDF data.']);
    exit;
}

// SMTP Configuration - EDIT THESE VALUES
$smtp_host = 'smtp.gmail.com';
$smtp_port = 587;
$smtp_username = 'petburiculture@gmail.com';  // เปลี่ยนเป็นอีเมล Gmail ของคุณ
$smtp_password = 'fnzrgjnflniqdbay';      // ใส่ App Password จาก Google
$from_email = 'petburiculture@gmail.com';      // เปลี่ยนเป็นอีเมล Gmail ของคุณ
$from_name = 'ระบบเว็บสื่อการเรียนรู้ออนไลน์';

try {
    $mail = new PHPMailer(true);
    
    // Server settings
    $mail->isSMTP();
    $mail->Host = $smtp_host;
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_username;
    $mail->Password = $smtp_password;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $smtp_port;
    $mail->CharSet = 'UTF-8';
    
    // Recipients
    $mail->setFrom($from_email, $from_name);
    $mail->addAddress($to, $name);
    
    // Content
    $mail->isHTML(true);
    $mail->Subject = 'เกียรติบัตรของคุณ: ' . $name;
    $mail->Body = "
        <html>
        <body style='font-family: Arial, sans-serif;'>
            <h2>เรียนคุณ {$name},</h2>
            <p>ยินดีด้วย! คุณได้ผ่านหลักสูตร <strong>\"เพชรบุรีเมืองอาหารและการสืบสานงานสกุลช่าง\"</strong> เรียบร้อยแล้ว</p>
            <p>กรุณาตรวจสอบไฟล์เกียรติบัตรที่แนบมาพร้อมกับอีเมลฉบับนี้</p>
            <br>
            <p>ขอให้มีความภูมิใจในความเป็นไทยสืบไป</p>
            <br>
            <p>ขอแสดงความนับถือ,<br>
            <strong>สำนักงานวัฒนธรรมจังหวัดเพชรบุรี</strong></p>
        </body>
        </html>
    ";
    $mail->AltBody = "เรียนคุณ {$name},\n\nยินดีด้วย! คุณได้ผ่านหลักสูตรเรียบร้อยแล้ว\nกรุณาตรวจสอบไฟล์เกียรติบัตรที่แนบมาพร้อมกับอีเมลฉบับนี้\n\nขอแสดงความนับถือ,\nสำนักงานวัฒนธรรมจังหวัดเพชรบุรี";
    
    // Attachment
    $attachmentName = "Certificate_" . preg_replace('/[^a-zA-Z0-9ก-๙]/u', '_', $name) . ".pdf";
    $mail->addStringAttachment($pdfContent, $attachmentName, 'base64', 'application/pdf');
    
    // Send email
    ob_end_clean();
    $mail->send();
    
    echo json_encode([
        'success' => true, 
        'message' => 'ส่งอีเมลสำเร็จ! กรุณาตรวจสอบกล่องจดหมายของคุณ'
    ]);
    exit;
    
} catch (Exception $e) {
    ob_end_clean();
    echo json_encode([
        'success' => false, 
        'message' => 'ไม่สามารถส่งอีเมลได้',
        'error' => $mail->ErrorInfo,
        'help' => 'กรุณาตรวจสอบการตั้งค่า SMTP ใน send_email.php'
    ]);
    exit;
}
