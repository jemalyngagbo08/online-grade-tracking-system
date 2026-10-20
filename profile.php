<?php
check_message();

$student = new Student();
$cur = $student->single_student($_SESSION['IDNO']);
$escape = static function ($value) {
	return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
};
?>

<style>
	.student-profile {
		min-height: 70vh;
		padding: 112px 0 64px;
		background: linear-gradient(145deg, #eaf3ff 0%, #f5f8fc 52%, #e8f2f5 100%);
	}

	.student-profile .profile-heading {
		margin-bottom: 28px;
		color: #183b56;
		font-size: 30px;
		font-weight: 600;
	}

	.student-profile .profile-card {
		overflow: hidden;
		margin-bottom: 24px;
		border: 1px solid #e5edf5;
		border-radius: 14px;
		background: #fff;
		box-shadow: 0 10px 30px rgba(30, 64, 96, .08);
	}

	.student-profile .profile-banner {
		padding: 28px 32px;
		color: #fff;
		background: linear-gradient(120deg, #1167b1, #174a78);
	}

	.student-profile .profile-banner h2 {
		margin: 0 0 8px;
		color: #fff;
		font-size: 25px;
		font-weight: 600;
	}

	.student-profile .profile-banner p {
		margin: 0;
		color: rgba(255, 255, 255, .85);
	}

	.student-profile .profile-card-body {
		padding: 26px 30px;
	}

	.student-profile .profile-section-title {
		margin: 0 0 20px;
		color: #183b56;
		font-size: 19px;
		font-weight: 600;
	}

	.student-profile .profile-grid {
		display: grid;
		grid-template-columns: repeat(2, minmax(0, 1fr));
		gap: 18px 28px;
	}

	.student-profile .profile-item {
		min-width: 0;
		padding-bottom: 13px;
		border-bottom: 1px solid #edf1f5;
	}

	.student-profile .profile-label {
		display: block;
		margin-bottom: 5px;
		color: #718096;
		font-size: 12px;
		font-weight: 600;
		letter-spacing: .06em;
		text-transform: uppercase;
	}

	.student-profile .profile-value {
		overflow-wrap: anywhere;
		color: #26384a;
		font-size: 15px;
	}

	.student-profile .status-badge {
		display: inline-block;
		padding: 4px 10px;
		border-radius: 20px;
		background: #e8f5ee;
		color: #287448;
		font-size: 13px;
		font-weight: 600;
	}

	.student-profile .status-badge.status-missing {
		background: #f1f4f7;
		color: #718096;
	}

	@media (max-width: 575.98px) {
		.student-profile {
			padding-top: 96px;
		}

		.student-profile .profile-banner,
		.student-profile .profile-card-body {
			padding: 22px 20px;
		}

		.student-profile .profile-grid {
			grid-template-columns: 1fr;
			gap: 14px;
		}
	}
</style>

<main class="student-profile">
	<div class="container">
		<h1 class="profile-heading">Student Information</h1>

		<?php if (!$cur) { ?>
			<div class="alert alert-warning" role="alert">
				Your student information could not be found. Please contact the school administrator.
			</div>
		<?php } else { ?>
			<section class="profile-card" aria-labelledby="student-profile-name">
				<div class="profile-banner">
					<h2 id="student-profile-name"><?php echo $escape(trim($cur->FNAME . ' ' . $cur->MNAME . ' ' . $cur->LNAME)); ?></h2>
					<p>Student ID: <?php echo $escape($cur->IDNO); ?></p>
				</div>
				<div class="profile-card-body">
					<h3 class="profile-section-title">Personal details</h3>
					<div class="profile-grid">
						<?php
						$personalDetails = array(
							'Gender' => ($cur->SEX == 'F') ? 'Female' : 'Male',
							'Age' => $cur->AGE,
							'Birth date' => $cur->BDAY,
							'Place of birth' => $cur->BPLACE,
							'Civil status' => $cur->STATUS,
							'Nationality' => $cur->NATIONALITY,
							'Religion' => $cur->RELIGION,
							'Contact number' => $cur->CONTACT_NO,
							'Email address' => $cur->EMAIL,
							'Home address' => $cur->HOME_ADD,
						);
						foreach ($personalDetails as $label => $value) {
						?>
							<div class="profile-item">
								<span class="profile-label"><?php echo $escape($label); ?></span>
								<span class="profile-value"><?php echo $escape($value); ?></span>
							</div>
						<?php } ?>
					</div>
				</div>
			</section>

			<?php
			$details = new Student_details();
			$det = $details->secondary_details($_SESSION['IDNO']);
			$requirements = new Requirements();
			$res = $requirements->single_result($_SESSION['IDNO']);
			?>

			<section class="profile-card" aria-labelledby="family-details-title">
				<div class="profile-card-body">
					<h3 class="profile-section-title" id="family-details-title">Family and guardian details</h3>
					<div class="profile-grid">
						<?php
						$familyDetails = array(
							'Father' => $det->FATHER ?? '',
							"Father's occupation" => $det->FATHER_OCCU ?? '',
							'Mother' => $det->MOTHER ?? '',
							"Mother's occupation" => $det->MOTHER_OCCU ?? '',
							'Boarding' => $det->BOARDING ?? '',
							'Living with family' => $det->WITH_FAMILY ?? '',
							'Guardian' => $det->GUARDIAN ?? '',
							'Guardian address' => $det->GUARDIAN_ADDRESS ?? '',
							'Other person supporting' => $det->OTHER_PERSON_SUPPORT ?? '',
							'Address' => $det->ADDRESS ?? '',
						);
						foreach ($familyDetails as $label => $value) {
						?>
							<div class="profile-item">
								<span class="profile-label"><?php echo $escape($label); ?></span>
								<span class="profile-value"><?php echo $escape($value); ?></span>
							</div>
						<?php } ?>
					</div>
				</div>
			</section>

			<section class="profile-card" aria-labelledby="requirements-title">
				<div class="profile-card-body">
					<h3 class="profile-section-title" id="requirements-title">Submitted requirements</h3>
					<div class="profile-grid">
						<?php
						$submittedRequirements = array(
							'NSO certificate' => $res->NSO ?? '',
							'Baptismal certificate' => $res->BAPTISMAL ?? '',
							'Entrance test result' => $res->ENTRANCE_TEST_RESULT ?? '',
							'Marriage contract' => $res->MARRIAGE_CONTRACT ?? '',
							'Certificate of transfer' => $res->CERTIFICATE_OF_TRANSFER ?? '',
						);
						foreach ($submittedRequirements as $label => $value) {
							$isSubmitted = strtolower((string) $value) === 'yes';
						?>
							<div class="profile-item">
								<span class="profile-label"><?php echo $escape($label); ?></span>
								<span class="status-badge<?php echo $isSubmitted ? '' : ' status-missing'; ?>">
									<?php echo $escape($value !== '' ? $value : 'Not recorded'); ?>
								</span>
							</div>
						<?php } ?>
					</div>
				</div>
			</section>
		<?php } ?>
	</div>
</main>
