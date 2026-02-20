<?php
// send_email.php
// CRITICAL: Prevent any output before JSON response
ob_start();
error_reporting(0);
ini_set('display_errors', 0);

// Set header immediately
header('Content-Type: application/json; charset=utf-8');

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
$pdfData = $input['pdfData']; // Base64 string (data:application/pdf;base64,.....)

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

// Email details
$subject = "เกียรติบัตรของคุณ: " . $name;
$from = "no-reply@learning-platform.com";
$senderName = "Learning Platform";

// Boundary for multipart
$boundary = md5(time());

// Headers
$headers = "From: $senderName <$from>" . "\r\n";
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"" . "\r\n";

// Email Body
$message = "--$boundary" . "\r\n";
$message .= "Content-Type: text/plain; charset=UTF-8" . "\r\n";
$message .= "Content-Transfer-Encoding: 7bit" . "\r\n";
$message .= "\r\n";
$message .= "เรียนคุณ $name,\r\n\r\n";
$message .= "ยินดีด้วย! คุณได้ผ่านหลักสูตรเรียบร้อยแล้ว\r\n";
$message .= "กรุณาตรวจสอบไฟล์เกียรติบัตรที่แนบมาพร้อมกับอีเมลฉบับนี้\r\n\r\n";
$message .= "ขอแสดงความนับถือ,\r\n";
$message .= "ทีมงานผู้จัดทำ\r\n";
$message .= "\r\n";

// Attachment
$attachmentName = "Certificate_" . preg_replace('/[^a-zA-Z0-9ก-๙]/u', '_', $name) . ".pdf";
$message .= "--$boundary" . "\r\n";
$message .= "Content-Type: application/pdf; name=\"$attachmentName\"" . "\r\n";
$message .= "Content-Transfer-Encoding: base64" . "\r\n";
$message .= "Content-Disposition: attachment; filename=\"$attachmentName\"" . "\r\n";
$message .= "\r\n";
$message .= chunk_split($pdfData) . "\r\n";
$message .= "--$boundary--" . "\r\n";

// Clear any buffered output before sending
ob_end_clean();

// Send email
$mailSent = @mail($to, $subject, $message, $headers);

if ($mailSent) {
    echo json_encode(['success' => true, 'message' => 'Email sent successfully.']);
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'ไม่สามารถส่งอีเมลได้ เนื่องจาก XAMPP ยังไม่ได้ตั้งค่า SMTP Server',
        'help' => 'กรุณาตั้งค่า SMTP ใน php.ini หรือใช้ PHPMailer/SwiftMailer แทน'
    ]);
}
