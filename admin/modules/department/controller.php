<?php
require_once("../../../includes/initialize.php");
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
    // Department
    case 'add' :
        doInsert();
        break;

    case 'edit' :
        doEdit();
        break;

    case 'delete' :
        doDelete();
        break;

    // Program actions
    case 'add_program':
        doAddProgram();
        break;

    case 'edit_program':
        doEditProgram();
        break;

    case 'delete_program':
        doDeleteProgram();
        break;

    case 'add_year':
        addYear();
        break;
        
    case 'add_subject':
        doAddSubject();
        break;

    case 'delete_subject' :
        doDeleteSubject();
        break;

    case 'add_students':
        doAddStudent();
        break;

    case 'delete_students':
        doDeleteStud();
        break;

    case 'enroll' :
        doEnroll();
        break;

    case 'assign' :
        doAssignsubj();
        break;

    case 'delsy' :
		doDelsy();
	    break;

    case 'delsubj' :
        doDelsubj();
        break;

    default:
        // nothing
        break;
}

/* -------------------------
   Department functions (unchanged)
   ------------------------- */
function doInsert() {
    if (isset($_POST['save'])) {
        if ($_POST['deptname'] == "" OR $_POST['deptdesc'] == "") {
            message("All field is required!", "error");
            redirect('index.php?view=add');
        } else {
            $dept = new Dept();
            $deptname   = $_POST['deptname'];
            $dept_desc  = $_POST['deptdesc'];
            $res = $dept->find_all_dept($deptname);

            if ($res >=1) {
                message("Department name already exist!","error");
                redirect('index.php?view=add');
            } else {
                $dept->DEPARTMENT_NAME = $deptname;
                $dept->DEPARTMENT_DESC = $dept_desc;
                $istrue = $dept->create();
                if ($istrue == 1){
                    message("New [". $deptname ."] Department created successfully!","success");
                    redirect('index.php');
                }
            }
        }
    }
}

function doEdit() {
    $deptid = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if (isset($_POST['save'])) {
        if ($_POST['deptname'] == "" OR $_POST['deptdesc'] == "") {
            message("All field is required!", "error");
            redirect('index.php?view=edit&id='.$deptid);
        } else {
            $dept = new Dept();
            $deptname   = $_POST['deptname'];
            $dept_desc  = $_POST['deptdesc'];

            $dept->DEPT_ID = $deptid;
            $dept->DEPARTMENT_NAME = $deptname;
            $dept->DEPARTMENT_DESC = $dept_desc;
            $dept->update($deptid);

            message($deptname . " has updated successfully!", "success");
            redirect('index.php');
        }
    }
}

function doDelete() {
    @$id = $_POST['selector'];
    if (is_array($id) && count($id) > 0) {
        foreach ($id as $deptid) {
            $dept = new Dept();
            $dept->delete($deptid);
        }
        message("Department(s) deleted!", "info");
    }
    redirect('index.php');
}

/* -------------------------
   Program functions (new)
   ------------------------- */

/**
 * Add program
 */
function doAddProgram() {
    if (isset($_POST['save'])) {
        $name = isset($_POST['program_name']) ? trim($_POST['program_name']) : '';
        $desc = isset($_POST['program_desc']) ? trim($_POST['program_desc']) : '';
        $dept = isset($_POST['dept_id']) ? intval($_POST['dept_id']) : 0;

        if ($name == "" || $desc == "" || $dept <= 0) {
            message("All fields are required!", "error");
            redirect('index.php?view=add_program&dept_id=' . $dept);
            return;
        }

        $program = new Program();
        $program->PROGRAM_NAME = $name;
        $program->PROGRAM_DESC = $desc;
        $program->DEPT_ID = $dept;

        $istrue = $program->create();

        if ($istrue) {
            message("New program added successfully!", "success");
            redirect('index.php?view=program&id=' . $dept);
        } else {
            message("Failed to add program.", "error");
            redirect('index.php?view=add_program&dept_id=' . $dept);
        }
    } else {
        redirect('index.php');
    }
}

/**
 * Edit program
 */
function doEditProgram() {
    $program_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if (isset($_POST['save'])) {
        $name = isset($_POST['program_name']) ? trim($_POST['program_name']) : '';
        $desc = isset($_POST['program_desc']) ? trim($_POST['program_desc']) : '';
        $dept = isset($_POST['dept_id']) ? intval($_POST['dept_id']) : 0;

        if ($name == "" || $desc == "" || $dept <= 0) {
            message("All fields are required!", "error");
            redirect('index.php?view=edit_program&id=' . $program_id);
            return;
        }

        $program = new Program();
        $program->PROGRAM_NAME = $name;
        $program->PROGRAM_DESC = $desc;
        $program->DEPT_ID = $dept;

        $updated = $program->update($program_id);

        if ($updated) {
            message("Program updated successfully!", "success");
            redirect('index.php?view=program&id=' . $dept);
        } else {
            message("Failed to update program.", "error");
            redirect('index.php?view=edit_program&id=' . $program_id);
        }
    } else {
        redirect('index.php');
    }
}

