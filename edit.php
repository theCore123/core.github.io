<?php
require 'db.php';

$id = $_GET['id'];
$sql = 'SELECT * FROM users WHERE id=:id';
$statement = $pdo->prepare($sql);
$statement->execute([':id' => $id ]);
$user = $statement->fetch(PDO::FETCH_OBJ);

if (isset($_POST['name']) && isset($_POST['age']) && isset($_POST['sex'])) {
  $name = $_POST['name'];
  $age = $_POST['age'];
  $sex = $_POST['sex'];
  $sql = 'UPDATE users SET name=:name, age=:age, sex=:sex WHERE id=:id';
  $statement = $pdo->prepare($sql);
  if ($statement->execute([':name' => $name, ':age' => $age, ':sex' => $sex, ':id' => $id])) {
    header("Location: index.php");
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Editar Usuario</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="content">
    <h2>Editar Usuario</h2>
    <form method="post">
      <label for="name">Nombre:</label>
      <input value="<?= $user->name; ?>" type="text" id="name" name="name">
      <label for="age">Edad:</label>
      <input value="<?= $user->age; ?>" type="number" id="age" name="age">
      <label for="sex">Sexo:</label>
      <input value="<?= $user->sex; ?>" type="text" id="sex" name="sex">
      <button type="submit">Guardar</button>
    </form>
  </div>
</body>
</html>
