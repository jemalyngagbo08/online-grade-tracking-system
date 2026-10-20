<?php
require_once("../../../includes/initialize.php");

$program_id = isset($_GET['program_id']) ? intval($_GET['program_id']) : 0;
$dept_id    = isset($_GET['dept_id']) ? intval($_GET['dept_id']) : 0;

if ($program_id <= 0 || $dept_id <= 0) {
    message("Please select a program first.", "error");
    redirect("index.php?view=department");
    exit;
}
?>

<form class="form-horizontal well"
      action="controller.php?action=add_year"
      method="POST">

<fieldset>
<legend>New Year Level</legend>

<div class="form-group">
    <label class="col-md-4 control-label">Year Level</label>
    <div class="col-md-8">
        <input class="form-control"
               name="coursename"
               placeholder="e.g. 1st Year"
               required>
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Semester</label>
    <div class="col-md-8">
        <input class="form-control"
               name="coursedesc"
               placeholder="e.g. 1st Semester"
               required>
    </div>
</div>

<input type="hidden" name="program_id" value="<?php echo $program_id; ?>">
<input type="hidden" name="dept_id" value="<?php echo $dept_id; ?>">

<div class="form-group">
    <div class="col-md-8 col-md-offset-4">
        <button class="btn btn-primary" name="saveyear">
            <span class="glyphicon glyphicon-floppy-save"></span> Save
        </button>

        <a href="index.php?view=list_year&program_id=<?php echo $program_id; ?>"
           class="btn btn-default">
           Cancel
        </a>
    </div>
</div>

</fieldset>
</form>
