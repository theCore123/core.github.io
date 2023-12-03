<?php
require 'db.php';

if (isset($_POST['name']) && isset($_POST['age']) && isset($_POST['sex'])) {
  $name = $_POST['name'];
  $age = $_POST['age'];
  $sex = $_POST['sex'];

  $sql = 'INSERT INTO users(name, age, sex) VALUES(:name, :age, :sex)';
  $statement = $pdo->prepare($sql);
  if ($statement->execute([':name' => $name, ':age' => $age, ':sex' => $sex])) {
    header("Location: index.php");
  }
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = 'SELECT * FROM users WHERE id=:id';
  $statement = $pdo->prepare($sql);
  $statement->execute([':id' => $id ]);
  $person = $statement->fetch(PDO::FETCH_OBJ);
  $name = $person->name;
  $age = $person->age;
  $sex = $person->sex;
}

if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $age = $_POST['age'];
  $sex = $_POST['sex'];
  $sql = 'UPDATE users SET name=:name, age=:age, sex=:sex WHERE id=:id';
  $statement = $pdo->prepare($sql);
  if ($statement->execute([':name' => $name, ':age' => $age, ':sex' => $sex, ':id' => $id])) {
    header("Location: index.php");
  }
}

if (isset($_GET['del'])) {
  $id = $_GET['del'];
  $sql = 'DELETE FROM users WHERE id=:id';
  $statement = $pdo->prepare($sql);
  if ($statement->execute([':id' => $id])) {
    header("Location: index.php");
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>CRUD PHP</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="content">
    <h2>Agregar usuario</h2>
    <form method="post">
      <label for="name">Nombre:</label>
      <input type="text" id="name" name="name">
      <label for="age">Edad:</label>
      <input type="number" id="age" name="age">
      <label for="sex">Sexo:</label>
      <input type="text" id="sex" name="sex">
      <button type="submit">Agregar</button>
    </form>

    <h2>Usuarios</h2>
    <table>
      <tr>
        <th>Nombre</th>
        <th>Edad</th>
        <th>Sexo</th>
        <th>Acciones</th>
      </tr>
      <?php
      $users = $pdo->query('SELECT * FROM users')->fetchAll();
      foreach ($users as $user) {
        echo "<tr>";
        echo "<td>".$user['name']."</td>";
        echo "<td>".$user['age']."</td>";
        echo "<td>".$user['sex']."</td>";
        echo "<td>";
        echo "<a href='edit.php?id=".$user['id']."'>Editar</a> | ";
        echo "<a href='delete.php?id=".$user['id']."'>Eliminar</a>";
        echo "</td>";
        echo "</tr>";
      }
      ?>
    </table>
  </div>
</body>
</html>
