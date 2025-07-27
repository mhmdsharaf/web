<?php
include "config.php";

if ($_POST['action'] === 'delete') {
  $student_id = $_POST['student_id'];

  if (!empty($student_id)) {
    $stmt = $pdo->prepare("DELETE FROM students WHERE student_id = ?");
    $success = $stmt->execute([$student_id]);

    echo $success ? 'deleted' : 'error';
  } else {
    echo 'invalid';
  }
}
?>