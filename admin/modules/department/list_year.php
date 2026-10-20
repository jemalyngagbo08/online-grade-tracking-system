<?php
require_once("../../../includes/initialize.php");

$program_id = isset($_GET['program_id']) ? intval($_GET['program_id']) : 0;

if ($program_id <= 0) {
    message("Invalid Program!", "error");
    redirect("index.php?view=program&id=".$_SESSION['selected_dept_id']);
    exit;
}

// Get DEPT_ID (ALREADY IN YOUR CODE – NOT CHANGED)
$program = new Program();
$prog = $program->single_program($program_id);
$dept_id = $prog->DEPT_ID;
?>

<div class="container">
<div class="well">

<h3>Year Level</h3>

<table class="table table-striped">
<thead>
<tr>
    <th>Year</th>
    <th>Semester</th>
</tr>
</thead>
<tbody>

<?php
$mydb->setQuery("
    SELECT * FROM course
    WHERE PROGRAM_ID = {$program_id}
    ORDER BY COURSE_NAME
");
$cur = $mydb->loadResultList();

if ($cur) {
    foreach ($cur as $row) {
        echo '<tr>
            <td>
              <a href="index.php?view=list_subject&course_id='.$row->COURSE_ID.'">
                  '.$row->COURSE_NAME.'
              </a>
            </td>
            <td>'.$row->COURSE_DESC.'</td>
        </tr>';
    }
} else {
    echo '<tr><td colspan="2">No year levels found.</td></tr>';
}
?>

</tbody>
</table>

<?php if ($_SESSION['ACCOUNT_TYPE'] == 'Administrator') { ?>
<div class="btn-group">

    <!-- ✅ ONLY CHANGE IS HERE 
    <a href="index.php?view=add_year&program_id=<?php echo $program_id; ?>&dept_id=<?php echo $dept_id; ?>"
        class="btn btn-default">
        <span class="glyphicon glyphicon-plus-sign"></span> New
    </a>
    -->


    <a href="index.php?view=list_students&program_id=<?php echo $program_id; ?>"
       class="btn btn-default">
       <span class="glyphicon glyphicon-user"></span> Students
    </a>

</div>
<?php } ?>

</div>
</div>
