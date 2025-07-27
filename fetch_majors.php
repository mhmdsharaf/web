<?php

include "config.php";

if (isset($_POST['action']) && $_POST['action'] === 'show') {
  $stmt = $pdo->query("SELECT * FROM courses");
  $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

  header('Content-Type: application/json');
  echo json_encode($courses);
}


?>