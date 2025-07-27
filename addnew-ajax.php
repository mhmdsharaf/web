<?php
include "config.php";

if ($_POST['action'] === 'insert') {
  $name=trim($_POST['name']);
  $id=trim($_POST['id']);
  if ( $name !== '' && $id !== '') {
    $check = $pdo->prepare("SELECT COUNT(*) FROM courses WHERE id = ?");
    $check->execute([$name,$id]);
    $exists = $check->fetchColumn();
    // var_dump($exists);exit;

    if ($exists == 0) {
      $stmt = $pdo->prepare("INSERT INTO courses (name,id) VALUES (?,?)");
      $stmt->execute([$name,$id]);
      echo 'inserted';
    } else {
      echo 'exists';
    }
  } else {
    echo 'invalid';
  }
}
?>