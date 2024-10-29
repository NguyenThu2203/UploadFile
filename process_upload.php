<?php
if (isset($_FILES['uploaded_image'])) {
    $errors = array();
    //Lấy các thông tin file
    $file_name = $_FILES['uploaded_image']['name'];
    $file_size = $_FILES['uploaded_image']['size']; 
    $file_tmp = $_FILES['uploaded_image']['tmp_name']; 
    $file_type = $_FILES['uploaded_image']['type']; 

    //lấy phần mở rộng của file
    $arr_name = explode('.', $file_name); 
    //Chuyển phần mở rộng thành chữ thường
    $file_ext1 = $arr_name[count($arr_name) - 1]; 
    $file_ext = strtolower(($file_ext1));
    //echo "File Extension :" .$file_ext; 

    $extensions = array( "jpg", "png", "gif"); 

    if (empty($_FILES['uploaded_image']['name'])) {
        header("location:upload_form.php?status=04");
        exit; 
    }
    else {
        if(in_array($file_ext, $extensions) == false){
        $errors[] = " Lỗi định dạng file ! Hãy lựa chọn file có định dạng JPG, PNG, GIF "; 
        header ("location:upload_form.php?status=02"); 
        }

        //Giới hạn file tải lên <= 2MB    
        if($file_size > 2097192){
            $errors[] = 'Kích cỡ file tải lên có dung lượng <= 2MB'; 
            header ("location:upload_form.php?status=03"); 
        }
        
        //Xử lý tên file và di chuyển vào folder
        if(empty($errors) == true){
            $counter = 1;
            $base_name = "Hình ảnh";
            $destination = "img/" . $base_name . $counter;
            while (glob($destination . ".*")) {
                $counter++;
                $destination = "img/" . $base_name . $counter;
            } 
            $final_destination = $destination . "." . $file_ext;
            //di chuyển file vào folder
            move_uploaded_file($file_tmp, $final_destination); 

            header ("location:upload_form.php?status=1"); 
        }
        else
        var_dump($errors); 
    }
}
else
    echo "Lỗi"; 
    header ("location:upload_form.php?status=01"); 


    // // Kiểm tra dung lượng và định dạng file
    // include 'validate_file.php';
    
    // // Nén ảnh
    // include 'compress_image.php';
    
    // // Crop hoặc resize ảnh
    // include 'resize_image.php';
    
    // // Lưu ảnh vào thư mục
    // move_uploaded_file($file['tmp_name'], "uploads/" . $file['name']);
    
    // // Chuyển hướng đến trang hiển thị ảnh
    // header("Location: display_image.php?file=" . urlencode($file['name']));
?>