<?php
// Checking empty fields//if the form has been submitted then the data is sends to server using
//post method 
if (isset($_POST['login'])) {
    try {
        
        if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['type'])) {
            throw new Exception("Username, password, and role are required!");
        }
        //Here, the code checks if the 'username', 'password', and 'type' fields submitted via the POST method are empty. If any of these fields are empty, it throws an exception with the message "Username, password, and role are required!".


        // Establishing connection with the database
        include('connect.php');

        // Checking login info into the database using prepared statements
        $stmt = $mysqli->prepare("SELECT * FROM admininfo WHERE username=? AND password=? AND type=?");
        $stmt->bind_param("sss", $_POST['username'], $_POST['password'], $_POST['type']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            session_start();
            $_SESSION['name'] = "oasis"; // Assuming you need this for some other purpose
            $_SESSION['email'] = $row['email']; // Assuming the email column name is 'email'fait référence à la colonne email de la ligne récupérée de la base de données. L'indice 'email' est le nom de la colonne dans la base de données où l'adresse e-mail de l'utilisateur est stockée.
            
            // Redirect based on the user role
            switch ($_POST["type"]) {
                case 'teacher':
                    header('Location: teacher/index.php');//case 'teacher':: Si le rôle de l'utilisateur est "teacher" (enseignant), la redirection se fait vers la page teacher/index.php.
                    exit();
                case 'student':
                    header('Location: student/index.php');//case 'student':: Si le rôle de l'utilisateur est "student" (étudiant), la redirection se fait vers la page student/index.php.
                    exit();
                // case 'admin':
                //     header('Location: admin/index.php');
                //     exit();
                default:
                    throw new Exception("Invalid role!");
            }
        } else {
            throw new Exception("Username, password, or role is wrong. Please try again!");
        }
    } catch (Exception $e) {
        $error_msg = $e->getMessage();//$e fait reference a l'exeption capturee///
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presence management system</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <style>
       body {
          background-color: #f5f5dc; /* beige */
}
</style>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="text-center">Login</h3>
                </div>
                <div class="card-body">
                    <?php
                    //printing error message  elle affiche un message d'erreur formaté dans une boîte d'alerte de danger Bootstrap.
                    if(isset($error_msg))
                    {
                        echo '<div class="alert alert-danger" role="alert">'.$error_msg.'</div>';
                    }
                    ?>
                    <form method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Your username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Your password">
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
                        <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
                    </form>
                    <div class="mt-3 text-center">
                        <strong>if you haven't created an account, <a href="signup.php">Signup</a> here.</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>