function doDeleteProgram() {
    // Determine department id to redirect back to
    $dept_id = 0;
    if (isset($_GET['dept'])) {
        $dept_id = intval($_GET['dept']);
    } elseif (isset($_GET['id'])) {
        // your list view uses ?view=program&id=DEPT_ID so keep compatibility
        $dept_id = intval($_GET['id']);
    } elseif (isset($_POST['dept_id'])) {
        $dept_id = intval($_POST['dept_id']);
    } elseif (isset($_SESSION['selected_dept_id'])) {
        $dept_id = intval($_SESSION['selected_dept_id']);
    }

    // 1) Single delete via link: controller.php?action=delete_program&pid=PROGRAM_ID&dept=DEPT_ID
    $single_pid = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
    if ($single_pid > 0) {
        $program = new Program();
        $deleted = $program->delete($single_pid);

        if ($deleted) {
            message("Program deleted!", "success");
        } else {
            message("Failed to delete program.", "error");
        }

        redirect('index.php?view=program&id=' . $dept_id);
        return;
    }

    // 2) Multiple delete via POST checkboxes (selector[])
    if (isset($_POST['selector']) && is_array($_POST['selector']) && count($_POST['selector']) > 0) {
        $ids = $_POST['selector'];
        $deletedCount = 0;

        foreach ($ids as $pid) {
            $pid = intval($pid);
            if ($pid <= 0) continue;
            $program = new Program();
            if ($program->delete($pid)) {
                $deletedCount++;
            }
        }

        if ($deletedCount > 0) {
            message("{$deletedCount} program(s) deleted.", "success");
        } else {
            message("No programs were deleted.", "error");
        }

        redirect('index.php?view=program&id=' . $dept_id);
        return;
    }

    // Nothing to delete
    message("No program selected for deletion.", "error");
    redirect('index.php?view=program&id=' . $dept_id);
}

