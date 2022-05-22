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
    <link href="../assets/css/login-register.css" rel="stylesheet" />
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <title>Don't waste it-login</title>


</head>

<body>

    <header>
        <?php
         include('../includes/header.php');
         include('../includes/navigation.php');
        ?>
    </header>
    
    <div class="row">
            <main class="modal-dialog login">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">התחברות</h4>
                    </div>
                    <div class="modal-body">
                    <div class="messages">
                    <?php
                        //User alerts

                        if(isset($_GET['error'])){

                            if($_GET['error'] == 'emptyEmail'){
                                ?>
                                    <small class="alert alert-danger">
                                        נא להזין כתובת מייל
                                    </small>
                                <?php
                            }else if($_GET['error'] == 'emptyPassword'){
                                ?>
                                    <small class="alert alert-danger">
                                        נא להזין סיסמה
                                    </small>
                                <?php
                            }else if($_GET['error'] == 'invalidEmail'){
                                ?>
                                    <small class="alert alert-danger">
                                        נא להזין כתובת מייל תקנית
                                    </small>
                                <?php
                            }else if($_GET['error'] == 'userloginFailed'){
                                ?>
                                    <small class="alert alert-danger">
                                    כתובת המייל או הסיסמה אינם תקינים
                                    </small>
                                <?php
                            }
                        }else if(isset($_GET['success'])){
                            if($_GET['success'] == 'loggedIn'){
                                ?>
                                    <small class="alert alert-success">
                                        ההתחברות בוצעה בהצלחה
                                    </small>
                                <?php
                            }
                        }
                    ?>
                    </div>
                    <!--Login form< -->

                        <div class="box">
                            <div class="content">
                                <div class="form loginBox">
    
                                <form class="form-signin" action="../processes/loginProcess.php" method="POST">

                                <?php
                                    if(isset($_GET['email'])){
                                        $email = $_GET['email'];
                                        echo '<input type="email" id="inputEmail" name="email" class="form-control" placeholder="כתובת מייל" value='.$email.'>';
                                    }
                                    else{
                                        echo '<input type="email" id="inputEmail" name="email" class="form-control" placeholder="כתובת מייל">';
                                    }
                                ?>
                
                                    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="סיסמה">
                                    
                                    <input type="submit" name="submit" value="התחברות" class="btn btn-default btn-login">
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                <!--link to registration if the user does not have an account< -->

                <div class="modal-footer">
                    <div class="foot login-footer"> 
                        <span>עדיין אין לך חשבון?
                        <a href="../pages/register.php">ליצירת חשבון</a>
                        </span>
                    </div>
                </div>
        
            </div>

        </main>
        </div>
    
    <footer>
        <?php
            include('../includes/footer.php');
        ?>
    </footer>
    
</body>
</html>