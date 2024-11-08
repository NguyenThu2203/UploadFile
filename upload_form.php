<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f3f3f3;
        }
        .upload-form {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
        }
        .upload-form h2 {
            color: #333;
        }
        .upload-form input[type="file"] {
            margin: 15px 0;
        }
        .upload-form button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        .upload-form button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php
        // Lấy giá trị của tham số status từ URL
        if(isset($_GET['status'])){
            if($_GET['status'] == 1)
                echo "<span id = 'tb' style = 'display:none'> Upload File thành công </span>"; 
            if($_GET['status'] == 01)
                echo "<span id = 'tb' style = 'display:none'> Lỗi không tải được file lên</span>"; 
            if($_GET['status'] == 02)
                echo "<span id = 'tb' style = 'display:none'>Lỗi định dạng file ! Hãy lựa chọn file có định dạng JPG, PNG, GIF </span>"; 
            if($_GET['status'] == 03)
                echo "<span id = 'tb' style = 'display:none'>Kích cỡ file tải lên có dung lượng nhỏ hơn hoặc bằng 2MB </span>"; 
            if($_GET['status'] == 04)
                echo "<span id = 'tb' style = 'display:none'>Chưa lựa chọn file nào! </span>"; 
        }
    ?>

    <div class="upload-form">
        <h2>Upload File</h2>
        <form id="uploadForm" action="process_upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name ="uploaded_image" accept="image/jpeg, image/png, image/gif">
            <button type="submit">Tải lên</button>
            <div id="errorMsg" class="error"></div>
        </form>
    </div>
    
    <!-- Hiển thị thông báo khi upload file -->
    <script>
        alert(document.getElementById('tb').innerHTML); 
    </script>
</div>

<!-- <div class="upload-form">
    <h2>Upload File</h2>
    <form id="uploadForm">
        <input type="file" id="fileInput" accept=".jpg, .jpeg, .png, .gif">
        <button type="button" onclick="validateFile()">Tải lên</button>
        <div id="errorMsg" class="error"></div>
    </form>
</div>

<script>
    function validateFile() {
        const fileInput = document.getElementById('fileInput');
        const errorMsg = document.getElementById('errorMsg');
        errorMsg.innerHTML = ""; // Xóa thông báo lỗi cũ

        if (fileInput.files.length === 0) {
            errorMsg.innerHTML = "Vui lòng chọn một file để tải lên.";
            return;
        }

        const file = fileInput.files[0];
        const validExtensions = ['image/jpeg', 'image/png', 'image/gif'];
        const maxSize = 2 * 1024 * 1024; // 2MB

        // Kiểm tra định dạng
        if (!validExtensions.includes(file.type)) {
            errorMsg.innerHTML = "Chỉ chấp nhận các định dạng file: .jpg, .jpeg, .png, .gif";
            return;
        }

        // Kiểm tra dung lượng
        if (file.size > maxSize) {
            errorMsg.innerHTML = "Dung lượng file không được vượt quá 2MB.";
            return;
        }

        // Nếu file hợp lệ
        alert("File hợp lệ! Đang tải lên...");
        // Gửi file lên server hoặc xử lý tiếp tại đây
    }
</script> -->

</body>
</html>
