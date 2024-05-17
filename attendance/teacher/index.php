<?php

ob_start();
session_start();

if($_SESSION['name']!='oasis')
{
  header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Presence Management System </title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../css/main.css">

</head>
<body>

<header>

  <h1>Absence management system</h1>
  <div class="navbar">
  <a href="index.php">Home</a>
  <a href="students.php">Students</a>
  <a href="teachers.php">Teachers</a>
  <a href="../logout.php">Logout</a>

</div>

</header>

<center>

<div class="row">
    <div class="content">
      <p>Here's a quick fix for your classroom</p>
    <img src="../img/image.png" height="400px" width="300px" />

  </div>

</div>

</center>
<style>
h1 {
    color: #FF0000; /* rouge */
    font-size: 40px;
    font-family: "Arial Black", sans-serif; /* belle font-family */
    font-weight: bold; /* en gras */
    animation: fadeIn 2s ease; /* animation fadeIn pendant 2 secondes */
}
p{
  font-size: 20px;
}
/* Définir l'animation fadeIn */
@keyframes fadeIn {
    from {
        opacity: 0; /* début de l'animation avec une opacité de 0 */
    }
    to {
        opacity: 1; /* fin de l'animation avec une opacité de 1 */
    }
}
.navbar {
  background-color: #007BFF; /* Bleu */
}
.navbar a {
    color: white; /* Couleur initiale des liens */
    font-size: 20px;
    text-decoration: none; /* Enlever le soulignement par défaut */
    /* transition: color 0.3s ease; Transition fluide pour la couleur */
}
</style>

</body>
</html>
