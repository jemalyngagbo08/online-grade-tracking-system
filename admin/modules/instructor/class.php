<div class="container">
	<?php
		if (isset($_GET['id'])) {
			$mydb->setQuery("SELECT *
								FROM `subject` s, `course` c, class cl
								WHERE s.`COURSE_ID` = c.`COURSE_ID`
								AND s.`SUBJ_ID` = cl.`SUBJ_ID`
								AND `CLASS_ID` = " . $_GET['id']);
			$cur = $mydb->loadSingleResult();
		}
	?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Instructor Class</h3>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="container">
					<form class="form-horizontal span4" action="" method="POST">
						<table class="table" align="center">
							<tbody>
								<tr>
									<td>
										<strong>Subject Code:</strong> <?php echo isset($cur) ? $cur->SUBJ_CODE : 'Code'; ?><br>
										<strong>Description:</strong> <?php echo isset($cur) ? $cur->SUBJ_DESCRIPTION : 'Description'; ?><br>
										<strong>Grade and Section:</strong> <?php echo isset($cur) ? $cur->COURSE_DESC : 'Course'; ?><br>
										<strong>Days And Time:</strong> <?php echo isset($cur) ? $cur->DAY . ' ' . $cur->C_TIME : 'DaysTime'; ?><br>
										<strong>Section:</strong> <?php echo isset($cur) ? $cur->SECTION : 'Room'; ?>
									</td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
				<div class="container">
					<?php check_message(); ?>
					<div class="wellss">
						<h3 align="left">List of Student</h3>
						<form action="" method="POST">
							<table id="example" class="table table-striped" cellspacing="0">
								<thead>
									<tr>
										<th>No.</th>
										<th>ID#.</th>
										<th>Fullname</th>
										<th>Sex</th>
										<th>Midterms</th>
										<th>Finals</th>
										<th>Final Grade</th>
										<th>Remarks</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$mydb->setQuery("SELECT *
															FROM `class` c, `grades` g, `tblstudent` s
															WHERE c.`SUBJ_ID` = g.`SUBJ_ID`
															AND g.`IDNO` = s.`IDNO`
															AND CLASS_ID = '" . $_GET['id'] . "'");
										$students = $mydb->loadResultList();
										foreach ($students as $student) {
											echo '<tr>';
											echo '<td width="5%" align="center"></td>';
											echo '<td>' . $student->IDNO . '</td>';
											echo '<td><a href="index.php?view=grade&classId=' . $_GET['id'] .
												'&gradeId=' . $student->GRADE_ID . '&instructorId=' . $_GET['instructorId'] . '">' .
												$student->LNAME . ', ' . $student->FNAME . ' ' . $student->MNAME . '</a></td>';
											echo '<td>' . $student->SEX . '</td>';
											echo '<td>' . $student->FIRST . '</td>';
											echo '<td>' . $student->SECOND . '</td>';
											echo '<td>' . $student->AVE . '</td>';
											echo '<td>' . $student->REMARKS . '</td>';
											echo '</tr>';
										}
									?>
								</tbody>
							</table>
							<div class="btn-group">
								<a href="index.php?view=instSubj&amp;instructorId=<?php echo $_GET['instructorId']; ?>" class="btn btn-default">Back</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
