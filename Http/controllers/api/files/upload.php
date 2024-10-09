<?php

// File upload handler for /api/files/upload

// Set upload directory
$uploadDir = __DIR__ . '/../../../../public/';

$currentYear = date("Y");
$currentMonth = date("m");
$currentDay = date("d");
$currentHour = date("H");

$uploadPath = "assets/images/".$currentYear."/".$currentMonth."/".$currentDay."/".$currentHour."/";
$uploadDir.= $uploadPath;

// Check if upload directory exists, if not create it
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if files were uploaded
    if (empty($_FILES)) {
        http_response_code(400);
        return ['error' => 'No files were uploaded.'];
    }

    $responses = [];

    foreach ($_FILES as $file) {
        // Check for upload errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $responses[] = [
                'name' => $file['name'],
                'error' => 'Upload error code: ' . $file['error'],
            ];
            continue;
        }

        // Sanitize the file name
        $fileName = basename($file['name']);
        $targetFilePath = $uploadDir . $fileName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            $responses[] = [
                'name' => $file['name'],
                'status' => 'Uploaded successfully',
                'path' => $uploadPath . $fileName
            ];
        } else {
            $responses[] = [
                'name' => $file['name'],
                'error' => 'Failed to move uploaded file.'
            ];
        }
    }

    return $responses;
}

// Handle unsupported request methods
http_response_code(405);
return ['error' => 'Method not allowed.'];
