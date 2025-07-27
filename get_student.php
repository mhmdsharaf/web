<?php
include "config.php";

if ($_POST['action'] === 'get') {
    $id = $_POST['student_id'];

    $stmt = $pdo->prepare("SELECT * FROM students WHERE student_id = ?");
    $stmt->execute([$id]);
    $student = $stmt->fetch();

    echo $student['student_id'].'|'.$student['phone'].'|'.$student['address'].'|'.$student['course_id'].'|'.$student['student_name'];
}
?>
