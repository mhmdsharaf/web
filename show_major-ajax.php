<?php
include "config.php";
if (isset($_POST['action']) && $_POST['action'] === 'show') {

  $stmt = $pdo->query("SELECT * FROM courses");
  $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>
  <table class="table table-bordered" id="courseTable">
    <thead>
      <tr>
        <th>id</th>
       <th>name</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($courses as $row): ?>
        <tr>
          <td><?= htmlspecialchars($row['name']) ?></td>

          <td>
          <button class="delete btn btn-danger btn-sm" value="<?= $row['id'] ?>">Delete</button>
          <button class="edit btn btn-success btn-sm" value="<?= $row['id'] ?>"data-name="<?= htmlspecialchars($row['name']) ?>">Edit</button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php
}

?>