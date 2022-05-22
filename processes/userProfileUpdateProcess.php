<?php
session_start();
// Report all PHP errors
error_reporting(E_ALL);


if(isset($_POST['update'])){
    // Enter the updated user information into the database

        include('../config/db.php');

        if(empty($_POST['UPfirstName'])){
                header('Location:../pages/userUpdate.php?error=emptyFirstName');
                exit;
            }
        if(empty($_POST['UPlastName'])){
                header('Location:../pages/userUpdate.php?error=emptyLastName');
                exit;
            }
        if(empty($_POST['UPphone'])){
                header('Location:../pages/userUpdate.php?error=emptyPhone');
                exit;
            }
        
        
        if(!empty($_POST['UPfirstName']) && !empty($_POST['UPlastName']) && !empty($_POST['UPphone'])){
            print_r("big if");

             $UPfirstName= $_POST['UPfirstName'];
             $UPlastName =   $_POST['UPlastName'];
             $UPphone    =   $_POST['UPphone'];
             
             print_r($UPfirstName);

                 
            $loggedInUser = $_SESSION['email'];
                                
            $sql = "UPDATE users SET firstName = '$UPfirstName', lastName ='$UPlastName', phone='$UPphone' WHERE email = '$loggedInUser'";
        
            $results = mysqli_query($connection,$sql);
           
        
            header('Location:../pages/userUpdate.php?success=userUpdated');    
        }
}

if(isset($_POST['pass'])){
    include('../config/db.php');
    // Enter the updated user password into the database

    if(!empty($_POST['currentPass']) && !empty($_POST['newPass']) && !empty($_POST['validPass'])){
             $currentPass= $_POST['currentPass'];
             $newPass = $_POST['newPass'];
             $validPass= $_POST['validPass'];
             
                $currentUser = $_SESSION['userNum'];
                $sql = "SELECT password FROM users WHERE userNum ='$currentUser'";
                $gotResuslts = mysqli_query($connection,$sql);
    
                if($gotResuslts){
                    $row = mysqli_fetch_array($gotResuslts);
                    $dbPass=$row['password'];
                    if($currentPass==$dbPass){
                        
                        if($validPass==$newPass){
                            print_r(" currect");
                            $new = "UPDATE users SET password = '$newPass' WHERE userNum = '$currentUser'";
                            $gotResuslts = mysqli_query($connection,$new);
                            header('Location:../pages/userUpdate.php?success=PassuserUpdated');    
                        }
                        else{
                            header('Location:../pages/userUpdate.php?error=notSame');
                        exit;}
                    }
            
                    else{
                        header('Location:../pages/userUpdate.php?error=notCurrect');
                                    exit;}
                }
    }else{
        header('Location:../pages/userUpdate.php?error=emptyPass');
                        exit;}
           
}

?>