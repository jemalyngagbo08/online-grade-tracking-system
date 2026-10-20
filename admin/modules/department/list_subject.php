<?php
require_once("../../../includes/initialize.php");

$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

if ($course_id <= 0) {
    message("Invalid Year Level!", "error");
    redirect("index.php?view=program&id=".$_SESSION['selected_dept_id']);
    exit;
}
?>

<div class="well">
<h3>List of Subject</h3>

<!-- ✅ REQUIRED FOR DELETE -->
<form action="controller.php?action=delete_subject&course_id=<?php echo $course_id; ?>" method="POST">

<table id="example" class="table table-striped">
<thead>
<tr>
    <th width="5%">No.</th>
    <th>
        <!-- ✅ REQUIRED FOR DELETE -->
        <input type="checkbox" onclick="checkAll(this);">
        Subject
    </th>
    <th>Description</th>
    <th>Year Level</th>
</tr>
</thead>

<tbody>
<?php
$mydb->setQuery("
    SELECT 
        s.SUBJ_ID,
        s.SUBJ_CODE,
        s.SUBJ_DESCRIPTION,
        c.COURSE_NAME
    FROM subject s
    INNER JOIN course c ON s.COURSE_ID = c.COURSE_ID
    WHERE s.COURSE_ID = {$course_id}
");

$cur = $mydb->loadResultList();
$no = 1;

if ($cur && count($cur) > 0) {
    foreach ($cur as $row) {
        echo '<tr>';
        echo '<td align="center">'.$no++.'</td>';
        echo '<td>
                <!-- ✅ REQUIRED FOR DELETE -->
                <input type="checkbox" name="selector[]" value="'.$row->SUBJ_ID.'">
                '.$row->SUBJ_CODE.'
              </td>';
        echo '<td>'.$row->SUBJ_DESCRIPTION.'</td>';
        echo '<td>'.$row->COURSE_NAME.'</td>';
        echo '</tr>';
    }
} else {
    echo '<tr>
            <td></td>
            <td>No subjects found.</td>
            <td></td>
            <td></td>
          </tr>';
}
?>
</tbody>
</table>

<?php if ($_SESSION['ACCOUNT_TYPE'] == 'Administrator') { ?>
<div class="btn-group">
    <a href="index.php?view=add_subject&course_id=<?php echo $course_id; ?>" class="btn btn-default">
        <span class="glyphicon glyphicon-plus-sign"></span> New
    </a>

    <!-- ✅ REQUIRED FOR DELETE -->
    <button type="submit" class="btn btn"
            onclick="return confirm('Are you sure you want to delete selected subject(s)?');">
        <span class="glyphicon glyphicon-trash"></span> Delete Selected
    </button>
</div>
<?php } ?>

</form>
</div>

<!-- ✅ REQUIRED FOR DELETE -->
<script>
function checkAll(source) {
    let checkboxes = document.getElementsByName('selector[]');
    for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = source.checked;
    }
}
</script>
