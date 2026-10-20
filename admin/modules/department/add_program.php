<?php
// add_program.php (content file loaded by templates.php)
// Get dept_id from query string (the link already passes it)
$dept_id = isset($_GET['dept_id']) ? intval($_GET['dept_id']) : 0;

// load departments to populate dropdown (optional)
$dept = new Dept();
$departments = $dept->listOfDept();
?>

<div class="container">
  <div class="well">
    <form class="form-horizontal span6" action="controller.php?action=add_program" method="POST">
      <div class="row">
        <div class="col-lg-12">
          <h3>Add New Program</h3>
          <hr>
        </div>
      </div>

      <!-- Program Name -->
      <div class="form-group">
        <div class="col-md-8">
          <label>Program Name</label>
          <input class="form-control input-sm" id="program_name" name="program_name" type="text" placeholder="Program Name" required>
        </div>
      </div>

      <!-- Program Description -->
      <div class="form-group">
        <div class="col-md-8">
          <label>Program Description</label>
          <input class="form-control input-sm" id="program_desc" name="program_desc" placeholder="Program Description" required></input>
        </div>
      </div>

      <!-- Department (hidden if dept_id passed, else dropdown) -->
      <div class="form-group">
        <div class="col-md-8">
          <label>Department</label>
          <?php if ($dept_id > 0): ?>
            <input type="hidden" name="dept_id" value="<?php echo $dept_id; ?>">
            <p class="form-control-static">
              <?php
                // show selected department name
                $d = $dept->single_dept($dept_id);
                echo htmlspecialchars($d->DEPARTMENT_NAME);
              ?>
            </p>
          <?php else: ?>
            <select class="form-control input-sm" name="dept_id" required>
              <option value="">Select Department</option>
              <?php foreach ($departments as $d): ?>
                <option value="<?php echo $d->DEPT_ID; ?>"><?php echo $d->DEPARTMENT_NAME; ?></option>
              <?php endforeach; ?>
            </select>
          <?php endif; ?>
        </div>
      </div>

      <!-- Buttons -->
      <div class="form-group">
        <div class="col-md-8">
          <button class="btn btn-primary" name="save" type="submit">Save</button>
        </div>
      </div>

    </form>
  </div>
</div>
