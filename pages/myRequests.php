<?php
    include('../config/db.php');
?>

<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="../assets/css/myDonations-myRequests.css" rel="stylesheet" />
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
        <title>Don't waste it-my requests</title>
    </head>

<body>
    <header>
        <?php
            include('../includes/header.php');
            include('../includes/navigation.php');
        ?>
    </header>
    
    

        <!--View all donation requests requested by the user< -->

        <p class = "pBottom" align = "center" dir = "rtl">
        כאן תוכל/י לצפות בסטטוסים של כל הבקשות שביצעת לקבלת תרומות שפורסמו על ידי משתמשים.
        <br> במידה והתרומה אושרה על ידי המפרסם, הינך מוזמן/ת ליצור עמו קשר על מנת לתאם את מועד האיסוף.
        <p>

    <main class="modal-win bottom">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">הבקשות שלי</h4>
        </div>
        <sectiion class="showPosts modal-body">
            <div class="box">
                <div class="content">

                <?php

                    $currentUser = $_SESSION['userNum'];
                    $sql =  " SELECT *
                        FROM donations
                        INNER JOIN users ON users.userNum = donations.donor
                        INNER JOIN getDonation ON getDonation.donation_id = donations.id
                        WHERE getDonation.requestsUser_id = '$currentUser'";

                    $gotResuslts = mysqli_query($connection,$sql);

                    if($gotResuslts){

                        if(mysqli_num_rows($gotResuslts)<1){
    
                            echo "<p align='center'> עדיין לא ביקשת תרומות </p>";
                           
                            ?>
                            <img class="waiting-pic shadow" src="../assets/images/waiting.png"/>
                            
                            <?php
                        }

                        else{
                                while($row = mysqli_fetch_array($gotResuslts)){
                                    $date_now = date("Y-m-d");
                                    $date2 = $row["publishDate"];
                                    $date1_ts = strtotime($date_now);
                                    $date2_ts = strtotime($date2);
                                    $diff_date = round($date1_ts - $date2_ts)/86400;
                                    if($diff_date<=90){
                                ///By clicking on donate the user will receive the full donation details
                                ?>
                                <artical class='col-lg-12 border float-left' id="postShow" onClick="location.href='../pages/showDonationDetails.php?id=<?php echo $row["id"];?>'">
                                    
                                <img class='pic float-right mr-2' src='../assets/uploads/<?php echo $row['image']; ?>'>
                                
                                <div class = "float-right">
                                    <p id='sentence' class='title float-right mr-2'> <?php echo $row['title']; ?></p>
                                    <br>

                                    <p id='sentence' class='text-cut float-right mr-2'> <?php echo $row['des']; ?></p>
                                    
                                    <br><br>
                                    <img  class='alignName  picInMyRequest mr-2'  src='../assets/images/avatars/<?php echo $row['profilePic']; ?>'>
                                    <span class='alignName  name ml-3'><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></span>
                                </div>

                                <div class = "status-buttons">
                                    <br>
                                    <?php
                                    ///Status view of the donation process

                                    $status = $row['requestStatus'];
                                    switch ($status) {
                                        case 'ממתין לאישור': ?>
                                            <p id = 'orange' class='status'>  <?php echo $status ?> </p>
                                            <?php break?>
                                            
                                        <?php
                                        case 'אושר': ?>
                                            <p id = 'green' class='status'> <?php echo $status ?> </p>

                                            <a href="../pages/donorContact.php?user_id=<?php echo $row["userNum"];?>&address=<?php echo $row["address"];?>">
                                            <intput type="button" class="btnInProfile btn btn-whatsapp-maps">
                                            <img class="whatsapp-maps-image whatsapp-inProfile float-left" src="../assets/images/whatsapp.png" />
                                            <img class="whatsapp-maps-image maps-inProfile float-left" src="../assets/images/Google_Maps_icon.png" />
                                            </input>
                                            </a> 
                                            <?php break?>

                                        <?php
                                        case 'לא אושר':?>
                                            <p id = 'red' class='status '>  <?php echo $status ?> </p>
                                            <?php break?>
                                            
                                        <?php
                                        }
                                    ?>
                                </div>
                                </artical>
                    <?php
                                    
                                }
                            }
                        }
                    }
                    ?>  
            
        </div>  
    </div> 
</div>             
</section>
</div>
</main>
 

    <footer>
        <?php
            include('../includes/footer.php');
        ?>
    </footer>
    
</body>
</html>