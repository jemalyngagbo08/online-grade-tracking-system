<div class="container">
    <div class="well">

        <?php
        $dept_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        $program = new Program();
        $cur = $program->listOfPrograms($dept_id);
        ?>

        <form action="controller.php?action=delete_program&id=<?php echo $dept_id; ?>" method="POST">

            <h3 align="left">List of Programs</h3>

            <table id="example" class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="chkall" onclick="return checkall('selector[]');">
                            Program Name
                        </th>
                        <th>Program Description</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                if (!empty($cur)) {
                    foreach ($cur as $Program) {
                        echo '<tr>';

                        // Program name (edit)
                        echo '<td>
                                <input type="checkbox" name="selector[]" value="'.$Program->PROGRAM_ID.'">
                                <a href="index.php?view=edit_program&id='.$Program->PROGRAM_ID.'">
                                    '.$Program->PROGRAM_NAME.'
                                </a>
                              </td>';

                        // ✅ Program description → Year List
                        echo '<td>
                                <a href="index.php?view=year_list&program_id='.$Program->PROGRAM_ID.'">
                                    '.$Program->PROGRAM_DESC.'
                                </a>
                              </td>';

                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="2">No programs found.</td></tr>';
                }
                ?>
                </tbody>
            </table>

            <?php if ($_SESSION['ACCOUNT_TYPE'] == 'Administrator') { ?>
            <div class="btn-group">
                <a href="index.php?view=add_program&dept_id=<?php echo $dept_id; ?>" class="btn btn-default">
                    New
                </a>
                <button type="submit" class="btn btn-default" name="delete">
                    <span class="glyphicon glyphicon-trash"></span> Delete Selected
                </button>
            </div>
            <?php } ?>

        </form>
    </div>
</div>
