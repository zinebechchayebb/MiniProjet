<!DOCTYPE html>
<html lang="en">
<head>
<title>Presence management system</title>
<meta charset="UTF-8">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
  .present {
    background-color: #5cb85c; /* Green */
    color: white;
  }
  .absent {
    background-color: #f0ad4e; /* Yellow */
    color: white;
  }
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
/* Styler la barre de navigation */


</style>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../css/main.css">

<header>
  <h1>Presence management system</h1>
  <div class="navbar">
    <a href="index.php">Home</a>
    <a href="students.php">Students</a>
    <a href="teachers.php">Teachers</a>
    <a href="../logout.php">Logout</a>
  </div>
</header>

<div class="container">
  <div class="row">
    <div class="content">
      <h3>Student List</h3>
      <br>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Registration No.</th>
            <th scope="col">Name</th>
            <th scope="col">Department</th>
            <th scope="col">Semester</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>

          </tr>
        </thead>
        <tbody>
          <?php
          include('connect.php');
          $stmt = $mysqli->prepare("SELECT st_id, st_name, st_dept, st_sem, st_email, attendance_status FROM students ORDER BY st_id ASC");
          $stmt->execute();
          $result = $stmt->get_result();
          if ($result->num_rows > 0) {
            while ($data = $result->fetch_assoc()) {
          ?>
              <tr>
                <td><?php echo $data['st_id']; ?></td>
                <td><?php echo $data['st_name']; ?></td>
                <td><?php echo $data['st_dept']; ?></td>
                <td><?php echo $data['st_sem']; ?></td>
                <td><?php echo $data['st_email']; ?></td>
                <td class="<?php echo $data['attendance_status'] === 'present' ? 'present' : 'absent'; ?>"><?php echo $data['attendance_status']; ?></td>
              </tr>
          <?php
            }
          } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
          }
          $stmt->close();
          ?>
        </tbody>
      </table>
      <form method="post" action="">
        <input type="submit" name="mark_attendance" value="Refresh" class="btn btn-primary">
      </form>
      <?php
      if (isset($_POST['mark_attendance'])) {
        header("Refresh:0");
      }
      ?>
    </div>
  </div>
</div>
<style>
  .navbar {
  background-color: #007BFF; /* Bleu */
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

</body>
</html>
