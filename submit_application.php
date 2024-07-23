<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["resume"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is a valid resume file type
    if($fileType != "pdf" && $fileType != "doc" && $fileType != "docx") {
        echo "Sorry, only PDF, DOC, and DOCX files are allowed.";
        $uploadOk = 0;
    }

    // Check file size (limit to 5MB)
    if ($_FILES["resume"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["resume"]["name"]). " has been uploaded.";

            // Save application details to a file (or database)
            $application_data = "Name: $name\nEmail: $email\nPhone: $phone\nAddress: $address\nResume: $target_file\n\n";
            file_put_contents("applications.txt", $application_data, FILE_APPEND);

            echo "Application submitted successfully!";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
