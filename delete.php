<?php
require 'db.php';

$id = $_GET['id'];
$sql = 'DELETE FROM users WHERE id=:id';
$statement = $pdo->prepare($sql);
if ($statement->execute([':id' => $id])) {
  header("Location: index.php");
}
?>
