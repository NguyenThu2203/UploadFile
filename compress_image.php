<?php
function compress_image($file, $quality) {
    $info = getimagesize($file['tmp_name']);
    
    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($file['tmp_name']);
        imagejpeg($image, $file['tmp_name'], $quality);
    } elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($file['tmp_name']);
        imagepng($image, $file['tmp_name'], round($quality / 10));
    }
    
    imagedestroy($image);
}

compress_image($file, 75); // Nén với chất lượng 75%
?>