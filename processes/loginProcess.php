<meta charset="UTF-8">

<?php
session_start();
    //User login

if(isset($_POST['submit'])){
    
    include('../config/db.php');

    $email =$_POST['email'];

    //email is empty
    if(empty($_POST['email'])){
        header('Location:../pages/login.php?error=emptyEmail');
        exit;
    }

    //password is empty
    if(empty($_POST['password'])){
        header("Location:../pages/login.php?error=emptyPassword&email=$email");
        exit;
    }

    //email and password not empty
    if(!empty($_POST['email']) && !empty($_POST['password'])){

        //email is not valid
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            header("Location:../pages/login.php?error=invalidEmail");
            exit;
        }

        $email = mysqli_real_escape_string($connection,strip_tags($_POST['email']));
        $password = mysqli_real_escape_string($connection,$_POST['password']);

        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($connection,$sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            
                $_SESSION['email'] = $row['email'];
                $_SESSION['userNum'] = $row['userNum'];
                header('Location:../index.php?success=loggedIn');
                exit;   
            
            
            }else{
                header('Location:../pages/login.php?error=userloginFailed');
                exit;
            }
        }

    else{
        header('Location:../pages/login.php?error=userloginFailed');
        exit;
    }
}

else{
    header('Location:../pages/login.php?error=userloginFailed');
    exit;
}

?>
