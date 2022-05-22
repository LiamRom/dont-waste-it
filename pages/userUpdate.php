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
    <title>Don't waste it-edit user profile</title>

</head>
<body>
   <header>
        <?php
         include('../includes/header.php');
            include('../includes/navigation.php');
        ?>
    </header>
    
    

                
                <section class="modal-win bottom">
                     <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">עריכת פרטי משתמש</h4>
                    </div>
                    <div class="modal-body">
                    <div class="messages">
                    <?php
                        //User alerts corresponding to error in edit details

                        if(isset($_GET['error'])){

                            if($_GET['error'] == 'emptyFirstName'){
                                ?>
                                    <small class="alert alert-danger">
                                        נא להזין שם פרטי
                                    </small>
                                <?php
                            }else if($_GET['error'] == 'emptyLastName'){
                                ?>
                                    <small class="alert alert-danger">
                                       נא להזין שם משפחה
                                    </small>
                                <?php
                            }else if($_GET['error'] == 'emptyPhone'){
                                ?>
                                    <small class="alert alert-danger">
                                       נא להזין טלפון נייד
                                    </small>
                                <?php
                            }
                            }
                            else if(isset($_GET['success'])){
                            if($_GET['success'] == 'userUpdated'){
                                ?>
                                    <small class="alert alert-success" id= "disappear">
                                        העדכון בוצע בהצלחה
                                    </small>
                                <?php   
                            }
                        }
                    ?>
  
                </div>
                    <form action="../processes/userProfileUpdateProcess.php"
                      method="POST"
                      enctype="multipart/form-data" dir='rtl'>
                        
                    <!--User edit details view < -->
                    
                    <?php

                        $currentUser = $_SESSION['email'];
                        $sql = "SELECT * FROM users WHERE email ='$currentUser'";

                        $gotResuslts = mysqli_query($connection,$sql);

                        if($gotResuslts){
                            if(mysqli_num_rows($gotResuslts)>0){
                                while($row = mysqli_fetch_array($gotResuslts)){
                                    ?>
                                        <div class="row">
                                            <div>
                                                <h8 class="mb-0 user-edit" dir="rtl">שם פרטי:</h8>
                                            </div>
                                            <div>
                                            <input type="text" name="UPfirstName" class="form-control" value=<?php echo $row['firstName']; ?>>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div>
                                                <h8 class="mb-0 user-edit" dir="rtl">שם משפחה:</h8>
                                            </div>
                                            <div>
                                            <input type="text" name="UPlastName" class="form-control" value=<?php echo $row['lastName']; ?>>
                                            </div>
                                        </div>
                                        <hr>
                                        
                                        <div class="row">
                                            <div>
                                                <h8 class="mb-0 user-edit">טלפון נייד: </h8>
                                            </div>
                                            <div>
                                            <input type="text" name="UPphone" class="form-control" value=<?php echo $row['phone']; ?>>
                                            </div>
                                        </div>
                                        <hr>
                                        
                                        <input type="submit" name="update"  class="btn btn-info" value="עדכון פרטים">
                                    <?php
                                }
                            }
                        }
                    ?>
                </form>
                
                <center>
                       <a href="#passUpdate">לעדכון סיסמא</a>         
                            </div>
                        </div>
                </center>
        </div>
        </section>
        
                <section class="modal-win bottom" id="passUpdate">
                     <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">עדכון סיסמא</h4>
                    </div>
                    <div class="modal-body">
                    <div class="messages">
                    <?php
                        ///User alerts corresponding to error in user password update

                        if(isset($_GET['error'])){

                            if($_GET['error'] == 'notCurrect'){
                                ?>
                                    <small class="alert alert-danger">
                                        הסיסמא הנוכחית לא נכונה
                                    </small>
                                <?php
                            }else if($_GET['error'] == 'notSame'){
                                ?>
                                    <small class="alert alert-danger">
                                       אימות סיסמא חדשה שגוי
                                    </small>
                                <?php
                            }else if($_GET['error'] == 'emptyPass'){
                                ?>
                                    <small class="alert alert-danger">
                                        נא למלא את כל פרטי אימות הסיסמא
                                    </small>
                                <?php
                            }
                            }else if(isset($_GET['success'])){
                            if($_GET['success'] == 'PassuserUpdated'){
                                ?>
                                    <small class="alert alert-success" id= "disappear">
                                        העדכון בוצע בהצלחה
                                    </small>
                                <?php   
                            }
                        }
                        
                    ?>
  
                </div>
                <!--User view of password update < -->
                    <form action="../processes/userProfileUpdateProcess.php"
                      method="POST"
                      enctype="multipart/form-data" dir='rtl'  >
                                        <div class="row">
                                            <div>
                                                <h8 class="mb-0 user-edit2" dir="rtl">סיסמא נוכחית:</h8>
                                            </div>
                                            <div>
                                            <input type="text" name="currentPass" id="currentPass" class="form-control" >
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div>
                                                <h8 class="mb-0 user-edit2" dir="rtl">סיסמא חדשה:</h8>
                                            </div>
                                            <div>
                                            <input type="text" name="newPass" id="newPass" class="form-control" >
                                            </div>
                                        </div>
                                        <hr>
                                        
                                        <div class="row">
                                            <div>
                                                <h8 class="mb-0 user-edit2">אימות סיסמא חדשה:</h8>
                                            </div>
                                            <div>
                                            <input type="text" name="validPass" id="validPass" class="form-control" >
                                            </div>
                                        </div>
                                        <hr>
                                        
                                        <input type="submit" name="pass" class="btn btn-info" value="עדכון סיסמא">
                                    
                  </form>
                                
                    </div>
                </div>
        </div>
        </section>
        

        <script src="../assets/js/messages-disappear.js"></script>

    <footer>
        <?php
            include('../includes/footer.php');
        ?>
    </footer>
    
</body>
</html>