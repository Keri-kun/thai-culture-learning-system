<?php
/**
 * Visitor Counter API
 * เก็บข้อมูลผู้เข้าชมลงไฟล์ JSON (ไม่ต้องใช้ database)
 * ใช้ session ป้องกันการนับซ้ำจาก user เดียวกัน
 * 
 * Usage:
 *   GET counter.php?action=count  — นับผู้เข้าชมใหม่ + ส่งคืนข้อมูล
 *   GET counter.php?action=get    — ส่งคืนข้อมูลอย่างเดียว
 */

session_start();
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

$dataFile = __DIR__ . '/visitor_data.json';

// อ่านข้อมูลจากไฟล์ หรือสร้างใหม่ถ้ายังไม่มี
function loadData($file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $data = json_decode($content, true);
        if ($data !== null) {
            return $data;
        }
    }
    // ค่าเริ่มต้น
    return [
        'total' => 0,
        'today' => 0,
        'date' => date('Y-m-d')
    ];
}

// บันทึกข้อมูลลงไฟล์
function saveData($file, $data) {
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}


// ตั้งค่า timezone เป็นไทย
date_default_timezone_set('Asia/Bangkok');

$data = loadData($dataFile);

// รีเซ็ตตัวนับรายวันถ้าเป็นวันใหม่
$today = date('Y-m-d');
$isNewDay = false;

if ($data['date'] !== $today) {
    $data['today'] = 0;
    $data['date'] = $today;
    $isNewDay = true;
}

$action = isset($_GET['action']) ? $_GET['action'] : 'get';


if ($action === 'count') {
    // ตรวจสอบว่าเคยนับไปแล้วในวันนี้หรือยัง
    if (!isset($_SESSION['counted_date']) || $_SESSION['counted_date'] !== $today) {
        $data['total']++;
        $data['today']++;
        $_SESSION['counted_date'] = $today; // บันทึกวันที่นับล่าสุด
        saveData($dataFile, $data);
    } elseif ($isNewDay) {
        // ถ้าเป็นวันใหม่แต่ session เก่า (และเคยนับของวันเก่าไปแล้ว) 
        // ให้ update วันที่ในไฟล์ json เป็นวันนี้
        saveData($dataFile, $data);
    }
} elseif ($isNewDay) {
    // กรณี get เฉยๆ แต่เป็นวันใหม่ ก็ควร update วันที่ในไฟล์
    saveData($dataFile, $data);
}

// ส่งข้อมูลกลับ
echo json_encode([
    'total' => $data['total'],
    'today' => $data['today']
]);
