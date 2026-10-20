<?php
require_once(LIB_PATH.DS."database.php");

class Program {
    // Table name (matches your database)
    protected static $tblname = "program";

    // Explicit properties that match table columns
    public $PROGRAM_ID;
    public $PROGRAM_NAME;
    public $PROGRAM_DESC;
    public $DEPT_ID;

    /**
     * Return list of programs for a given department
     * If $dept_id is 0 or omitted, returns ALL programs
     */
    public function listOfPrograms($dept_id = 0) {
        global $mydb;
        if ($dept_id > 0) {
            $sql = "SELECT * FROM " . self::$tblname . " WHERE DEPT_ID = " . intval($dept_id) . " ORDER BY PROGRAM_NAME";
        } else {
            $sql = "SELECT * FROM " . self::$tblname . " ORDER BY PROGRAM_NAME";
        }
        $mydb->setQuery($sql);
        return $mydb->loadResultList();
    }

    /**
     * Return a single program object (or false)
     */
    public function single_program($id = 0) {
        global $mydb;
        $id = intval($id);
        if ($id <= 0) {
            return false;
        }
        $sql = "SELECT * FROM " . self::$tblname . " WHERE PROGRAM_ID = {$id} LIMIT 1";
        $mydb->setQuery($sql);
        return $mydb->loadSingleResult();
    }

    /**
     * Create new program (uses object properties)
     * Returns true on success, false on failure
     */
    public function create() {
        global $mydb;

        $name = isset($this->PROGRAM_NAME) ? $mydb->escape_value($this->PROGRAM_NAME) : '';
        $desc = isset($this->PROGRAM_DESC) ? $mydb->escape_value($this->PROGRAM_DESC) : '';
        $dept = isset($this->DEPT_ID) ? intval($this->DEPT_ID) : 0;

        $sql  = "INSERT INTO " . self::$tblname . " (PROGRAM_NAME, PROGRAM_DESC, DEPT_ID) VALUES ";
        $sql .= "('{$name}', '{$desc}', {$dept})";

        $mydb->setQuery($sql);
        $res = $mydb->executeQuery();

        return $res ? true : false;
    }

    /**
     * Update program by id using object properties
     */
    public function update($id = 0) {
        global $mydb;
        $id = intval($id);
        if ($id <= 0) return false;

        $name = isset($this->PROGRAM_NAME) ? $mydb->escape_value($this->PROGRAM_NAME) : '';
        $desc = isset($this->PROGRAM_DESC) ? $mydb->escape_value($this->PROGRAM_DESC) : '';
        $dept = isset($this->DEPT_ID) ? intval($this->DEPT_ID) : 0;

        $sql  = "UPDATE " . self::$tblname . " SET ";
        $sql .= "PROGRAM_NAME = '{$name}', ";
        $sql .= "PROGRAM_DESC = '{$desc}', ";
        $sql .= "DEPT_ID = {$dept} ";
        $sql .= "WHERE PROGRAM_ID = {$id}";

        $mydb->setQuery($sql);
        $res = $mydb->executeQuery();

        return $res ? true : false;
    }

    /**
     * Delete program by id
     */
    public function delete($id) {
        global $mydb;
        $mydb->setQuery("DELETE FROM program WHERE PROGRAM_ID = {$id}");
        return $mydb->executeQuery();
    }

}
?>
