<?php
// Hàm nén ảnh sử dụng GD Library với dung lượng 75%
function compressImage($source, $quality = 70) { // Giảm chất lượng xuống 75%
    // Lấy thông tin ảnh để xác định loại file
    $info = getimagesize($source);
    $mime = $info['mime'];

    // Tạo ảnh từ file nguồn và thực hiện nén
    if ($mime == 'image/jpeg') {
        $image = imagecreatefromjpeg($source);
        imagejpeg($image, $source, $quality); // Nén ảnh JPEG
    } elseif ($mime == 'image/png') {
        $image = imagecreatefrompng($source);
        // Chuyển đổi chất lượng từ 0-100 sang 0-9 cho PNG
        $pngQuality = 9 - round($quality / 10);
        imagepng($image, $source, $pngQuality); // Nén ảnh PNG
    } elseif ($mime == 'image/gif') {
        $image = imagecreatefromgif($source);
        imagegif($image, $source); // Nén ảnh GIF
    } else {
        return false; // Không hỗ trợ định dạng
    }

    // Giải phóng bộ nhớ sau khi xử lý
    imagedestroy($image);
}

// Tự động nén ảnh ngay khi được lưu
if (isset($_GET['compress_image']) && isset($_GET['path'])) {
    $path = $_GET['path'];
    compressImage($path);
}
?>