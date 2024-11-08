<?php
function cropAndResizeImage($filePath, $outputPath, $cropWidth, $cropHeight) {
    // Kiểm tra thông tin ảnh
    $info = getimagesize($filePath);
    if ($info === false) {
        return false;
    }
    
    // Lấy kích thước gốc của ảnh
    list($width, $height) = $info;

    // Đảm bảo cropWidth và cropHeight không vượt quá kích thước ảnh gốc
    $cropWidth = min($cropWidth, $width);
    $cropHeight = min($cropHeight, $height);
    
    // Tạo ảnh nguồn theo định dạng
    $src = null;
    switch ($info['mime']) {
        case 'image/jpeg':
            $src = imagecreatefromjpeg($filePath);
            break;
        case 'image/png':
            $src = imagecreatefrompng($filePath);
            break;
        case 'image/gif':
            $src = imagecreatefromgif($filePath);
            break;
        default:
            return false; // Định dạng không được hỗ trợ
    }

    if (!$src) {
        return false;
    }
    
    // Tính toán vùng crop (lấy phần trung tâm)
    $cropX = ($width - $cropWidth) / 2;
    $cropY = ($height - $cropHeight) / 2;

    // Tạo ảnh đích
    $dst = imagecreatetruecolor($cropWidth, $cropHeight);

    // Xử lý độ trong suốt cho ảnh PNG và GIF
    if ($info['mime'] == 'image/png' || $info['mime'] == 'image/gif') {
        imagealphablending($dst, false);
        imagesavealpha($dst, true);
        $transparent = imagecolorallocatealpha($dst, 255, 255, 255, 127);
        imagefill($dst, 0, 0, $transparent);
    }

    // Thực hiện crop và resize
    imagecopyresampled($dst, $src, 0, 0, $cropX, $cropY, $cropWidth, $cropHeight, $cropWidth, $cropHeight);

    // Lưu ảnh đích
    switch ($info['mime']) {
        case 'image/jpeg':
            imagejpeg($dst, $outputPath);
            break;
        case 'image/png':
            imagepng($dst, $outputPath);
            break;
        case 'image/gif':
            imagegif($dst, $outputPath);
            break;
    }

    // Giải phóng bộ nhớ
    imagedestroy($src);
    imagedestroy($dst);

    return true;
}

// Sử dụng hàm
$filePath = 'img/ten_anh.jpg'; // Đường dẫn file upload ban đầu
$outputPath = 'img/ten_anh_resized.jpg'; // Đường dẫn lưu ảnh sau khi xử lý
cropAndResizeImage($filePath, $outputPath, 300, 300);
?>