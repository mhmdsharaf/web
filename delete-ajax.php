<?php
include "config.php";

if ($_POST['action'] === 'delete') {
  $name = $_POST['name'];
  $id=$_POST['id'];
  if (!empty($code)) {
    $stmt = $pdo->prepare("DELETE FROM courses WHERE id = ?");
    $success = $stmt->execute([$name,$id]);

    echo $success ? 'deleted' : 'error';
  } else {
    echo 'invalid';
  }
}
?>