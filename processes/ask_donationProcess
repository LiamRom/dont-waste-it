<?php
    include('../config/db.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Don't waste it</title>    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="../assets/css/generalStyle.css" rel="stylesheet" />
    <link href="../assets/css/userProfile-askDonation-newDonation.css" rel="stylesheet" />
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
session_start();

if(isset($_POST['submit'])){
            include('../config/db.php');
             //Create a new application for donation and entry into the database

            $requestsUser_id=$_SESSION['userNum'];
            $requestsUser_id=mysqli_real_escape_string($connection,strip_tags($requestsUser_id));
            $insurance = mysqli_real_escape_string($connection,strip_tags($_POST['agree']));
            $donationID = mysqli_real_escape_string($connection,strip_tags($_POST['donationID']));
            $requestStatus="ממתין לאישור";
            $correspondence=mysqli_real_escape_string($connection,strip_tags($_POST['correspondence']));
            
           

            $sql = "INSERT INTO getDonation (requestStatus,requestsUser_id, donation_id,insurance,correspondence) VALUES (
                '" . $requestStatus . "',
                '" . $requestsUser_id . "',
                '" . $donationID . "',
                '" . $insurance . "',
                '" . $correspondence . "'
                )";
            

            $inserted = mysqli_query($connection,$sql);

            $notification= "SELECT donor FROM donations WHERE id=$donationID";
            $select = mysqli_query($connection,$notification);
            $row = mysqli_fetch_assoc($select);
            $donor= $row['donor'];

            $query ="INSERT INTO notification (`donation_id`, `requestsUser_id`, `type`, `date`, `read_status`) VALUES ($donationID, $donor, 'request',CURRENT_TIMESTAMP, 'unread')";
            $insertion = mysqli_query($connection, $query);
            if($insertion){
                //If an alert exists - delete it and put a new one in its place

                }else{
                    $query ="DELETE FROM `notification` WHERE (donation_id = '$donationID' AND requestsUser_id='$donor')";
                    $DELETE = mysqli_query($connection, $query);

                    if($DELETE){
                        $query ="INSERT INTO notification (`donation_id`, `requestsUser_id`, `type`, `date`, `read_status`) VALUES ($donationID, $donor, 'request',CURRENT_TIMESTAMP, 'unread')";
                        $update = mysqli_query($connection, $query);
                    }
                }

            if($inserted){
                    //Displays a user indication for sending the donation request to the donor

                    ?>
                                    
                <div class="modal-approved bottom">
                <div class="modal-content">
                <div class="modal-header">
                <h4 align="center" class="modal-title">הבקשה נשלחה בהצלחה!</h4>
                </div>
                <div class="myDonations modal-body">
                <div class="box">
                <div class="content">
                    <p align="center">כעת בקשתך מחכה לאישור המשתמש </p>
                    <p align="center"> אנחנו נעדכן אותך בתשובתו בהקדם!</p>
                    <img class="hungry-pic" src="../assets/images/hungryMan.jpg" alt="hungryMan">
                    <br>
                    <input class="btn btn-info" type=button onClick="location.href='../index.php'" value='חזרה לעמוד הבית'>


                </div>
                </div>
                </div>
                </div>
                </div>

    </div>
    </div>
            <?php
                
            }
            

              
}
                

?>

       <footer>
        <?php
            include('../includes/footer.php');
        ?>
    </footer>
    
</body>
</html>
