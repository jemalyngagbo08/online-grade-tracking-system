<form class="form-horizontal well span4"
      action="controller.php?action=add_subject"
      method="POST">

    <fieldset>
      <legend>New Subject</legend>
                        

        <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for=
                "subjcode">Subject Code</label>

                <div class="col-md-8">
                   <input class="form-control input-sm" id="subjcode" name="subjcode" placeholder=
                      "Subject Code" type="text" value="">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for=
                "subjdesc">Subject Description</label>

                <div class="col-md-8">
                   <input class="form-control input-sm" id="subjdesc" name="subjdesc" placeholder=
                      "Subject Description" type="text" value="">
                </div>
              </div>
            </div>

             <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for=
                "unit">No of units</label>

                <div class="col-md-8">
                   <input class="form-control input-sm" id="unit" name="unit" placeholder=
                      "No of units" type="number" value="">
                </div>
              </div>
            </div>
         <!--    <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for=
                "pre">Prerequisite</label>

                <div class="col-md-8">-->
                   <input class="form-control input-sm" id="pre" name="pre" placeholder=
                      "Prerequisite" type="hidden" value="">
            <!--    </div>
              </div>
            </div>-->
             <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for=
                "course">Year level</label>

                <div class="col-md-8">
                 <select class="form-control input-sm" name="course" id="course">
                      <?php
                      $course = new Course();
                      $cur = $course->listOfDistinctcourse(); 
                      foreach ($cur as $course) {
                        echo '<option value="'. $course->COURSE_ID.'">'.$course->COURSE_NAME.' </option>';
                      }

                      ?>
              
            </select> 
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for=
                "ay">Academic Year</label>

                <div class="col-md-8">
                    <select class="form-control input-sm" name="ay" id="ay">
                        <?php
                            $currentYear = date("Y");
                            $startYear = $currentYear - 5;
                            $endYear = $currentYear + 5;

                            for ($y = $startYear; $y <= $endYear; $y++) {
                                $next = $y + 1;
                                $value = $y . "-" . $next;

                                $selected = ($y == $currentYear) ? "selected" : "";

                                echo "<option value='$value' $selected>$value</option>";
                            }
                        ?>
                    </select>
                </div>

              </div>
            </div>
      <!--  <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for=
                "Semester">Semester</label>

                <div class="col-md-8">
                   <select class="form-control input-sm" name="Semester" id="Semester">
            <option value="First">First</option>
            <option value="Second">Second</option>  
            <option value="Summer">Summer</option>  
          </select>-->
          <input class="form-control input-sm" id="Semester" name="Semester" placeholder=
                      "Prerequisite" type="hidden" value="First">
           <!--     </div>
              </div>
            </div>
      -->

       <div class="form-group">
              <div class="col-md-8">
                <label class="col-md-4 control-label" for=
                "idno"></label>

                <div class="col-md-8">
                  <button class="btn btn-default" name="savecourse" type="submit" ><span class="glyphicon glyphicon-floppy-save"></span> Save</button>
                 <button class="btn btn-default" name="saveandnewcourse" type="submit" ><span class="glyphicon glyphicon-floppy-save"></span> Save and Add new</button>
                </div>
              </div>
            </div>

        
    </fieldset> 

            
  </form>
  </div><!--End of container-->