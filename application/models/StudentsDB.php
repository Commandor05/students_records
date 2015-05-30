<?php

/**
 * Class StudentsDB
 * class for work with database
 */
class StudentsDB
{


    protected $_db;
    static $_instance;

    public static function getInstance()
    {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }


    private function  __clone()
    {
    }

    /**
     * Connect to DB if exist, create new DB if not exist
     */
    private function __construct()
    {
        try {
            if (is_file(STD_DB) AND (filesize(STD_DB) > 0)) {   //добавить условие что файл не нулевого размера
                $this->_db = new PDO('sqlite:' . STD_DB);
                $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } else {

                $this->_db = new PDO('sqlite:' . STD_DB);
                $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->_db->beginTransaction();
                $sql = "CREATE TABLE students(
									id INTEGER PRIMARY KEY AUTOINCREMENT,
									name TEXT,
									lastName TEXT,
									gender TEXT,
									age INTEGER,
									faculty INTEGER
								)";
                $this->_db->exec($sql);
                $sql = "CREATE TABLE faculty(
										id INTEGER PRIMARY KEY AUTOINCREMENT,
										facultyName TEXT
									)";
                $this->_db->exec($sql);
                $sql = "INSERT INTO faculty(id, facultyName)
						SELECT 1 as id, 'APP' as facultyName
						UNION SELECT 2 as id, 'MMT' as facultyName
						UNION SELECT 3 as id, 'GTR' as facultyName";
                $this->_db->exec($sql);
                $this->_db->commit();
            }
        } catch (PDOException $e) {
            $this->_db->rollBack();
            echo $e->getMessage();
        }

    }

    function __destruct()
    {
        unset($this->_db);
    }

    /**
     * @param string $name - student name
     * @param string $lastName - student last name
     * @param string $gender - student gender
     * @param int $age - student age
     * @param int $faculty - faculty id ,  foreign key for faculty table
     * @return bool - saving result, true - if success
     */
    function saveRec($name, $lastName, $gender, $age, $faculty)
    {
        $sql = "INSERT INTO students(name, lastName, gender, age, faculty)
					VALUES($name, $lastName, $gender, $age, $faculty)";
        $ret = $this->_db->exec($sql);
        if (!$ret)
            return false;
        return true;
    }

    /**
     * @param int $id - student id, primary key in students table
     * @param string $name - student name
     * @param string $lastName - student last name
     * @param string $gender - student gender
     * @param int $age - student age
     * @param int $faculty - faculty id ,  foreign key for faculty table
     * @return bool  - updating result, true - if success
     */
    function updateRec($id, $name, $lastName, $gender, $age, $faculty)
    {
        $sql = "UPDATE students SET name = $name, lastName = $lastName, gender = $gender, age = $age, faculty = $faculty
					WHERE id = $id ";

        $ret = $this->_db->exec($sql);
        if (!$ret)
            return false;
        return true;
    }

    /**
     * transfer sql query result in assoc array
     * @param $data - sql query result
     * @return array -assoc array  from sql query result
     */
    protected function db2Arr($data)
    {
        $arr = array();
        while ($row = $data->fetch(PDO::FETCH_ASSOC))
            $arr[] = $row;
        return $arr;
    }

    /**
     * select all records from DB
     * @return array|bool - assoc array if success|false if not
     */
    public function getRec()
    {
        try {
            $sql = "SELECT students.id as id, name, lastName, gender, age, faculty.facultyName as faculty
					FROM students, faculty
					WHERE faculty.id = students.faculty
					ORDER BY students.id DESC";
            $result = $this->_db->query($sql);
            return $this->db2Arr($result);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * return one record from students table with appropriate id
     * @param  int $id - student id
     * @return array|bool - assoc array if success|false if not
     */
    public function getRow($id)
    {
        try {
            $sql = "SELECT  id , name, lastName, gender, age, faculty
					FROM students
					WHERE id = '$id'";
            $result = $this->_db->query($sql);
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     *  delete one record from students table with appropriate id
     * @param int $id - - student id
     * @return bool - true if delete successes
     */
    public function deleteRec($id)
    {
        try {
            $sql = "DELETE FROM students WHERE id = $id";
            $result = $this->_db->exec($sql);
            return true;
        } catch (PDOException $e) {
            echo $e->getCode() . ":" . $e->getMessage();
            return false;
        }
    }

    /**
     * sanitarize data before use in queries
     * @param $data - data to sanitarize
     * @return string -sanitarize result for use in queries
     */
    function clearData($data)
    {
        return $this->_db->quote($data);
    }
}

?>