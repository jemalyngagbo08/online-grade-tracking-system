<?php
require_once("../../../includes/initialize.php");

$view = isset($_GET['view']) ? $_GET['view'] : 'list';

if ($view == 'program' && isset($_GET['id'])) {
    $_SESSION['selected_dept_id'] = intval($_GET['id']);
}

switch ($view) {

    case 'list':
        $content = 'list.php';
        break;

    case 'add':
        $content = 'add.php';
        break;

    case 'edit':
        $content = 'edit.php';
        break;

    case 'program':
        $content = 'listofprog_content.php';
        break;

    case 'add_program':
        $content = 'add_program.php';
        break;

    case 'edit_program':
        $content = 'edit_program.php';
        break;

    case 'year_list':
        $content = 'list_year.php';
        break;

    case 'add_year':
        $content = 'add_year.php';
        break;

    case 'list_subject':
        $content = 'list_subject.php';
        break;

    case 'add_subject':
        $content = 'add_subject.php';
        break;

    case 'list_students':
        $content = 'list_students.php';
        break;

    case 'add_students':
        $content = 'add_students.php';
        break;

    case 'edit_students':
        $content = 'edit_students.php';
        break;

    case 'view_students':
        $content = 'view_students.php';
        break;

    case 'enroll':
        $content = 'enrollment.php';
        break;

    case 'subject' :
		$content    = 'studentsubject.php';		
		break;

    default:
        $content = 'list.php';
        break;

    case 'assign' :
		$content    = 'assignsubj.php';		
		break;
}

require_once '../../theme/templates.php';
