<?php
if (isset($_GET['file'])) {
    $file = urldecode($_GET['file']);
    echo "<img src='uploads/$file' alt='Uploaded Image'>";
}
?>