<?php
if (isset($_FILES['uploaded_image'])) {
    $file = $_FILES['uploaded_image'];
    
    // Kiểm tra dung lượng và định dạng file
    include 'validate_file.php';
    
    // Nén ảnh
    include 'compress_image.php';
    
    // Crop hoặc resize ảnh
    include 'resize_image.php';
    
    // Lưu ảnh vào thư mục
    move_uploaded_file($file['tmp_name'], "uploads/" . $file['name']);
    
    // Chuyển hướng đến trang hiển thị ảnh
    header("Location: display_image.php?file=" . urlencode($file['name']));
}
?>