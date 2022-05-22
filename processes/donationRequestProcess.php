<?php
    include('../config/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Don't waste it- contact</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="../assets/css/generalStyle.css" rel="stylesheet" />
    <link href="../assets/css/userProfile-askDonation-newDonation.css" rel="stylesheet" />
         <link href="../assets/css/myDonations-myRequests.css" rel="stylesheet" />
    <link href="../assets/css/requests.css" rel="stylesheet" />

</head>
<body>

    <header>
        <?php
            include('../includes/header.php');
             include('../includes/navigation.php');
        ?>
    </header>
    

<?php
// Change the status of the donation id database

    $approved_id = $_GET["user_id"];
    $donation_id = $_GET["donation_id"];

    $sql = "UPDATE getDonation 
    SET requestStatus = 'אושר'
    WHERE (requestsUser_id = '$approved_id') AND (donation_id = '$donation_id')";

    $inserted = mysqli_query($connection,$sql);
    
    if ($inserted) {

        $sql = "UPDATE donations 
        SET donationStatus = '1'
        WHERE id = '$donation_id'";

        $inserted = mysqli_query($connection,$sql);

        $sql = "UPDATE getDonation 
        SET requestStatus = 'לא אושר'
        WHERE (requestsUser_id != '$approved_id') AND (donation_id = '$donation_id')";

        $inserted = mysqli_query($connection,$sql);
        
         $query ="INSERT INTO notification (`donation_id`, `requestsUser_id`, `type`, `date`, `read_status`) VALUES ($donation_id,  $approved_id, 'approved',CURRENT_TIMESTAMP, 'unread')";
        $inserted = mysqli_query($connection, $query);
        
        
    }

    else{
        header('Location:../pages/donationRequests.php?error=approveFailed');
        exit;
    }
?>

                    <!--Show the user an indication of his activity and his approval of the donation< -->

<div class="modal-approved bottom">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">האישור בוצע בהצלחה!</h4>
                </div>
            <div class="modal-body">
                
        <div class="box">
            <div class="content">

                <?php
                $sql =  "SELECT * FROM users WHERE userNum = ' $approved_id'";

                $gotResuslts = mysqli_query($connection,$sql);

                if($gotResuslts){
                
                    while($row = mysqli_fetch_array($gotResuslts)){
                        ?>
                        
                        <p align="center" class="title big-font-size">האישור בוצע עבור:</p>
                        
                        <div id="picInApprove">
                          <img  class='alignName  picInrequest'  src='../assets/images/avatars/<?php echo $row['profilePic']; ?>'>
                          <span class='alignName big-font-size ml-3'><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></span>
                        </div>
                        
                        <p align="center" class="big-font-size">מספר הטלפון-  <?php echo $row['phone']; ?></p>

                        <!--A WhatsApp link to contact the person who wanted the donation< -->
                        

                        <form name="form_main" class = "form_main">
                            <input type="text" name="number" id="numberToSend" value=<?php echo $row['phone']; ?>>
                            <input type="text" name="message" id="messageToSend" value="היי, אישרתי לך את קבלת התרומה שפרסמתי. אשמח שנתאם מועד איסוף :)"> <br>
                            <p id="end_url"></p>
                        </form>
                                <button type="button" class="btn btn-whatsapp-maps" onclick="generateLink()"><img class="whatsapp-maps-image float-right" src="../assets/images/whatsapp.png" />ליצירת קשר עם מבקש התרומה</button>
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
</div>

<footer>
        <?php
            include('../includes/footer.php');
        ?>
    </footer>
    
<script src="../assets/js/whatsappURL.js"></script>

     

    </body>
</html>
