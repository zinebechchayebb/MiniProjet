<?php

include('connect.php');

try {
    if (isset($_POST['signup'])) {
        // Check for empty fields//Cela signifie que l'utilisateur a soumis le formulaire d'inscription.

        // Prepare and bind parameters for admininfo table script prépare une requête SQL pour insérer les informations d'inscription dans la table admininfo. Les données sont liées aux paramètres de la requête à l'aide de la méthode bind_param(), ce qui aide à prévenir les attaques par injection SQL.
        $stmtAdmin = $mysqli->prepare("INSERT INTO admininfo (username, password, email, fname, type) VALUES (?, ?, ?,  ?, ?)");
        $stmtAdmin->bind_param("sssss", $_POST['uname'], $_POST['pass'], $_POST['email'], $_POST['fname'],  $_POST['type']);

        // Execute the statement for admininfo table  
        if ($stmtAdmin->execute()) {
            //Si l'inscription réussit, le script procède à l'insertion des informations de l'étudiant dans la table students si le rôle sélectionné est "student".
            if ($_POST['type'] === 'student') {
                // Prepare and bind parameters for students table
                $stmtStudent = $mysqli->prepare("INSERT INTO students (st_id, st_name, st_dept, st_sem, st_email, attendance_status) VALUES (?, ?, ?, ?, ?, ?)");
                // Provide dummy values for student fields
                $st_id = ""; // Provide a unique student id here
                $st_name = $_POST['fname']; // Assuming the student's full name is used
                $st_dept = "informatique"; // Provide the student's department
                $st_sem = 1; // Provide the student's semester
                $st_email = $_POST['email']; // Use the same email provided during signup
                $attendance_status = "Absent"; // Default status
                $stmtStudent->bind_param("ssssss", $st_id, $st_name, $st_dept, $st_sem, $st_email, $attendance_status);
//nous lions toutes ces valeurs aux paramètres de la requête SQL pour l'insertion dans la table students. La chaîne "ssssss" indique que toutes les valeurs sont des chaînes de caractères (s). Le nombre de "s" correspond au nombre de paramètres que nous lions.
                // Execute the statement for students table
                if (!$stmtStudent->execute()) {
                    throw new Exception("Error in executing query: " . $mysqli->error);
                }
            }
            $success_msg = "Signup Successful!";
        } else {
            throw new Exception("Error in executing query: " . $mysqli->error);
        }

        // Close statements  Cette ligne ferme le statement préparé $stmtAdmin utilisé pour l'insertion des données dans la table admininfo. Cela libère les ressources utilisées par cette requête préparée.
        $stmtAdmin->close();
        // Cette structure conditionnelle vérifie si le statement préparé $stmtStudent existe. Si c'est le cas, cela signifie que l'inscription concerne un étudiant, et donc un statement préparé a été utilisé pour l'insertion des données dans la table students. Dans ce cas, le statement préparé $stmtStudent est fermé pour libérer les ressources.
        if (isset($stmtStudent)) {
            $stmtStudent->close();
        }
    }
} catch (Exception $e) {
    $error_msg = $e->getMessage();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presence management system - Signup</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1 class="text-center">Presence management system</h1>
</header>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="text-center">Signup</h3>
                </div>
                <div class="card-body">
                    <?php
                    // Printing success or error message
                    if(isset($success_msg)) echo '<div class="alert alert-success" role="alert">'.$success_msg.'</div>';
                    if(isset($error_msg)) echo '<div class="alert alert-danger" role="alert">'.$error_msg.'</div>';
                    ?>
                    <form method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Your email" required>
                        </div>
                        <div class="form-group">
                            <label for="uname">Username</label>
                            <input type="text" name="uname" class="form-control" id="uname" placeholder="Choose username" required>
                        </div>
                        <div class="form-group">
                            <label for="pass">Password</label>
                            <input type="password" name="pass" class="form-control" id="pass" placeholder="Choose a strong password" required>
                        </div>
                        <div class="form-group">
                            <label for="fname">Full Name</label>
                            <input type="text" name="fname" class="form-control" id="fname" placeholder="Your full name" required>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="student" value="student" checked>
                                    <label class="form-check-label" for="student">Student</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="teacher" value="teacher">
                                    <label class="form-check-label" for="teacher">Teacher</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="signup">Signup</button>
                    </form>
                    <div class="mt-3 text-center">
                        <strong>Already have an account? <a href="index.php">Login</a> here.</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    body {
    background-color: #F5F5DC; /* beige */
}

h1 {
    color: #FF0000; /* rouge */
    font-family: "Arial Black", sans-serif; /* belle font-family */
    font-weight: bold; /* en gras */
    margin-top: 25px;
    margin-bottom: 15x;
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


.card-header.bg-primary {
    background-color: #FF0000; /* rouge */
}

.btn.btn-primary {
    background-color: #007BFF; /* couleur normale */
    border-color: #007BFF; /* couleur de la bordure normale */
    color: #FFFFFF; /* couleur du texte */
}

.btn.btn-primary:hover {
    background-color: #0056B3; /* couleur foncée au survol */
    border-color: #0056B3; /* couleur de la bordure foncée au survol */
}


</style>
</body>
</html>
