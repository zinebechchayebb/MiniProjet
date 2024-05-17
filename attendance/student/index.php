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

<!-- head started -->
<head>
<title>Presence management system</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../css/main.css">

</head>
<!-- head ended -->

<!-- body started -->
<body>

<!-- Menus started-->
<header>

  <h1>Presence management system</h1>
  <div class="navbar">
  <a href="index.php">Home</a>
  <a href="students.php">Students</a>
  <a href="account.php">My Account</a>
  <a href="../logout.php">Logout</a>

</div>
</header>
<!-- Menus ended -->

<center>

<!-- Content, Tables, Forms, Texts, Images started -->
<div class="row">
    <div class="content">
      <p>Be diligent about attending school regularly and on time to maximize your learning opportunities</p>
    <img src="../img/pic.gif" height="800px" width="800px" />

  </div>

</div>
<!-- Contents, Tables, Forms, Images ended -->

</center>
<style>
  h1 {
    color: #FF0000; /* rouge */
    font-family: "Arial Black", sans-serif; /* belle font-family */
    font-weight: bold; /* en gras */
    font-size: 40px;
    animation: fadeIn 2s ease; /* animation fadeIn pendant 2 secondes */
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
p{
  font-size: 20px;
}




/* Styler la barre de navigation */
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
<!-- Body ended  -->

</html>
