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
        <link href="../assets/css/myDonations-myRequests.css" rel="stylesheet" />
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
        <title>Don't waste it-my donations</title>
    </head>
    
<body>
     <header>
        <?php
            include('../includes/header.php');
            include('../includes/navigation.php');
        ?>
    </header>
    
    
 

    <div class="messages">
    <?php
        ///User alerts about deleting a donation

        if(isset($_GET['error'])){

            if($_GET['error'] == 'deleteionFailed'){
                ?>
                    <small class="alert alert-danger" id = 'disappear'>
                        לא ניתן למחוק את התרומה                      
                    </small>
                <?php
            }
        }else if(isset($_GET['success'])){
            if($_GET['success'] == 'donationDelete'){
                ?>
                    <small class="alert alert-success" id = 'disappear'>
                        התרומה נמחקה בהצלחה
                    </small>
                <?php   
            }
        }
    ?>
    </div>

    <p align = "center" dir = "rtl">
        כאן תוכל/י לצפות בכל התרומות שפרסמת.
        <br> ניתן לצפות בבקשות לכל תרומה שבוצעו על ידי המשתמשים.
        <br> יש לאשר בקשה למשתמש אחד ולאחר מכן לתאם מולו את מועד איסוף התרומה.
        <br><b>התרומה עתידה להמחק בתום 90 יום מתאריך פרסומה, אנו ממליצים לאשר וליצור קשר בהקדם :)</b>
