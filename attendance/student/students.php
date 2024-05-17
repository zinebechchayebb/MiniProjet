<?php

ob_start();
session_start();

if ($_SESSION['name'] != 'oasis') {
    header('location: login.php');
    exit(); // Stop further execution
}

include('connect.php');

// Assuming you have a variable for the current student's email in the session
$currentStudentEmail = $_SESSION['email'];

$stmt = $mysqli->prepare("SELECT st_id, st_name, st_dept, st_sem, st_email, attendance_status FROM students WHERE st_email = ?");
$stmt->bind_param("s", $currentStudentEmail);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Presence management system</title>
<meta charset="UTF-8">

<link rel="stylesheet" type="text/css" href="../css/main.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

<link rel="stylesheet" href="styles.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<header>
    <h1>Presence management system</h1>
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="students.php">Students</a>
        <a href="account.php">My Account</a>
        <a href="../logout.php">Logout</a>
    </div>
</header>

<center>

    <div class="row">

        <div class="content">
            <h3>My Attendance</h3>
            <br>

            <form method="post" action="">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Registration No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Department</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Email</th>
                        <th scope="col">Attendance</th>
                        <th scope="col">Status</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $data['st_id']; ?></td>
                        <td><?php echo $data['st_name']; ?></td>
                        <td><?php echo $data['st_dept']; ?></td>
                        <td><?php echo $data['st_sem']; ?></td>
                        <td><?php echo $data['st_email']; ?></td>
                        <td class="<?php echo $data['attendance_status'] === 'present' ? 'present' : 'absent'; ?>"><?php echo $data['attendance_status']; ?></td>


                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="attendance" value="present">
                                <label class="form-check-label">Present</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="attendance" value="absent">
                                <label class="form-check-label">Absent</label>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <input type="submit" name="mark_attendance" value="Mark Attendance" class="btn " >
            </form>

            <?php
            if (isset($_POST['mark_attendance'])) {
                $attendanceStatus = $_POST['attendance'];
                $stmt = $mysqli->prepare("UPDATE students SET attendance_status = ? WHERE st_email = ?");
                $stmt->bind_param("ss", $attendanceStatus, $currentStudentEmail);
                $stmt->execute();
                echo "<p>Attendance marked successfully!</p>";
        header("Refresh:0");

            }
            ?>

        </div>

    </div>

</center>
<style>
  .present {
    background-color: #5cb85c; /* Green */
    color: white;
  }
  .absent {
    background-color: #f0ad4e; /* Yellow */
    color: white;
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
h1 {
    color: #FF0000; /* rouge */
    font-family: "Arial Black", sans-serif; /* belle font-family */
    font-weight: bold; /* en gras */
    font-size: 40px;
    animation: fadeIn 2s ease; /* animation fadeIn pendant 2 secondes */
    margin-bottom: 30px;
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
input[type="submit"] {
    background-color: #007BFF; /* Couleur de fond bleue */
    color: #fff; /* Couleur du texte en blanc */
    border: none; /* Pas de bordure */
    padding: 10px 20px; /* Espacement intérieur du bouton */
    font-size: 16px; /* Taille de la police */
    cursor: pointer; /* Curseur pointeur */
    border-radius: 5px; /* Coins arrondis */
}

input[type="submit"]:hover {
    background-color: blue; /* Couleur de fond bleue plus foncée au survol */
}

</style>
</body>
</html>
