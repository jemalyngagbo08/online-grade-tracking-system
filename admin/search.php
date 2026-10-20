<?php
require_once("../includes/initialize.php");

if (!logged_in()) {
	redirect_to("login.php");
}

$query = trim(isset($_GET['q']) ? (string) $_GET['q'] : '');
$escapedQuery = $mydb->escape_value($query);
$like = "'%{$escapedQuery}%'";
$searchResults = array(
	'Faculty' => array(),
	'Departments' => array(),
	'Students' => array(),
);

if ($query !== '') {
	$mydb->setQuery("SELECT INST_ID AS record_id, INST_FULLNAME AS record_name, INST_EMAIL AS record_detail FROM instructor WHERE INST_FULLNAME LIKE {$like} OR INST_EMAIL LIKE {$like} OR SPECIALIZATION LIKE {$like} LIMIT 10");
	foreach ($mydb->loadResultList() as $result) {
		$result->url = 'modules/instructor/index.php?view=edit&id=' . (int) $result->record_id;
		$searchResults['Faculty'][] = $result;
	}

	$mydb->setQuery("SELECT DEPT_ID AS record_id, DEPARTMENT_NAME AS record_name, DEPARTMENT_DESC AS record_detail FROM department WHERE DEPARTMENT_NAME LIKE {$like} OR DEPARTMENT_DESC LIKE {$like} LIMIT 10");
	foreach ($mydb->loadResultList() as $result) {
		$result->url = 'modules/department/index.php?view=edit&id=' . (int) $result->record_id;
		$searchResults['Departments'][] = $result;
	}

	if ($_SESSION['ACCOUNT_TYPE'] === 'Administrator') {
		$mydb->setQuery("SELECT IDNO AS record_id, CONCAT(FNAME, ' ', MNAME, ' ', LNAME) AS record_name, EMAIL AS record_detail FROM tblstudent WHERE CAST(IDNO AS CHAR) LIKE {$like} OR FNAME LIKE {$like} OR MNAME LIKE {$like} OR LNAME LIKE {$like} OR EMAIL LIKE {$like} LIMIT 10");
		foreach ($mydb->loadResultList() as $result) {
			$result->url = 'modules/student/index.php?view=view&studentId=' . (int) $result->record_id;
			$searchResults['Students'][] = $result;
		}

		$mydb->setQuery("SELECT ACCOUNT_ID AS record_id, ACCOUNT_NAME AS record_name, CONCAT(ACCOUNT_USERNAME, ' - ', ACCOUNT_TYPE) AS record_detail FROM useraccounts WHERE ACCOUNT_NAME LIKE {$like} OR ACCOUNT_USERNAME LIKE {$like} OR ACCOUNT_TYPE LIKE {$like} LIMIT 10");
		foreach ($mydb->loadResultList() as $result) {
			$result->url = 'modules/user/index.php?view=edit&id=' . (int) $result->record_id;
			$searchResults['Registered Users'][] = $result;
		}
	}
}

$content = 'search_content.php';
require_once 'theme/templates.php';
?>
