<?php
ob_start();
session_start();

// Check if the session is valid
if($_SESSION['name']!='oasis') {
  header('location: ../login.php');
  exit(); // Stop further execution
}
?>

<?php include('connect.php'); ?>

<?php
try {
    // Fetch connected user's account information
    // $sid = $_SESSION['id'];

    // Prepare and execute the query
    $stmt = $mysqli->prepare("SELECT * FROM students WHERE st_id = ?");
    $stmt->bind_param("i", $sid);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch student data
    $data = $result->fetch_assoc();

    // Close statement
    $stmt->close();

    // Check if the form is submitted for updating user info
    if(isset($_POST['done'])) {


        // Prepare update statement with placeholders
        $stmt = $mysqli->prepare("UPDATE students SET st_name=?, st_dept=?, st_sem=?, st_email=? WHERE st_id=?");

        // Bind parameters and execute the statement
        $stmt->bind_param("ssssi", $_POST['name'], $_POST['dept'], $_POST['semester'], $_POST['email'], $sid);
        $stmt->execute();

        // Check if any rows were affected
        if ($stmt->affected_rows > 0) {
            $success_msg = 'Updated successfully';
        } else {
            throw new Exception("No records updated");
        }
        
        // Close statement
        $stmt->close();
    }
} catch(Exception $e) {
    $error_msg = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Presence Management System</title>
<meta charset="UTF-8">
  
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
   
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
   
  <link rel="stylesheet" href="styles.css" >
   
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
      <h3>My Account</h3>
      <br>
      <!-- Error or Success Message printing -->
      <p>
        <?php
          if(isset($success_msg)) {
            echo $success_msg;
          }
          if(isset($error_msg)) {
            echo $error_msg;
          }
        ?>
      </p>
      <br>
      <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
      <form method="post" action="" class="form-horizontal "> 

         <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-7">
            <input type="text" name="name"  class="form-control" id="input1" value="<?php echo $data['st_name']; ?>" />
          </div>
        </div>
        <div class="form-group">
          <label for="input2" class="col-sm-3 control-label">Department</label>
          <div class="col-sm-7">
            <input type="text" name="dept"  class="form-control" id="input2" value="<?php echo $data['st_dept']; ?>" />
          </div>
        </div>
        <div class="form-group">
          <label for="input3" class="col-sm-3 control-label">Semester</label>
          <div class="col-sm-7">
            <input type="text" name="semester"  class="form-control" id="input3" value="<?php echo $data['st_sem']; ?>" />
          </div>
        </div>
        <div class="form-group">
          <label for="input4" class="col-sm-3 control-label">Email</label>
          <div class="col-sm-7">
            <input type="email" name="email"  class="form-control" id="input4" value="<?php echo $data['st_email']; ?>" />
          </div>
        </div>
         <!-- <input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Update" name="done" />  -->
        <input type="submit" class="btn" value="Update" name="done" />

       </form>
    </div>
  </div>


  <style>
    h1 {
    color: #FF0000; /* rouge */
    font-family: "Arial Black", sans-serif; /* belle font-family */
    font-weight: bold; /* en gras */
    font-size: 40px;
    margin-bottom: 30px;
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
.navbar {
  background-color: #007BFF; /* Bleu */
}
.navbar a {
    color: white; /* Couleur initiale des liens */
    font-size: 20px;
    text-decoration: none; /* Enlever le soulignement par défaut */
    /* transition: color 0.3s ease; Transition fluide pour la couleur */
}
/* Style pour le titre */
.content h3 {
    font-family: "Arial Black", sans-serif; /* Belle police */
    font-size: 28px; /* Taille du titre */
    color: #333; /* Couleur du texte */
}

/* Style pour les étiquettes */
.form-group label {
    font-family: "Arial", sans-serif; /* Police propre */
    font-size: 18px; /* Taille de police */
    color: #555; /* Couleur du texte */
}

/* Style pour les champs de formulaire */
.form-control {
    font-family: "Arial", sans-serif; /* Police propre */
    font-size: 18px; /* Taille de police */
}

/* Style pour le bouton */
.btn {
    font-family: "Arial", sans-serif; /* Police propre */
    font-size: 25px; /* Taille de police */
    margin-top: 15px;
    position: center
    ;
    bottom: -50px; /* Décalage vers le bas */
            right: 1; Alignement à droite
    padding: 10px 20px; /* Espace intérieur */
    background-color: #007bff; /* Couleur de fond bleue */
    border-color: #007bff; /* Couleur de la bordure */
    color: #fff; /* Couleur du texte */
    border-radius: 5px; /* Coins arrondis */
}

/* Style pour le bouton au survol */
</style>
</center>

</body>
</html>
