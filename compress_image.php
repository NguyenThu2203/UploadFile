<?php
// Hàm nén ảnh sử dụng GD Library với dung lượng 75%
function compressImage($source, $quality = 75) {
    // Lấy thông tin ảnh để xác định loại file
    $info = getimagesize($source);
    $mime = $info['mime'];
    
    // Tạo tên file nén
    $arr_name = explode('.', $source);
    $file_ext = strtolower(end($arr_name));
    $base_name = pathinfo($source, PATHINFO_FILENAME);
    $final_destination = "img/" . $base_name . "_compressed." . $file_ext;

    // Tạo ảnh từ file nguồn và thực hiện nén
    if ($mime == 'image/jpeg') {
        $image = imagecreatefromjpeg($source);
        imagejpeg($image, $final_destination, $quality);
    } elseif ($mime == 'image/png') {
        $image = imagecreatefrompng($source);
    // Chuyển đổi chất lượng từ 0-100 sang 0-9 cho PNG
        $pngQuality = 9 - round($quality / 10);
        imagepng($image, $final_destination, $pngQuality);
    } elseif ($mime == 'image/gif') {
        $image = imagecreatefromgif($source);
        imagegif($image, $final_destination);
    } else {
        return false; // Không hỗ trợ định dạng
    }

    // Giải phóng bộ nhớ sau khi xử lý
    imagedestroy($image);
    return $final_destination; // Trả về đường dẫn file nén
}

// Tự động nén ảnh ngay khi được lưu
if (isset($_GET['compress_image']) && isset($_GET['path'])) {
    $path = $_GET['path'];
    compressImage($path);
}
?>
