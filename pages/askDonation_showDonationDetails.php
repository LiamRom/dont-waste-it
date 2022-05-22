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
    <title>Don't waste it-show donation</title>
</head>
<body>
   <header>
        <?php
            include('../includes/header.php');
            include('../includes/navigation.php');
        ?>
    </header>
    
    

 
    <?php
    $type= $_GET["type"];
    $current = $_GET["id"];
    $currentUser = $_SESSION['userNum'];
    
     //Alert status update after reading, is only done if there is login through the alerts
    $query ="UPDATE `notification` SET `read_status` = 'read' WHERE (donation_id = $current AND requestsUser_id=$currentUser AND type='$type')";

        $inserted = mysqli_query($connection,$query);
    ?>

<!--View donation details < -->
<?php
    
    $sql = "SELECT * FROM donations                         
    INNER JOIN users ON users.userNum = donations.donor
    WHERE id=$current";
    
    $gotResuslts = mysqli_query($connection,$sql);
     
    if($gotResuslts){
                            
        while($row = mysqli_fetch_array($gotResuslts)){
            ?>  
                 <main class="modal-win bottom">
                     <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">תרומה- <?php echo $row['title']; ?></h4>
                    </div>
                    <div class="modal-body">
                     <div class="row">
                             <div class="col-lg-6">
                               <div class=" mt-10">
                                   <div class="row">
                                       <div>
                                           <h8 class="mb-0">שם התורם:</h8>
                                       </div>
                                       <div class="user-info">
                                            <?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?>
                                       </div>
                                   </div>
                                   <hr>
                                   <div class="row">
                                       <div>
                                           <h8 class="mb-0">תיאור:</h8>
                                       </div>
                                       <div class="user-info">
                                           <?php echo $row['des']; ?>
                                       </div>
                                   </div> 
                                   <hr>
                                   <div class="row">
                                       <div>
                                           <h8 class="mb-0">כמות:</h8>
                                       </div>
                                       <div class="user-info">
                                           <?php echo $row['amount']; ?>
                                       </div>
                                   </div>
                                   <hr>
                                   <div class="row">
                                       <div>
                                           <h8 class="mb-0">מקור המזון:</h8>
                                       </div>
                                       <div class="user-info">
                                           <?php echo $row['source']; ?>
                                       </div>
                                   </div>
                                   <hr>
                                   <div class="row ">
                                       <div>
                                           <h8 class="mb-0">בתוקף עד:</h8>
                                       </div>
                                       <?php
                                         $reversed_date = date('d-m-Y',strtotime($row["expired"]));
                                        ?>
                                       <div class="user-info">
                                           <?php echo $reversed_date; ?>

                                       </div>
                                   </div>
                                   <hr>
                                   <div class="row">
                                       <div>
                                           <h8 class="mb-0">כתובת לאיסוף:</h8>
                                       </div>
                                       <div class="user-info">
                                        <?php echo $row['address']; ?>
                                       </div>
                                   </div>                                   
                                 </div>
                             </div>
                             <div class="col-lg-6">
                               <img class="picShowDonation shadow float-left" src='../assets/uploads/<?php echo $row['image']; ?>' />
                             </div>
                         </div>

                         <br>
                         
                         <?php
                    //Checking the status of the alert which the user came through,button display suitable for alert
                    //This view is performed only if the user has reached the page by clicking on the alert
                    
                    
                   $donationStatus= $row['donationStatus']; 
                        if($type=='request' ){
                            
                            if($donationStatus=='0'){
                               ?>
                                <a href="../pages/donationRequests.php?id=<?php echo $row["id"]; ?>"><input type=button class="btn btn-info" value='לצפייה בכל הבקשות'></a>
                                 </center>
                               <?php
                            }
                           
                                 if($donationStatus=='1'){

                                        $sql = "SELECT `requestsUser_id` FROM `getDonation` WHERE (`donation_id`='$current' AND requestStatus='אושר') ";
                                        
                                        $gotResuslts = mysqli_query($connection,$sql);

                                        if($gotResuslts){
                                                                
                                            while($row = mysqli_fetch_array($gotResuslts)){
                                                ?>
                                                <br>

                                                <center>
                                                <h8 class="mb-0">כבר אישרת בקשה זו</h8>
                                                </center>
                                                <br>

                                                <a href="../pages/requestsContact.php?user_id=<?php echo $row["requestsUser_id"]; ?>"><input type=button class="btn btn-info" value='ליצירת קשר עם הנתרם'></a>
                                                <?php

                                                
                                    }
                                }
                                
                            }

                       }  if($type=='approved' ){
                           ?>
                               <a href="../pages/donorContact.php?user_id=<?php echo $row["userNum"];?>&address=<?php echo $row["address"];?>"><input type=button class="btn btn-info" value='ליצירת קשר עם התורם '></a>
                                 </center>
                                   <?php
                       } 
                   
                }
            }
    ?>



                                
                </div>
            </div>
        </div>
    </main>

       <footer>
        <?php
            include('../includes/footer.php');
        ?>
    </footer>


</body>
</html>