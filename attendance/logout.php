<?php
session_start();
session_destroy();//pour détruire toutes les données associées à la session actuelle. Cela signifie que toutes les variables de session stockées seront supprimées et la session sera invalidée.
header('location: index.php');//redirige l'utilisateur vers la page index.php après la destruction de la sessio
?>