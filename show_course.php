<?php 
include "config.php";
if (isset($_POST['action']) && $_POST['action'] === 'select') {

  $stmt = $pdo->query("SELECT * FROM courses");
  $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

     foreach($students as $s){
    echo '<option value="' . $s['course_id'] .'">' . $s['course_name'] . '</option>';
     }

 } ?>