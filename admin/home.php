<?php
$mydb->setQuery("
	SELECT
		(SELECT COUNT(*) FROM instructor) AS faculty_count,
		(SELECT COUNT(*) FROM department) AS department_count,
		(SELECT COUNT(*) FROM tblstudent) AS student_count,
		(SELECT COUNT(*) FROM useraccounts) AS user_count
");
$dashboardCounts = $mydb->loadSingleResult();

if (!$dashboardCounts) {
	throw new RuntimeException('Unable to load dashboard summary counts: ' . $mydb->error_msg);
}

$dashboardMetrics = array(
	array(
		'label' => 'Total Faculty',
		'value' => $dashboardCounts->faculty_count,
		'icon' => 'users_circle-08',
		'tone' => 'faculty',
	),
	array(
		'label' => 'Total Departments',
		'value' => $dashboardCounts->department_count,
		'icon' => 'business_bank',
		'tone' => 'departments',
	),
	array(
		'label' => 'Total Students',
		'value' => $dashboardCounts->student_count,
		'icon' => 'education_hat',
		'tone' => 'students',
	),
	array(
		'label' => 'Total Registered Users',
		'value' => $dashboardCounts->user_count,
		'icon' => 'users_single-02',
		'tone' => 'users',
	),
);
?>

<main class="admin-dashboard" aria-labelledby="dashboard-title">
	<header class="dashboard-header">
		<div>
			<p class="dashboard-eyebrow">Samar State University</p>
			<h1 id="dashboard-title">Dashboard Overview</h1>
			<p class="dashboard-intro">A summary of the people and departments in the grading system.</p>
		</div>
	</header>

	<section class="dashboard-metrics" aria-label="System summary">
		<?php foreach ($dashboardMetrics as $metric) { ?>
			<article class="dashboard-metric dashboard-metric-<?php echo htmlspecialchars($metric['tone'], ENT_QUOTES, 'UTF-8'); ?>">
				<div class="dashboard-metric-icon" aria-hidden="true">
					<i class="now-ui-icons <?php echo htmlspecialchars($metric['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i>
				</div>
				<div class="dashboard-metric-copy">
					<p><?php echo htmlspecialchars($metric['label'], ENT_QUOTES, 'UTF-8'); ?></p>
					<strong><?php echo number_format((int) $metric['value']); ?></strong>
				</div>
				<span class="dashboard-metric-accent" aria-hidden="true"></span>
			</article>
		<?php } ?>
	</section>

	<div class="dashboard-university">
		<div class="dashboard-logo">
			<img src="ssu-removebg-preview.png" alt="Samar State University logo">
		</div>
		<p class="dashboard-university-name">Samar State University</p>
		<p class="dashboard-university-location">Catbalogan City, Samar, Philippines</p>
	</div>

	<section class="dashboard-values" aria-label="University mission and vision">
		<article class="dashboard-value-card">
			<div class="dashboard-value-icon" aria-hidden="true">
				<i class="now-ui-icons education_hat"></i>
			</div>
			<h2>Our Mission</h2>
			<p>
				To provide a simple and secure web-based system that allows teachers
				to update grades in real time and helps students access their grades
				easily, improving communication and efficiency in grade tracking.
			</p>
		</article>

		<article class="dashboard-value-card dashboard-value-card-vision">
			<div class="dashboard-value-icon" aria-hidden="true">
				<i class="now-ui-icons business_bulb-63"></i>
			</div>
			<h2>Our Vision</h2>
			<p>
				To have an easy and reliable online system where students can see
				their grades anytime and understand their academic performance clearly.
			</p>
		</article>
	</section>
</main>