</p>
    
  
    <main class="modal-win bottom">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">התרומות שלי</h4>
        </div>
        <section class="showPosts modal-body">
            <div class="box">
                <div class="content">


                <?php
                    //Appears if the user has not posted any donation

                    $currentUser = $_SESSION['userNum'];
                    $sql =  "SELECT * FROM donations WHERE donor ='$currentUser'";
                    $gotResuslts = mysqli_query($connection,$sql);

                    if($gotResuslts){

                        if(mysqli_num_rows($gotResuslts)<1){
    
                            echo "<p align='center'> עדיין לא פרסמת תרומות </p>";

                            ?>
                            <img class="waiting-pic" src="../assets/images/waiting.png"/>
                            

                            <?php
                        }

                        else{

                        //Displays a donation that has not expired and has been approved by the user

                        $currentUser = $_SESSION['userNum'];

                        $sql = "SELECT * 
                        FROM donations 
                        INNER JOIN getDonation ON getDonation.donation_id = donations.id
                        INNER JOIN users ON users.userNum = getDonation.requestsUser_id
                        WHERE (donor ='$currentUser' AND donationStatus = '1' AND requestStatus = 'אושר')
                        ORDER BY publishDate";

                        $gotResuslts = mysqli_query($connection,$sql);

                        if($gotResuslts){

                                while($row = mysqli_fetch_array($gotResuslts)){
                                    $date_now = date("Y-m-d");
                                    $date2 = $row["publishDate"];
                                    $date1_ts = strtotime($date_now);
                                    $date2_ts = strtotime($date2);
                                    $diff_date = round($date1_ts - $date2_ts)/86400;
                                    if($diff_date<=90){
                                ?>

                                <div className='container'>
                                <artical class='col-lg-12 border float-left' id="postShow" onClick="location.href='../pages/showDonationDetails.php?id=<?php echo $row["id"];?>'">

                                <img class='pic float-right mr-2' src='../assets/uploads/<?php echo $row['image']; ?>'>
                            
                                <div class = "float-right">
                                    <p id='sentence' class='title float-right mr-2'> <?php echo $row['title']; ?></p>
                                    <br>
                                    
                                    <p id='sentence' class='text-cut float-right mr-2'> <?php echo $row['des']; ?></p>
                                    <br><br>

                                    <?php
                                    $reversed_date = date('d-m-Y',strtotime($row["expired"]));
                                    ?>
                                    <p id='sentence' class='float-right mr-2'> תוקף המזון <?php echo $reversed_date; ?></p>
                                    
                                </div>

                                <div>
                                    
                                    <?php
                                     if ($diff_date == 0){
                                    ?>
                                        <p id='sentence' class='ml-2 published-text float-left'> פורסם היום</p>
                                    <?php
                                    }else{
                                        ?>
                                        <p id='sentence' class='ml-2 published-text float-left'> פורסם לפני <?php echo $diff_date ?> ימים</p>
                                    <?php
                                    }
                                    ?>
                                    <br>

                                    <p id = 'green' class='status'> <?php echo אושר ?> </p>

                                    <a href="../pages/requestsContact.php?user_id=<?php echo $row["userNum"];?>">
                                    <intput type="button" class="btn btn-whatsapp btnInProfile"><img class="whatsapp-image whatsapp-inProfile float-right" src="../assets/images/whatsapp.png" /></input></a>
                                   
                                    </div>

                               
                            </artical>

                            </div>  
                            
                    <?php
                                }
                            }
                        }
                   
            ?> 

                        <?php
                        //Displays donations that have not yet been approved but are valid

                        $currentUser = $_SESSION['userNum'];
                        $sql = "SELECT * 
                        FROM donations 
                        WHERE (donor ='$currentUser' AND donationStatus = '0')
                        ORDER BY publishDate";

                        $gotResuslts = mysqli_query($connection,$sql);

                        if($gotResuslts){

                                while($row = mysqli_fetch_array($gotResuslts)){
                                    $date_now = date("Y-m-d");
                                    $date2 = $row["publishDate"];
                                    $date1_ts = strtotime($date_now);
                                    $date2_ts = strtotime($date2);
                                    $diff_date = round($date1_ts - $date2_ts)/86400;
                                    if($diff_date<=90){

                                ?>

                                <div  className='container'>
                                <artical class='col-lg-12 border float-left' id="postShow" onClick="location.href='../pages/showDonationDetails.php?id=<?php echo $row["id"];?>'">                                
                                
                                <img class='pic float-right mr-2' src='../assets/uploads/<?php echo $row['image']; ?>'>

                                <div class = "float-right">
                                    <p id='sentence' class='title float-right mr-2'> <?php echo $row['title']; ?></p>
                                    <br>

                                    <p id='sentence' class='text-cut float-right mr-2'> <?php echo $row['des']; ?></p>
                                    <br><br>
                            
                                    <?php
                                    $reversed_date = date('d-m-Y',strtotime($row["expired"]));
                                    ?>
                                    
                                    <p id='sentence' class='float-right mr-2'> תוקף המזון <?php echo $reversed_date; ?></p> 

                                </div>

                                <div>

                                <?php
                                 if ($diff_date == 0){
                                ?>
                                    <p id='sentence' class='ml-2 published-text float-left'> פורסם היום</p>
                                <?php
                                }else{
                                    ?>
                                    <p id='sentence' class='ml-2 published-text float-left'> פורסם לפני <?php echo $diff_date ?> ימים</p>
                                <?php
                                }
                                ?>

                                <br>

                                <a href="../pages/donationRequests.php?id=<?php echo $row["id"]; ?>"><input class="btn btn-request float-left" type=button value='צפייה בבקשות'></a>
                                
                                <div class="click-to-top">
                                <a href="../processes/deleteProcess.php?id=<?php echo $row["id"]; ?>"><img class="tarsh-image float-left" src="../assets/images/trash.png" /></a>
                                <span>מחיקת התרומה</span>
                                </div>
                                
                                </div>

                            </artical>

                            </div>

                        <?php
                                }
                            }
                        }

                        ?> 

                        <?php

                        //Displays donations that have expired and cannot be clicked
                        $currentUser = $_SESSION['userNum'];
                        $sql = "SELECT * FROM donations WHERE (donor ='$currentUser')
                        ORDER BY publishDate";

                        $gotResuslts = mysqli_query($connection,$sql);

                        if($gotResuslts){
                            
                                while($row = mysqli_fetch_array($gotResuslts)){
                                    $date_now = date("Y-m-d");
                                    $date2 = $row["publishDate"];
                                    $date1_ts = strtotime($date_now);
                                    $date2_ts = strtotime($date2);
                                    $diff_date = round($date1_ts - $date2_ts)/86400;
                                    if($diff_date>90){

                                ?>

                                <div  className='container'>
                                <artical class='col-lg-12 border float-left' id="expired-post">
                                <img class='pic float-right mr-2 pic' src='../assets/uploads/<?php echo $row['image']; ?>'>
                                
                                <div class = "float-right">
                                    <p id='sentence' class='title float-right mr-2'> <?php echo $row['title']; ?></p>
                                    <br>
                                    <p id='sentence' class='text-cut float-right mr-2'> <?php echo $row['des']; ?></p>
                                    <br><br>

                                    <?php
                                    $reversed_date = date('d-m-Y',strtotime($row["expired"]));
                                    ?>
                                    <p id='sentence' class='float-right mr-2'> תוקף המזון <?php echo $reversed_date; ?></p>
                                </div> 

                                <div>
                                    <p id='sentence' class='ml-2 published-text float-left'> פורסם לפני <?php echo $diff_date ?> ימים</p>
                                </div>

                            </artical>
                            </div>

                            
                        <?php
                        }
                        }
                        }
                        }
                    }
                    
                        ?>  
    </div>
    </div>
    </div>
    </section>
</main>


<script src="../assets/js/messages-disappear.js"></script>

    <footer>
        <?php
            include('../includes/footer.php');
        ?>
    </footer>

</body>
</html>