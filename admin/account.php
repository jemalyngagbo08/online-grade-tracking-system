<?php
require_once("../includes/initialize.php");

if (!logged_in()) {
	redirect_to("login.php");
}

$tab = isset($_GET['tab']) && $_GET['tab'] === 'password' ? 'password' : 'profile';
$accountFeedback = '';
$accountFeedbackType = 'info';

if ($tab === 'password' && $_SERVER['REQUEST_METHOD'] === 'POST') {
	$token = isset($_POST['csrf_token']) ? (string) $_POST['csrf_token'] : '';
	$oldPassword = isset($_POST['old_password']) ? (string) $_POST['old_password'] : '';
	$newPassword = isset($_POST['new_password']) ? (string) $_POST['new_password'] : '';
	$confirmPassword = isset($_POST['confirm_password']) ? (string) $_POST['confirm_password'] : '';

	if (!isset($_SESSION['admin_password_csrf'])) {
		$_SESSION['admin_password_csrf'] = bin2hex(random_bytes(32));
	}

	if (!hash_equals($_SESSION['admin_password_csrf'], $token)) {
		$accountFeedback = 'Your form session expired. Please try again.';
		$accountFeedbackType = 'danger';
	} elseif ($oldPassword === '' || $newPassword === '' || $confirmPassword === '') {
		$accountFeedback = 'Complete all password fields to continue.';
		$accountFeedbackType = 'danger';
	} elseif (!hash_equals((string) $_SESSION['ACCOUNT_PASSWORD'], sha1($oldPassword))) {
		$accountFeedback = 'The current password you entered is incorrect.';
		$accountFeedbackType = 'danger';
	} elseif (strlen($newPassword) < 8) {
		$accountFeedback = 'Choose a new password with at least 8 characters.';
		$accountFeedbackType = 'danger';
	} elseif ($newPassword !== $confirmPassword) {
		$accountFeedback = 'The new password and confirmation do not match.';
		$accountFeedbackType = 'danger';
	} elseif (hash_equals(sha1($oldPassword), sha1($newPassword))) {
		$accountFeedback = 'Choose a new password different from your current password.';
		$accountFeedbackType = 'danger';
	} else {
		$newPasswordHash = sha1($newPassword);
		$accountId = (int) $_SESSION['ACCOUNT_ID'];
		$mydb->setQuery("UPDATE useraccounts SET ACCOUNT_PASSWORD='{$mydb->escape_value($newPasswordHash)}' WHERE ACCOUNT_ID={$accountId}");
		$mydb->executeQuery();

		$_SESSION['ACCOUNT_PASSWORD'] = $newPasswordHash;
		$_SESSION['admin_password_csrf'] = bin2hex(random_bytes(32));
		$accountFeedback = 'Your password has been changed.';
		$accountFeedbackType = 'success';
	}
}

$content = 'account_content.php';
require_once 'theme/templates.php';
?>
