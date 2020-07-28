<?php
session_start();
require_once  '../Connection/connectionDB.php';

$usernameprofile = $_SESSION["ID"];
$Imageid;
//dapatin id image dari file
if ($_FILES["fileToUpload"]["tmp_name"] != '') {
    $target_dir = "../Images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists please rename your file.";
        $querycek = "SELECT * FROM profiles where username = '". $usernameprofile ."'";
        $resultcek = mysqli_query($db, $querycek);
        $rowcek = $resultcek->fetch_assoc();
        $Imageid = $rowcek["id_image"];
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 2097152) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG & PNG  files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $Imageid = basename($_FILES["fileToUpload"]["name"]);
            //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    $Imageid =  '';
}

//masukin data yang mau diupdate ke database
$fname = $_POST["Fname"];
$lname = $_POST["Lname"];
$Location = $_POST["location"];
$website = $_POST["website"];
$bio = $_POST["bio"];
$birthdate = $_POST["birthdate"];

$query = "UPDATE profiles SET
                    first_name = '$fname',
                    last_name = '$lname',
                    location = '$Location',
                    website = '$website',
                    bio = '$bio',
                    birthdate = '$birthdate',
                    id_image = '$Imageid'
                where username ='$usernameprofile'";

if ($db->query($query) === TRUE) {
    echo ("<script>alert(\"Update Success\");</script>");
    sleep(5);
    header("Location:../main.php");
    exit;
} else {
    echo "Error updating record: " . $db->error;
}


    
    


?>