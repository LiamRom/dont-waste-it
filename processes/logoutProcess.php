<meta charset="UTF-8">
<?php
session_start();

//Deletes the session and disconnects the user from the system

session_destroy();

header("Location:../index.php?success=loggedOut");
