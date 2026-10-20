<?php
require_once("includes/initialize.php");

if (!isset($_POST['savepassword'])) {
    redirect("index.php");
    exit;
}

$idno = $_SESSION['IDNO'];

// ✅ MATCH FORM FIELD NAMES EXACTLY
$oldPass     = trim($_POST['old_pass']);
$newPass     = trim($_POST['new_pass']);
$confirmPass = trim($_POST['confirm_pass']);

if ($newPass !== $confirmPass) {
    message("Passwords do not match!", "error");
    redirect("index.php");
    exit;
}

// OPTIONAL: verify old password
$student = new Student();
$user = $student->single_student($idno);

if (!$user || !password_verify($oldPass, $user->password)) {
    message("Old password is incorrect!", "error");
    redirect("index.php");
    exit;
}

// ✅ CHANGE PASSWORD
if (Student::changePassword($idno, $newPass)) {
    message("Password successfully changed!", "success");
} else {
    message("Failed to change password!", "error");
}

redirect("index.php");
