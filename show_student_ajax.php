<?php
include "config.php";
if (isset($_POST['action']) && $_POST['action'] === 'select') {

  $stmt = $pdo->query("SELECT * FROM students INNER JOIN courses on students.course_id = courses.course_id");
  $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>
  <table class="table table-bordered" id="studentstables">
    <thead>
      <tr>
        <th>Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Course Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($students as $s): ?>
        <tr>
          <td><?= htmlspecialchars($s['student_name']) ?></td>
          <td><?= htmlspecialchars($s['phone']) ?></td>
          <td><?= htmlspecialchars($s['address']) ?></td>
          <td><?= htmlspecialchars($s['course_name']) ?></td>
          <td>
          <button class="delete btn btn-danger btn-sm" value="<?= $s['student_id'] ?>">Delete</button>
          <button class="edit btn btn-success btn-sm" value="<?= $s['student_id'] ?>" >Edit</button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php
}

?>