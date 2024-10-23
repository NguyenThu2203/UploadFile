<?php
$allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
$max_size = 2 * 1024 * 1024; // 2MB

if ($file['size'] > $max_size) {
    die("File quá lớn. Giới hạn là 2MB.");
}

if (!in_array($file['type'], $allowed_types)) {
    die("Chỉ chấp nhận định dạng JPG, PNG, GIF.");
}

?>
