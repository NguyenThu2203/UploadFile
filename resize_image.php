<?php
function resize_image($file, $width, $height) {
    $info = getimagesize($file['tmp_name']);
    $src = null;
    
    if ($info['mime'] == 'image/jpeg') {
        $src = imagecreatefromjpeg($file['tmp_name']);
    } elseif ($info['mime'] == 'image/png') {
        $src = imagecreatefrompng($file['tmp_name']);
    }
    
    $dst = imagecreatetruecolor($width, $height);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $info[0], $info[1]);
    
    if ($info['mime'] == 'image/jpeg') {
        imagejpeg($dst, $file['tmp_name']);
    } elseif ($info['mime'] == 'image/png') {
        imagepng($dst, $file['tmp_name']);
    }
    
    imagedestroy($src);
    imagedestroy($dst);
}

resize_image($file, 300, 300); // Resize ảnh thành 300x300

?>