function addYear() {

    if (!isset($_POST['saveyear'])) {
        redirect("index.php");
        exit;
    }

    $coursename = trim($_POST['coursename']);
    $coursedesc = trim($_POST['coursedesc']);
    $program_id = intval($_POST['program_id']);
    $dept_id    = intval($_POST['dept_id']);

    if ($coursename == "" || $coursedesc == "") {
        message("All fields are required!", "error");
        redirect("index.php?view=add_year&program_id=$program_id&dept_id=$dept_id");
        exit;
    }

    // Prevent duplicate year
    global $mydb;
    $mydb->setQuery("
        SELECT * FROM course
        WHERE COURSE_NAME = '{$coursename}'
        AND PROGRAM_ID = {$program_id}
    ");
    $exist = $mydb->loadSingleResult();

    if ($exist) {
        message("Year level already exists!", "error");
        redirect("index.php?view=list_year&program_id=$program_id");
        exit;
    }

    $course = new Course();
    $course->COURSE_NAME = $coursename;
    $course->COURSE_DESC = $coursedesc;
    $course->PROGRAM_ID  = $program_id;
    $course->DEPT_ID     = $dept_id;
    $course->create();

    message("New Year Level successfully added!", "success");
    redirect("index.php?view=list_year&program_id=$program_id");
}

function doAddSubject() {

    if (!isset($_POST['savecourse']) && !isset($_POST['saveandnewcourse'])) {
        redirect('index.php?view=list_subject');
        return;
    }

    global $mydb;

    $code   = trim($_POST['subjcode']);
    $desc   = trim($_POST['subjdesc']);
    $unit   = intval($_POST['unit']);
    $pre    = trim($_POST['pre']);
    $course = intval($_POST['course']); // COURSE_ID
    $ay     = trim($_POST['ay']);
    $sem    = trim($_POST['Semester']);

    // ✅ Validation
    if ($code == "" || $desc == "" || $unit <= 0 || $course <= 0 || $ay == "" || $sem == "") {
        message("All fields are required!", "error");
        redirect('index.php?view=add_subject');
        return;
    }

    // ✅ Insert subject
    $sql = "
        INSERT INTO subject
        (SUBJ_CODE, SUBJ_DESCRIPTION, UNIT, PRE_REQUISITE, COURSE_ID, AY, SEMESTER)
        VALUES (
            '".$mydb->escape_value($code)."',
            '".$mydb->escape_value($desc)."',
            {$unit},
            '".$mydb->escape_value($pre)."',
            {$course},
            '".$mydb->escape_value($ay)."',
            '".$mydb->escape_value($sem)."'
        )
    ";

    $mydb->setQuery($sql);
    $result = $mydb->executeQuery();

    if ($result) {
        message("Subject added successfully!", "success");

        // ✔ Save & New
        if (isset($_POST['saveandnewcourse'])) {
            redirect('index.php?view=add_subject');
        }

        // ✔ Save only
        redirect('index.php?view=list_subject&course_id='.$course);
    } else {
        message("Failed to add subject.", "error");
        redirect('index.php?view=add_subject');
    }
}

function doDeleteSubject(){

    if (!isset($_POST['selector']) || !is_array($_POST['selector'])) {
        message("Select at least one subject to delete!", "error");
        redirect('index.php');
        return;
    }

    global $mydb;

    $ids = $_POST['selector'];
    $deleted = 0;

    foreach ($ids as $subj_id) {
        $subj_id = intval($subj_id);
        if ($subj_id <= 0) continue;

        $subject = new Subject();
        if ($subject->delete($subj_id)) {
            $deleted++;
        }
    }

    if ($deleted > 0) {
        message("{$deleted} subject(s) deleted successfully!", "success");
    } else {
        message("No subject was deleted.", "error");
    }

    // 🔁 Redirect back to subject list
    $course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;
    redirect('index.php?view=list_subject&course_id=' . $course_id);
}

function doAddStudent() {

    if (!isset($_POST['submit'])) {
        redirect('index.php?view=list_students');
        return;
    }

    global $mydb;

    $idno   = trim($_POST['idno']);
    $lname  = trim($_POST['lName']);
    $fname  = trim($_POST['fName']);
    $mname  = trim($_POST['mName']);
    $sex    = trim($_POST['gender']);
    $bday   = trim($_POST['bday']);
    $bplace = trim($_POST['bplace']);
    $status = trim($_POST['status']);
    $age    = intval($_POST['age']);
    $nation = trim($_POST['nationality']);
    $relig  = trim($_POST['religion']);
    $contact= trim($_POST['contact']);
    $home   = trim($_POST['home']);
    $email  = trim($_POST['email']);

    if ($idno == "" || $lname == "" || $fname == "" || $email == "") {
        message("Required fields are missing!", "error");
        redirect('index.php?view=add_students');
        return;
    }

    $student = new Student();
    $student->IDNO        = $idno;
    $student->LNAME       = $lname;
    $student->FNAME       = $fname;
    $student->MNAME       = $mname;
    $student->SEX         = $sex;
    $student->BDAY        = $bday;
    $student->BPLACE      = $bplace;
    $student->STATUS      = $status;
    $student->AGE         = $age;
    $student->NATIONALITY = $nation;
    $student->RELIGION    = $relig;
    $student->CONTACT_NO  = $contact;
    $student->EMAIL       = $email;
    $student->HOME_ADD    = $home;

    // PASSWORD LOGIC
    $rawPassword = !empty($_POST['password']) ? $_POST['password'] : $idno;
    $student->password = password_hash($rawPassword, PASSWORD_DEFAULT);

    $student->create();

    $details = new Student_details();
    $details->IDNO                 = $idno;
    $details->FATHER               = $_POST['father'] ?? '';
    $details->FATHER_OCCU          = $_POST['fOccu'] ?? '';
    $details->MOTHER               = $_POST['mother'] ?? '';
    $details->MOTHER_OCCU          = $_POST['mOccu'] ?? '';
    $details->BOARDING             = $_POST['boarding'] ?? '';
    $details->WITH_FAMILY          = $_POST['withfamily'] ?? '';
    $details->GUARDIAN             = $_POST['guardian'] ?? '';
    $details->GUARDIAN_ADDRESS     = $_POST['guardianAdd'] ?? '';
    $details->OTHER_PERSON_SUPPORT = $_POST['otherperson'] ?? '';
    $details->ADDRESS              = $_POST['otherAddress'] ?? '';

    $details->create();

    $req = new Requirements();
    $req->IDNO                    = $idno;
    $req->NSO                     = isset($_POST['nso']) ? 'Yes' : 'No';
    $req->BAPTISMAL               = isset($_POST['baptismal']) ? 'Yes' : 'No';
    $req->ENTRANCE_TEST_RESULT    = isset($_POST['entrance']) ? 'Yes' : 'No';
    $req->MARRIAGE_CONTRACT       = isset($_POST['mir_contract']) ? 'Yes' : 'No';
    $req->CERTIFICATE_OF_TRANSFER = isset($_POST['certifcateOfTransfer']) ? 'Yes' : 'No';

    $req->create();

    message("Student successfully added!", "success");
    redirect('index.php?view=list_students');
}

function doDeleteStud() {

    if (!isset($_POST['selector'])) {
        message("No student selected!", "error");
        redirect("index.php?view=students");
        return;
    }

    $ids = $_POST['selector'];

    foreach ($ids as $idno) {
        Student::deleteStudent($idno);
    }

    message("Selected student(s) deleted successfully!", "success");
    redirect("index.php?view=students");
}


function doEnroll(){

	if (isset($_POST['savestep1'])){

 				 $created =  strftime("%Y-%m-%d %H:%M:%S", time()); 
				 $idno  =  $_POST['idno'];
				 $Status = $_POST['Status'];
				 $course = $_POST['course'];
				 $ay 	 = $_POST['ay'];
				 $Semester = $_POST['Semester'];

				$sy = new Schoolyr();
				$sy->AY = $ay;
				$sy->STATUS = $Status;
				$sy->SEMESTER = $Semester;
				$sy->COURSE_ID = $course;
				$sy->IDNO = $idno;
				$sy->DATE_RESERVED = $created;
				
				 $istrue = $sy->create();
			 if ($istrue == 1){
			 	
			 	message("Students successfully enrolled! Assign now the student's subjects.","success");
			 	// check_message();
			 	redirect('index.php?view=view&studentId='.$idno.'');
				
			 }



			}
}

function doAssignsubj(){
		global $mydb;
		$studentId = $_GET['studentId'];
		$SY = $_GET['SY'];
		$studentId=$_GET['studentId'];
		$cid=$_GET['cid'];
		$sy=$_GET['sy'];


		$subjectId = $_POST['selector'];
		$subjId = count($subjectId);

		if (!$subjectId==''){
		// echo $selector , $selector;
		$mydb->setQuery("SELECT * FROM `schoolyr` WHERE `SYID` ='{$sy}' AND `IDNO`='{$studentId}'");
		$res = $mydb->loadSingleResult();

		//echo $res->SYID . '<br/>';
		for ($i=0;$i<$subjId; $i++){
			$mydb->setQuery("SELECT  * 
							FROM  `subject` s ,`course` c 
							WHERE  s.`COURSE_ID`=c.`COURSE_ID` AND SUBJ_ID='{$subjectId[$i]}'");
			$cur = $mydb->loadResultlist();

			foreach ($cur as  $result) {
		  
		 		$grades = New Grades();
				$grades->SUBJ_ID			=	$result->SUBJ_ID;
				$grades->IDNO				=	$studentId;
				$grades->INST_ID			=	'NONE';
				$grades->SYID				=	$res->SYID;
				$grades->PRE				=	'NONE';
				$grades->MID				=	'NONE';
				$grades->FIN				=	'NONE';
				$grades->FIN_AVE			=	'NONE';
				$grades->DAY				=	'NONE';
				$grades->G_TIME				=	'NONE';
				$grades->REMARKS			=	'NONE';
				$grades->create();
			}
		message("Student's subjects already Added!","info");
			redirect('index.php?view=subject&studentId='.$studentId.'&cid='.$cid.'&sy='.$sy.'');
		 
		}
		}else{
			message("Select first the subject(s) you want to Add!","error");
			redirect('index.php?view=subject&studentId='.$studentId.'&cid='.$cid.'&sy='.$sy.'');
		}

	}

    function doDelsy(){
		$studentId=$_GET['studentId'];
		
		  @$id=$_POST['selector'];
		  $key = count($id);


		if (!$id==''){
		//multi delete using checkbox as a selector
			
			for($i=0;$i<$key;$i++){

				 //echo $id[$i];
		 
				$sy = new Schoolyr();
				$sy->delete($id[$i]);
			}
					message("Schoolyear is successfully deleted!","info");
					redirect('index.php?view=view&studentId='.$studentId.'');
		}else{
			message("Select your Schoolyear first, if you want to delete it!","error");
			redirect('index.php?view=view&studentId='.$studentId.'');
		}
	}

    function doDelsubj(){
		$studentId=$_GET['studentId'];
		$cid=$_GET['cid'];
		$sy=$_GET['sy'];
		
	  @$id=$_POST['selector'];
	  $key = count($id);


		if (!$id==''){
		//multi delete using checkbox as a selector
			
			for($i=0;$i<$key;$i++){

				 //echo $id[$i];
		 
				$studSubjects = NEW Grades();
				$studSubjects->delete($id[$i]);
			}
					message("Student subject(s) already Deleted!","info");
					redirect('index.php?view=subject&studentId='.$studentId.'&cid='.$cid.'&sy='.$sy.'');
		}else{
			message("Select your subject(s) first, if you want to delete it!","error");
			redirect('index.php?view=subject&studentId='.$studentId.'&cid='.$cid.'&sy='.$sy.'');
		}
	}

?>
