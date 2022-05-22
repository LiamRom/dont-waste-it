<meta charset="UTF-8">
<?php
session_start();

if(isset($_POST['submit'])){
    //Creates a new user

    include('../config/db.php');

    $firstName =$_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phone = $_POST['phone'];
    $email =$_POST['email'];
    $password = $_POST['password'];
    $profilePic = $_POST['profilePic'];

    //first name is empty
    if(empty($_POST['firstName'])){
        header("Location:../pages/register.php?error=emptyFirstName&lastName=$lastName&phone=$phone&email=$email");
        exit;
    }

    //first name is empty
    if(empty($_POST['lastName'])){
        header("Location:../pages/register.php?error=emptyLastName&firstName=$firstName&phone=$phone&email=$email");
        exit;
    }

    //phone is empty
    if(empty($_POST['phone'])){
        header("Location:../pages/register.php?error=emptyPhone&firstName=$firstName&lastName=$lastName&email=$email");
        exit;
    }

    //email is empty
    if(empty($_POST['email'])){
        header("Location:../pages/register.php?error=emptyEmail&firstName=$firstName&lastName=$lastName&phone=$phone");
        exit;
    }

    //password is empty
    if(empty($_POST['password'])){
        header("Location:../pages/register.php?error=emptyPassword&firstName=$firstName&lastName=$lastName&email=$email&phone=$phone");
        exit;
    }


    if(!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['password'])){
        
        //Checks if the user's email exists in the system
        //Email must be unique
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            header("Location:../pages/register.php?error=invalidEmail&firstName=$firstName&lastName=$lastName&email=$email&phone=$phone");
            exit;
        }

        $firstName = mysqli_real_escape_string($connection,strip_tags($_POST['firstName']));
        $lastName = mysqli_real_escape_string($connection,strip_tags($_POST['lastName']));
        $phone = mysqli_real_escape_string($connection,strip_tags($_POST['phone']));
        $email = mysqli_real_escape_string($connection,strip_tags($_POST['email']));
        $password = mysqli_real_escape_string($connection,strip_tags($_POST['password']));
        $profilePic = mysqli_real_escape_string($connection,strip_tags($_POST['profilePic']));

        
        $sqlCheck = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($connection,$sqlCheck);

        if (mysqli_num_rows($result) === 1) {

                $_SESSION['email'] = $row['email'];
                $_SESSION['userNum'] = $row['userNum'];

                header('Location:../pages/register.php?error=userExtists');
                exit;   
            
        }
        
        $png = png;
        $profilePic =  $profilePic.'.'.$png;

        $sql = "INSERT INTO users (firstName, lastName ,phone, email, password, profilePic) VALUES (
            '" . $firstName . "',
            '" . $lastName . "',
            '" . $phone . "',
            '" . $email . "',
            '" . $password . "',
            '" . $profilePic . "'
            )";

        $inserted = mysqli_query($connection,$sql);

        if($inserted){

            $_SESSION['email'] = $email;
            $_SESSION['firstName'] = $firstName;
            
        $sql = "SELECT * FROM users WHERE email='$email'";
        print_r($sql);
        $result = mysqli_query($connection,$sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

                $_SESSION['userNum'] = $row['userNum'];
                $_SESSION['email'] = $email;
            
            
            header('Location:../index.php?success=userCreated');
            exit;
            }

        }else{
            header('Location:../pages/register.php?error=userCrateFailed');
            exit;
        }
    }

}