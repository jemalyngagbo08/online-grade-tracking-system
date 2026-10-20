<?php
$escape = static function ($value) {
	return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};
?>
<section class="admin-account-page">
	<div class="admin-account-heading">
		<p class="admin-account-eyebrow">Account settings</p>
		<h1><?php echo $tab === 'password' ? 'Change Password' : 'Profile'; ?></h1>
		<p>Manage your administrator account details and access.</p>
	</div>

	<?php if ($accountFeedback !== '') { ?>
		<div class="alert alert-<?php echo $escape($accountFeedbackType); ?>" role="status">
			<?php echo $escape($accountFeedback); ?>
		</div>
	<?php } ?>

	<?php if ($tab === 'password') {
		if (!isset($_SESSION['admin_password_csrf'])) {
			$_SESSION['admin_password_csrf'] = bin2hex(random_bytes(32));
		}
	?>
		<div class="admin-account-card">
			<form action="account.php?tab=password" method="post" class="admin-password-form">
				<input type="hidden" name="csrf_token" value="<?php echo $escape($_SESSION['admin_password_csrf']); ?>">
				<div class="form-group">
					<label for="old-password">Current password</label>
					<input class="form-control" id="old-password" name="old_password" type="password" autocomplete="current-password" required>
				</div>
				<div class="form-group">
					<label for="new-password">New password</label>
					<input class="form-control" id="new-password" name="new_password" type="password" minlength="8" autocomplete="new-password" required>
					<small class="form-text text-muted">Use at least 8 characters.</small>
				</div>
				<div class="form-group">
					<label for="confirm-password">Confirm new password</label>
					<input class="form-control" id="confirm-password" name="confirm_password" type="password" minlength="8" autocomplete="new-password" required>
				</div>
				<button class="btn btn-primary" type="submit">Update Password</button>
			</form>
		</div>
	<?php } else { ?>
		<div class="admin-account-card">
			<dl class="admin-account-details">
				<div>
					<dt>Name</dt>
					<dd><?php echo $escape($_SESSION['ACCOUNT_NAME']); ?></dd>
				</div>
				<div>
					<dt>Username</dt>
					<dd><?php echo $escape($_SESSION['ACCOUNT_USERNAME']); ?></dd>
				</div>
				<div>
					<dt>Account type</dt>
					<dd><?php echo $escape($_SESSION['ACCOUNT_TYPE']); ?></dd>
				</div>
			</dl>
			<a class="btn btn-primary" href="account.php?tab=password">Change Password</a>
		</div>
	<?php } ?>
</section>
