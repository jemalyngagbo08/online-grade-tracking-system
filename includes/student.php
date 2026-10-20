<?php
/**
* Description:  This is a class for student.
* Author:       Joken Villanueva
* Date Created: June 8, 2013
* Revised By:
*/
require_once(LIB_PATH.DS.'database.php');

class Student {

    protected static $tbl_name = "tblstudent";

    // MUST MATCH DB COLUMN NAME EXACTLY
    public $password;

    function db_fields(){
        global $mydb;
        return $mydb->getFieldsOnOneTable(self::$tbl_name);
    }

    function single_student($id=0){
        global $mydb;
        $mydb->setQuery("SELECT * FROM ".self::$tbl_name." WHERE IDNO={$id} LIMIT 1");
        return $mydb->loadSingleResult();
    }

    // ===========================
    // AUTHENTICATE STUDENT
    // ===========================
    static function Authenticatestudent($idno="", $password=""){
        global $mydb;

        $mydb->setQuery("
            SELECT *
            FROM ".self::$tbl_name."
            WHERE IDNO='{$mydb->escape_value($idno)}'
            LIMIT 1
        ");

        $found_user = $mydb->loadSingleResult();

        // IMPORTANT: password column is lowercase
        if ($found_user && password_verify($password, $found_user->password)) {

            $_SESSION['IDNO']  = $found_user->IDNO;
            $_SESSION['FNAME'] = $found_user->FNAME;
            $_SESSION['LNAME'] = $found_user->LNAME;
            $_SESSION['MNAME'] = $found_user->MNAME;
            $_SESSION['SEX']   = $found_user->SEX;
            $_SESSION['BDAY']  = $found_user->BDAY;

            return true;
        }

        return false;
    }

    // ===========================
	// CHANGE PASSWORD FUNCTION
	// ===========================
	public static function changePassword($idno, $newPassword) {
		global $mydb;

		if (empty($idno) || empty($newPassword)) {
			return false;
		}

		$hashed = password_hash($newPassword, PASSWORD_DEFAULT);

		$sql = "UPDATE tblstudent 
				SET password = '{$mydb->escape_value($hashed)}'
				WHERE IDNO = '{$mydb->escape_value($idno)}'";

		$mydb->setQuery($sql);

		return $mydb->executeQuery();
	}

	public static function deleteStudent($idno) {
		global $mydb;
		$mydb->setQuery("DELETE FROM tblstudent WHERE IDNO='{$idno}'");
		return $mydb->executeQuery();
	}



    /*---Instantiation of Object dynamically---*/
    static function instantiate($record) {
        $object = new self;

        foreach($record as $attribute => $value){
            if($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    private function has_attribute($attribute) {
        return array_key_exists($attribute, $this->attributes());
    }

    protected function attributes() {
        global $mydb;
        $attributes = array();

        foreach($this->db_fields() as $field) {
            if(property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    protected function sanitized_attributes() {
        global $mydb;
        $clean_attributes = array();

        foreach($this->attributes() as $key => $value){
            $clean_attributes[$key] = $mydb->escape_value($value);
        }
        return $clean_attributes;
    }

    /*--Create, Update, Delete--*/
    public function save() {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create() {
        global $mydb;

        $attributes = $this->sanitized_attributes();

        $sql  = "INSERT INTO ".self::$tbl_name." (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";

        $mydb->setQuery($sql);

        if($mydb->executeQuery()) {
            $this->id = $mydb->insert_id();
            return true;
        }
        return false;
    }

    public function update($id=0) {
        global $mydb;

        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();

        foreach($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }

        $sql  = "UPDATE ".self::$tbl_name." SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE IDNO=".$id;

        $mydb->setQuery($sql);
        return $mydb->executeQuery();
    }

    public function delete($id=0) {
        global $mydb;

        $sql  = "DELETE FROM ".self::$tbl_name;
        $sql .= " WHERE IDNO=".$id;
        $sql .= " LIMIT 1";

        $mydb->setQuery($sql);
        return $mydb->executeQuery();
    }
}
?>
