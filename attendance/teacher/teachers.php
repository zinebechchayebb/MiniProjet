<?php

ob_start();
session_start();

if($_SESSION['name']!='oasis')
{
  header('location: login.php');
}
?>
<?php include('connect.php');?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Presence management system</title>
<meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
   
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
   
  <link rel="stylesheet" href="styles.css" >
   
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</style>

</head>
<body>

<header>

  <h1>Presence management system</h1>
  <div class="navbar">
  <a href="index.php">Home</a>
  <a href="students.php">Students</a>
  <a href="teachers.php">Teachers</a>
  <a href="../logout.php">Logout</a>

</div>

</header>
<style>
   h1 {
    color: #FF0000; /* rouge */
    font-family: "Arial Black", sans-serif; /* belle font-family */
    font-weight: bold; /* en gras */
    margin-top: 10px;
    margin-bottom: 30px;
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
  .navbar {
  background-color: #007BFF; /* Bleu */
}
.content h3 {
    font-family: "Arial Black", sans-serif; /* Utilisation d'une belle police */
    font-size: 24px; /* Taille de police créative */
    color: #333; /* Couleur du texte */
}
.content h3 {
    font-family: "Arial Black", sans-serif; /* Utilisation d'une belle police */
    font-size: 24px; /* Taille de police créative */
    color: #333; /* Couleur du texte */
}

.table {
    font-family: "Arial", sans-serif; /* Utilisation d'une police propre et lisible */
    font-size: 18px; /* Taille de police pour le tableau */
    border-collapse: collapse; /* Fusionner les bordures des cellules */
    width: 100%; /* Largeur du tableau */
}

.table th,
.table td {
    padding: 8px; /* Espace intérieur des cellules */
    border-bottom: 1px solid #ddd; /* Bordure basse des cellules */
    text-align: left; /* Alignement du texte à gauche */
}

.table th {
    background-color: #E2FFFF; /* Couleur de fond pour les en-têtes de colonne */
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f9f9f9; /* Couleur de fond pour les lignes impaires */
}

.table-striped tbody tr:hover {
    background-color: #f5f5f5; /* Couleur de fond au survol */
}
  </style>

<center>

<div class="row">

  <div class="content">
    <h3>Teacher List</h3>
    
    <table class="table table=stripped">
        <thead>  
          <tr>
            <th scope="col">Teacher ID</th>
            <th scope="col">Name</th>
            <th scope="col">Department</th>
            <th scope="col">Email</th>
            <th scope="col">Course</th>
          </tr>
        </thead>

        <?php

// Establish database connection
include('connect.php');

// Fetch teachers data
$tcr_query = $mysqli->query("SELECT * FROM teachers ORDER BY tc_id ASC");

// Check if there are any rows returned
if ($tcr_query->num_rows > 0) {
    $i = 0;
    while ($tcr_data = $tcr_query->fetch_assoc()) {
        $i++;
?>
        <tbody>
            <tr>
                <td><?php echo $tcr_data['tc_id']; ?></td>
                <td><?php echo $tcr_data['tc_name']; ?></td>
                <td><?php echo $tcr_data['tc_dept']; ?></td>
                <td><?php echo $tcr_data['tc_email']; ?></td>
                <td><?php echo $tcr_data['tc_course']; ?></td>
            </tr>
        </tbody>
<?php
    }
} else {
    echo "No data found";
}

// Close the database connection
$mysqli->close();
?>

          
    </table>

  </div>

</div>

</center>

</body>
</html>
