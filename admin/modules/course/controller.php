<?php
require_once("../../../includes/initialize.php");

$action = $_GET['action'] ?? '';

switch ($action) {
  case 'add':
    doInsert();
    break;

  case 'edit':
    doEdit();
    break;

  case 'delete':
    doDelete();
    break;
}

/* =========================
   INSERT
========================= */
function doInsert()
{
  if (!isset($_POST['savecourse'])) {
    return;
  }

  $coursename  = trim($_POST['coursename'] ?? '');
  $coursedesc  = trim($_POST['coursedesc'] ?? '');
  $courselevel = $_POST['level'] ?? '';
  $coursemajor = $_POST['major'] ?? 'None';
  $coursedept  = $_POST['dept'] ?? 0;

  if ($coursename === '' || $coursedesc === '') {
    message("All fields are required!", "error");
    redirect("index.php");
    return;
  }

  $course = new Course();

  // Duplicate check
  $res = $course->find_all_course($coursename, $courselevel, $coursemajor);
  if ($res >= 1) {
    message("Course name already exists!", "error");
    redirect("index.php");
    return;
  }

  // Insert
  $course->COURSE_NAME  = $coursename;
  $course->COURSE_LEVEL = $courselevel;
  $course->COURSE_MAJOR = $coursemajor;
  $course->COURSE_DESC  = $coursedesc;
  $course->DEPT_ID      = $coursedept;

  if ($course->create()) {
    message("New [{$coursename}] created successfully!", "success");
    redirect("index.php");
  }
}

/* =========================
   EDIT
========================= */
function doEdit()
{
  if (!isset($_POST['savecourse'])) {
    return;
  }

  $courseid    = $_GET['id'] ?? 0;
  $coursename  = trim($_POST['coursename'] ?? '');
  $coursedesc  = trim($_POST['coursedesc'] ?? '');
  $courselevel = $_POST['level'] ?? '';
  $coursemajor = $_POST['major'] ?? 'None';
  $coursedept  = $_POST['dept'] ?? 0;

  if ($coursename === '' || $coursedesc === '') {
    message("All fields are required!", "error");
    redirect("index.php");
    return;
  }

  $course = new Course();
  $course->COURSE_NAME  = $coursename;
  $course->COURSE_LEVEL = $courselevel;
  $course->COURSE_MAJOR = $coursemajor;
  $course->COURSE_DESC  = $coursedesc;
  $course->DEPT_ID      = $coursedept;

  $course->update($courseid);

  message("{$coursename} updated successfully!", "success");
  redirect("index.php");
}

/* =========================
   DELETE
========================= */
function doDelete()
{
  $ids = $_POST['selector'] ?? [];

  foreach ($ids as $id) {
    $course = new Course();
    $course->delete($id);
  }

  message("Course(s) deleted successfully!", "info");
  redirect("index.php");
}
?>
