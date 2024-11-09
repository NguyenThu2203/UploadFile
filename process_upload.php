<?php

if (isset($_FILES['uploaded_image'])) {
    $errors = array();
    // Lấy các thông tin file
    $file_name = $_FILES['uploaded_image']['name'];
    $file_size = $_FILES['uploaded_image']['size']; 
    $file_tmp = $_FILES['uploaded_image']['tmp_name']; 
    $file_type = $_FILES['uploaded_image']['type']; 

    // Lấy phần mở rộng của file
    $arr_name = explode('.', $file_name); 
    $file_ext = strtolower(end($arr_name));

    $extensions = array("jpg", "png", "gif"); 

    if (empty($file_name)) {
        header("location:upload_form.php?status=04");
        exit; 
    } else {
        if (!in_array($file_ext, $extensions)) {
            $errors[] = "Lỗi định dạng file! Hãy lựa chọn file có định dạng JPG, PNG, GIF"; 
            header("location:upload_form.php?status=02"); 
            exit;
        }

        // Giới hạn file tải lên <= 1MB    
        if ($file_size > 1048576) { // 1MB = 1048576 bytes
            $errors[] = 'Kích cỡ file tải lên có dung lượng nhỏ hơn hoặc bằng 1MB'; 
            header("location:upload_form.php?status=03"); 
            exit;
        }

        // Xử lý tên file và di chuyển vào folder
        if (empty($errors)) {
            // Sử dụng timestamp để tạo tên file duy nhất
            $timestamp = time(); // Lấy timestamp hiện tại
            $base_name = "Hình ảnh_" . $timestamp; // Tạo tên file
            $destination = "img/" . $base_name;
            $final_destination = $destination . "." . $file_ext;

            // Di chuyển file vào folder
            move_uploaded_file($file_tmp, $final_destination); 

            // Nén ảnh
            include 'compress_image.php';
            compressImage($final_destination); // Nén ảnh

            header("location:upload_form.php?status=1");
        } else {
            // Chuyển hướng về trang upload và hiển thị lỗi
            header("location:upload_form.php?status=error&message=" . urlencode(implode(", ", $errors)));
            exit;
        }
    }
} else {
    header("location:upload_form.php?status=01"); 
    exit;
}
?>