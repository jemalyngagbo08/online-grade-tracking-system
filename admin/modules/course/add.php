<form class="form-horizontal well span6" action="controller.php?action=add" method="POST">
  <fieldset>
    <legend>New Grade Level</legend>

    <!-- Year Level -->
    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="coursename">Year Level</label>
        <div class="col-md-8">
          <input
            class="form-control input-sm"
            id="coursename"
            name="coursename"
            placeholder="Year Level"
            type="text"
            required
          >
        </div>
      </div>
    </div>

    <!-- Level (hidden, not used) -->
    <input type="hidden" name="level" value="">

    <!-- Major (FIXED: hidden but present) -->
    <input type="hidden" name="major" value="None">

    <!-- Description -->
    <div class="form-group">
      <div class="col-md-8">
        <label class="col-md-4 control-label" for="coursedesc">Description</label>
        <div class="col-md-8">
          <input
            class="form-control input-sm"
            id="coursedesc"
            name="coursedesc"
            placeholder="Description"
            type="text"
            required
          >
        </div>
      </div>
    </div>

    <!-- Department (use FIRST department only) -->
    <?php
      $dept = new dept();
      $cur  = $dept->listOfDept();
      if (!empty($cur)) {
        echo '<input type="hidden" name="dept" value="' . $cur[0]->DEPT_ID . '">';
      }
    ?>

    <!-- Save Button -->
    <div class="form-group">
      <div class="col-md-8">
        <div class="col-md-8 col-md-offset-4">
          <button class="btn btn-default" name="savecourse" type="submit">
            <span class="glyphicon glyphicon-floppy-save"></span> Save
          </button>
        </div>
      </div>
    </div>
  </fieldset>
</form>
