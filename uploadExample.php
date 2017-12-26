


<form action="upload.php" method="post" enctype="multipart/form-data"> 
 <input type="file" name="myFile">
 <br>
 <input type="submit" value="Upload">
</form>


<?php

define("UPLOAD_DIR", "/srv/www/uploads/");

if (!empty($_FILES["myFile"])) {
    $myFile = $_FILES["myFile"];

    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo "<p>An error occurred.</p>";
        exit;
    }

    // ensure a safe filename
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

    // don't overwrite an existing file
    $i = 0;
    $parts = pathinfo($name);
    while (file_exists(UPLOAD_DIR . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }

    // preserve file from temporary directory
    $success = move_uploaded_file($myFile["tmp_name"],
        UPLOAD_DIR . $name);
    if (!$success) { 
        echo "<p>Unable to save file.</p>";
        exit;
    }

    // set proper permissions on the new file
    chmod(UPLOAD_DIR . $name, 0644);
}


// verify the file is a GIF, JPEG, or PNG
$fileType = exif_imagetype($_FILES["myFile"]["tmp_name"]);
$allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
if (!in_array($fileType, $allowed)) {
    // file type is not permitted
}


// verify the file is a PDF
$mime = "application/pdf; charset=binary";
exec("file -bi " . $_FILES["myFile"]["tmp_name"], $out);
if ($out[0] != $mime) {
    // file is not a PDF
}

//antivirus scan using ClamAV extension 
exec("clamscan --stdout " . $_FILES["myFile"]["tmp_name"], $out, $return);
if ($return) {
    // file is infected
}

?>

