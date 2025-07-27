<?php
include "config.php";

if ($_POST['action'] === 'update') {
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $course = $_POST['course'];

    if ($name !== '' && $phone !== '' && $address !== '' && $course !== '') {
        $stmt = $pdo->prepare("UPDATE students SET phone = ? , address=?, course_id=?, student_name=? WHERE student_id = ?");
        $success = $stmt->execute([$phone, $address, $course,$name,$id]);

        echo $success ? 'updated' : 'error';
    } else {
        echo 'invalid';
    }
}
?>
