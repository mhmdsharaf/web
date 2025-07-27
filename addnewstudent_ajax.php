<?php
include "config.php";

if ($_POST['action'] === 'add') {
  $name = trim($_POST['name']);
  $phone = trim($_POST['phone']);
  $address = trim($_POST['address']);
  $course = $_POST['course'];

  if ($name !== '' && $phone !== '' && $address!== '') {
    $check = $pdo->prepare("SELECT COUNT(*) FROM students WHERE student_name = ?");
    $check->execute([$name]);
    $exists = $check->fetchColumn();
    // var_dump($exists);exit;

    if ($exists == 0) {
      $stmt = $pdo->prepare("INSERT INTO students ( phone , address , course_id ,student_name) VALUES (?, ? , ?, ?)");
      $stmt->execute([ $phone , $address , $course , $name]);
      echo 'inserted';
    } else {
      echo 'exists';
    }
  } else {
    echo 'invalid';
  }
}
?>