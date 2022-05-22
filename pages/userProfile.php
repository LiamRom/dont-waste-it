<?php
    include('../config/db.php');
?>

<!DOCTYPE html>
<html lang="en">
    
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="../assets/css/generalStyle.css" rel="stylesheet" />
    <link href="../assets/css/userProfile-askDonation-newDonation.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
        <title>Don't waste it-user profile</title>
        
    </head>

<body>
   <header>
        <?php
         include('../includes/header.php');
            include('../includes/navigation.php');
        ?>
    </header>
    
    

    
        <!--User profile view < -->

    <?php
        $currentUser = $_SESSION['email'];
        $sql = "SELECT * FROM users WHERE email ='$currentUser'";

        $gotResuslts = mysqli_query($connection,$sql);

        if($gotResuslts){
            if(mysqli_num_rows($gotResuslts)>0){
                while($row = mysqli_fetch_array($gotResuslts)){
                    ?>
                <main class="modal-win bottom">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">פרופיל משתמש</h4>
                    </div>
                    <div class="modal-body">
                         <div class="row">
                             <div class="col-lg-9">
                            <div class=" mt-10">
                                <div class="row">
                                    <div>
                                        <h8 class="mb-0" dir="rtl">שם פרטי:</h8>
                                    </div>
                                    <div class="user-info">
                                        <?php echo $row['firstName']; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div>
                                        <h8 class="mb-0" dir="rtl">שם משפחה:</h8>
                                    </div>
                                    <div class="user-info">
                                        <?php echo $row['lastName']; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div>
                                        <h8 class="mb-0">כתובת מייל:</h8>
                                    </div>
                                    <div class="user-info">
                                        <?php echo $row['email']; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div>
                                        <h8 class="mb-0">טלפון נייד:</h8>
                                    </div>
                                    <div class="user-info">
                                        <?php echo $row['phone']; ?>
                                    </div>
                                </div>
                                 <hr>
                                </div> 
                               
                                 </div>

                                <div class="col-lg-3">
                                <img class='picInProfile shadow float-left' src='../assets/images/avatars/<?php echo $row['profilePic']; ?>'>
                                </div>
                               
                            </div>
                       
                        
                         <input class="btn btn-info" type=button onClick="location.href='userUpdate.php'" value='לעריכת פרטים'>
                          </div>
                    </div>
                </div>
                </main>

            <?php
                }
            }
        }
    ?>        
    
<script src="../assets/js/messages.js"></script>

        <footer>
        <?php
            include('../includes/footer.php');
        ?>
    </footer>
    
</body>
</html>