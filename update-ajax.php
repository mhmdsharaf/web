<?php
include "config.php";

if ($_POST['action'] === 'update') {
  $name = trim($_POST['name']);
  $id = trim($_POST['id']);
  if ($name !== ''&& $id!=='') {
    $stmt = $pdo->prepare("UPDATE courses SET name = ? WHERE id = ?");
    $success = $stmt->execute([$name,$id]);

    echo $success ? 'updated' : 'error';
  } else {
    echo 'invalid';
  }
}
?>
