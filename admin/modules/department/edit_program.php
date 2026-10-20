<?php
require_once("../../../includes/initialize.php");

$program_id = $_GET['id'];
$program = new Program();
$object = $program->single_program($program_id);

check_message();
?>

<form class="form-horizontal well span6" 
      action="controller.php?action=edit_program&id=<?php echo $program_id; ?>" 
      method="POST">

    <fieldset>
        <legend>Edit Program</legend>

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="program_name">Program Name</label>

                <div class="col-md-8">
                    <input name="program_id" type="hidden" value="<?php echo $object->PROGRAM_ID; ?>">
                    <input class="form-control input-sm" id="program_name" 
                           name="program_name"
                           type="text"
                           value="<?php echo $object->PROGRAM_NAME; ?>"
                           placeholder="Program Name">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="program_desc">Program Description</label>

                <div class="col-md-8">
                    <input class="form-control input-sm" id="program_desc"
                           name="program_desc"
                           type="text"
                           value="<?php echo $object->PROGRAM_DESC; ?>"
                           placeholder="Program Description">
                </div>
            </div>
        </div>

        <!-- Keep DEPT_ID so we know which department this program belongs to -->
        <input type="hidden" name="dept_id" value="<?php echo $object->DEPT_ID; ?>">

        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label"></label>

                <div class="col-md-8">
                    <button class="btn btn-primary" name="save" type="submit">Save</button>
                </div>
            </div>
        </div>

    </fieldset>
</form>
