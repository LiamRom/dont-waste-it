<?php
    include('../config/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Don't waste it- contact and address</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="../assets/css/generalStyle.css" rel="stylesheet" />
    <link href="../assets/css/userProfile-askDonation-newDonation.css" rel="stylesheet" />
         <link href="../assets/css/myDonations-myRequests.css" rel="stylesheet" />
    <link href="../assets/css/requests.css" rel="stylesheet" />
    <title>Don't waste it-donor contact</title>
</head>
<body>

    <header>
        <?php
          include('../includes/header.php');
            include('../includes/navigation.php');
        ?>
    </header>
    

    


<?php
    $applicant = $_GET["user_id"];
?>

<!--Contact details of the person the donor has chosen to give the donation to < -->

<main class="modal-approved bottom">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">פרטי יצירת קשר</h4>
                </div>
            <div class="modal-body">
                
        <div class="box">
            <div class="content">

                <?php
                $sql =  "SELECT * FROM users WHERE userNum = '$applicant'";

                $gotResuslts = mysqli_query($connection,$sql);

                if($gotResuslts){
                
                    while($row = mysqli_fetch_array($gotResuslts)){
                        ?>
                        <p align="center" class="big-font-size title">ליצירת קשר עם מבקש התרומה:</p>
                        
                        <div id="picInApprove">
                          <img  class='alignName picInrequest'  src='../assets/images/avatars/<?php echo $row['profilePic']; ?>'>
                          <span class='alignName big-font-size ml-3'><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></span>
                        </div>
                        
                        <p align="center" class="big-font-size">במספר  <?php echo $row['phone']; ?></p>

                        
                        <form name="form_main" class = "form_main">
                            <input type="text" name="number" id="numberToSend" value=<?php echo $row['phone']; ?>>
                            <input type="text" name="message" id="messageToSend" value="היי, אישרתי לך את קבלת התרומה שפרסמתי. אשמח שנתאם מועד איסוף :)"><br>
                            <p id="end_url"></p>
                        </form>
                        <!--Link to WhatsApp with the relevant phone number < -->

                            <button type="button" class="btn btn-whatsapp-maps" onclick="generateLink()"><img class="whatsapp-maps-image float-right" src="../assets/images/whatsapp.png" />לחצו כאן</button>
                        </div>
                    </div>  
                    
                       <?php
                       
                                }
                            }
                            

                    ?>
                                
                </div>
            </div>
        </div>
    </div>
</div>                
</main>

<script src="../assets/js/whatsappURL.js"></script>

    <footer>
        <?php
            include('../includes/footer.php');
        ?>
    </footer>
    
    </body>
</html>