<?php
include("../../config.php");

if(!isset($_POST['username'])) {
    echo "ERROR: could not set username ";
    exit();
}

if(!isset($_POST['oldPassword']) || !isset($_POST['newPassword1']) || !isset($_POST['newPassword1'])) {
    echo "not all passwords have been set";
    exit();
}

if($_POST['oldPassword'] == "" || $_POST['newPassword1'] == "" || $_POST['newPassword2'] == "") {
    echo "please fill in all fields";
    exit();
}

$username = $_POST['username'];
$oldPassword = $_POST['oldPassword'];
$newPassword1 = $_POST['newPassword1'];
$newPassword2 = $_POST['newPassword2'];

$oldMD5 = md5($oldPassword);
$passwordCheck = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND password='$oldMD5'");
if(mysqli_num_rows($passwordCheck) != 1) {
    echo "password is incorrect";
    exit();
}

if($newPassword1 != $newPassword2) {
    echo "your new passwords do not match";
    exit();
}

if(preg_match('/[^A-Za-z0-9]/', $newPassword1)) {
    echo "Your passwords must only contain letters and/or numbers";
    exit();
}

if(strlen($newPassword1) > 30 || strlen($newPassword1) < 5) {
    echo "5 < YOUR_PASSWORD < 30";
    exit();
}

$newMD5 = md5($newPassword1);

$query = mysqli_query($con, "UPDATE users SET password='$newMD5' WHERE username='$username'");
echo "update successful";
?>