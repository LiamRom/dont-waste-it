<?php
    include('../config/db.php');
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="../assets/css/generalStyle.css" rel="stylesheet" />
    <link href="../assets/css/login-register.css" rel="stylesheet" />
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <title>Don't waste it-registration</title>
</head>

<body>
    
    <header>
        <?php
            include('../includes/header.php');
          include('../includes/navigation.php');
        ?>
    </header>
    

        <div class="row">
            <main class="modal-register login bottom pTop">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">הרשמה</h4>
                    </div>
                    <div class="modal-body">
                    <div class="messages">
                    <?php
                        //Error message in case incorrect details were entered

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
                            }else if($_GET['error'] == 'emptyEmail'){
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
                            }else if($_GET['error'] == 'userCrateFailed'){
                                ?>
                                    <small class="alert alert-danger">
                                        משהו השתבש
                                    </small>
                                <?php
                            }else if($_GET['error'] == 'userExtists'){
                                ?>
                                    <small class="alert alert-danger">
                                        קיים משתמש עם כתובת מייל זהה
                                    </small>
                                <?php
                            }
                        }else if(isset($_GET['success'])){
                            if($_GET['success'] == 'userCreated'){
                                ?>
                                    <small class="alert alert-success">
                                        ההרשמה בוצעה בהצלחה
                                    </small>
                                <?php   
                            }
                        }
                        

                    ?>
  
                </div>
                        <!--New user registration form < -->

                        <div class="box">
                            <div class="content">
                                <div class="form login">
    
                                <form class="form-signin" action="../processes/signupProcess.php" method="POST">

                                    <?php
                                        if(isset($_GET['firstName'])){
                                            $firstName = $_GET['firstName'];
                                            echo '<input type="text" id="inputFirstName" name="firstName" class="form-control" placeholder="שם פרטי" dir="rtl" value='.$firstName.'>';
                                        }
                                        else{
                                            echo '<input type="text" id="inputFirstName" name="firstName" class="form-control" dir="rtl" placeholder="שם פרטי">';
                                        }
                                    ?>

                                    <?php
                                        if(isset($_GET['lastName'])){
                                            $lastName = $_GET['lastName'];
                                            echo '<input type="text" id="inputLastName" name="lastName" class="form-control" dir="rtl" placeholder="שם משפחה" value='.$lastName.'>';
                                        }
                                        else{
                                            echo '<input type="text" id="inputLastName" name="lastName" class="form-control" dir="rtl" placeholder="שם משפחה">';
                                        }
                                    ?>

                                    <?php
                                        if(isset($_GET['phone'])){
                                            $phone = $_GET['phone'];
                                            echo '<input type="tel" id="inputPhone" name="phone" class="form-control" placeholder="טלפון נייד" value='.$phone.'>';
                                        }
                                        else{
                                            echo '<input type="tel" id="inputPhone" name="phone" class="form-control" placeholder="טלפון נייד">';
                                        }
                                    ?>

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
                                    
                                    <fieldset class="imagesBorder">
                                        
                                    <legend class="imagesTitle">בחירת תמונת פרופיל</legend>

                                    <div class="container parent">
                                    <div class="row">
                                        <div class='col'>
                                            <label>
                                                <input type="radio" name="profilePic" value="ava1" checked>
                                                <img class ="avatar-pic" src="../assets/images/avatars/ava1.png">
                                            </label>
                                        </div>

                                        <div class='col'>
                                            <label>
                                                <input type="radio" name="profilePic" value="ava2">
                                                <img class ="avatar-pic" src="../assets/images/avatars/ava2.png">
                                            </label>
                                        </div>

                                        <div class='col'>
                                            <label>
                                                <input type="radio" name="profilePic" value="ava3">
                                                <img class ="avatar-pic" src="../assets/images/avatars/ava3.png">
                                            </label>
                                        </div>

                                        <div class='col'>
                                            <label>
                                                <input type="radio" name="profilePic" value="ava4">
                                                <img class ="avatar-pic" src="../assets/images/avatars/ava4.png">
                                            </label>
                                        </div>

                                    </div>
                                    </div>

                                    <div class="container parent">
                                    <div class="row">

                                        <div class='col'>
                                            <label>
                                                <input type="radio" name="profilePic" value="ava5">
                                                <img class ="avatar-pic" src="../assets/images/avatars/ava5.png">
                                            </label>
                                        </div>

                                        <div class='col'>
                                            <label>
                                                <input type="radio" name="profilePic" value="ava6">
                                                <img class ="avatar-pic" src="../assets/images/avatars/ava6.png">
                                            </label>
                                        </div>

                                        <div class='col'>
                                            <label>
                                                <input type="radio" name="profilePic" value="ava7">
                                                <img class ="avatar-pic" src="../assets/images/avatars/ava7.png">
                                            </label>
                                        </div>

                                        <div class='col'>
                                            <label>
                                                <input type="radio" name="profilePic" value="ava8">
                                                <img class ="avatar-pic" src="../assets/images/avatars/ava8.png">
                                            </label>
                                        </div>

                                    </div>
                                    </div>

                                    <div class="container parent">
                                    <div class="row">

                                        <div class='col'>
                                            <label>
                                                <input type="radio" name="profilePic" value="ava9">
                                                <img class ="avatar-pic" src="../assets/images/avatars/ava9.png">
                                            </label>
                                        </div>

                                        <div class='col'>
                                            <label>
                                                <input type="radio" name="profilePic" value="ava10">
                                                <img class ="avatar-pic" src="../assets/images/avatars/ava10.png">
                                            </label>
                                        </div>

                                        <div class='col'>
                                            <label>
                                                <input type="radio" name="profilePic" value="ava11">
                                                <img class ="avatar-pic" src="../assets/images/avatars/ava11.png">
                                            </label>
                                        </div>

                                        <div class='col'>
                                            <label>
                                                <input type="radio" name="profilePic" value="ava12">
                                                <img class ="avatar-pic" src="../assets/images/avatars/ava12.png">
                                            </label>
                                        </div>

                                    </div>
                                    </div>
                                            
                                    <div class="container parent">
                                    <div class="row">

                                        <div class='col'>
                                            <label>
                                                <input type="radio" name="profilePic" value="ava13">
                                                <img class ="avatar-pic" src="../assets/images/avatars/ava13.png">
                                            </label>
                                        </div>
                                            
                                        <div class='col'>
                                            <label>
                                                <input type="radio" name="profilePic" value="ava14">
                                                <img class ="avatar-pic" src="../assets/images/avatars/ava14.png">
                                            </label>
                                        </div>
                                            
                                        <div class='col'>
                                            <label>
                                                <input type="radio" name="profilePic" value="ava15">
                                                <img class ="avatar-pic" src="../assets/images/avatars/ava15.png">
                                            </label>
                                        </div>
                                            
                                        <div class='col'>
                                            <label>
                                                <input type="radio" name="profilePic" value="ava16">
                                                <img class ="avatar-pic" src="../assets/images/avatars/ava16.png">
                                            </label>
                                        </div>

                                    </div>
                                    </div>
                                </fieldset>

                                    
                                    <input type="submit" name="submit" value="הרשמה" class="btn btn-default btn-login">
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>

                <!--link to a login page in case user have an account< -->

                <div class="modal-footer">
                    <div class="foot login-footer"> 
                        <span>כבר יש לך חשבון?
                        <a href="../pages/login.php">התחבר/י</a>
                        </span>
                    </div>
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