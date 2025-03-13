<?php
require_once 'Database.php';

class nilai_mhs {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function getStudents() {
        $query = "SELECT id, name FROM students";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCourses() {
        $query = "SELECT id, course_name FROM courses";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addGrade($student_id, $course_id, $grade) {
        $query = "INSERT INTO grades (student_id, course_id, grade) VALUES (:student_id, :course_id, :grade)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':student_id', $student_id);
        $stmt->bindParam(':course_id', $course_id);
        $stmt->bindParam(':grade', $grade);
        return $stmt->execute();
    }

    public function getAllGrades() {
        $query = "SELECT g.id, s.name, c.course_name, g.grade 
                  FROM grades g
                  JOIN students s ON g.student_id = s.id
                  JOIN courses c ON g.course_id = c.id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function getGradeById($id) {
        $query = "SELECT grades.id, students.name, courses.course_name, grades.grade 
                  FROM grades 
                  JOIN students ON grades.student_id = students.id
                  JOIN courses ON grades.course_id = courses.id
                  WHERE grades.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }    

    public function updateGrade($id, $grade) {
        $query = "UPDATE grades SET grade = :grade WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':grade', $grade);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function deleteGrade($id) {
        $query = "DELETE FROM grades WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
}
?>
