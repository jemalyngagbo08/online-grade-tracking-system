<div class="container">
	<?php
		$instructorId = isset($_GET['instructorId']) ? $_GET['instructorId'] : '';
		$mydb->setQuery("SELECT *
							FROM `subject` s, `course` c, `class` cl
							WHERE s.`COURSE_ID` = c.`COURSE_ID`
							AND s.`SUBJ_ID` = cl.`SUBJ_ID`
							AND cl.`INST_ID` = '{$instructorId}'");
		$subjects = $mydb->loadResultList();
	?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title"><span class="glyphicon glyphicon-book"></span> List of Subjects</h3>
		</div>
		<div class="panel-body">
			<form action="controller.php?action=delsubj" method="POST">
				<input type="hidden" name="INST_ID" value="<?php echo htmlspecialchars($instructorId, ENT_QUOTES, 'UTF-8'); ?>">
				<table id="example" class="table table-striped" cellspacing="0">
					<thead>
						<tr>
							<th>No.</th>
							<th><input type="checkbox" id="chkall" onclick="return checkall('selector[]');"> Subject Code</th>
							<th>Description</th>
							<th>Grade Level</th>
							<th>Days and Time</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($subjects as $result) { ?>
							<tr>
								<td></td>
								<td>
									<input type="checkbox" name="selector[]" value="<?php echo (int) $result->CLASS_ID; ?>">
									<?php echo htmlspecialchars($result->SUBJ_CODE, ENT_QUOTES, 'UTF-8'); ?>
								</td>
								<td><?php echo htmlspecialchars($result->SUBJ_DESCRIPTION, ENT_QUOTES, 'UTF-8'); ?></td>
								<td><?php echo htmlspecialchars($result->COURSE_NAME, ENT_QUOTES, 'UTF-8'); ?></td>
								<td><?php echo htmlspecialchars($result->DAY . ' ' . $result->C_TIME, ENT_QUOTES, 'UTF-8'); ?></td>
								<td>
									<a href="index.php?view=class&amp;id=<?php echo (int) $result->CLASS_ID; ?>&amp;instructorId=<?php echo urlencode($instructorId); ?>">
										<span class="glyphicon glyphicon-list-alt"></span> View
									</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<div class="btn-group">
					<a href="index.php?view=assign&amp;instructorId=<?php echo urlencode($instructorId); ?>" class="btn btn-default">
						<span class="glyphicon glyphicon-plus-sign"></span> Assign Subject
					</a>
					<button type="submit" class="btn btn-default">
						<span class="glyphicon glyphicon-trash"></span> Delete Selected
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
