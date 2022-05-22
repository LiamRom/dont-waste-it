<?php
    include("functions.php");
?>
<!DOCTYPE html>
<html lang="en">

    <head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
        <link href="../assets/css/generalStyle.css" rel="stylesheet" />
        <link href="../assets/css/header.css" rel="stylesheet" />
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
        

        <script src=
    "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
        </script>
        <script src=
    "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js">
        </script>
        <script src=
    "https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js">
        </script>
        
        

    </head>


    <body>



    <nav class="navbar navbar-expand-lg navbar-light bg-dark bg-secondary">
      <form class="form-inline my-2 my-lg-0">
        
      </form>
           
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
            
            <?php
                //Navbar that appears if the user is not logged in or he is a register

                if(!isset($_SESSION['email'])){
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/login.php">התחברות</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/register.php">הרשמה</a>
                </li>
                
                <?php


                }else{
                    //Navbar that appears if the user is logged in
                    ?>
                    
                     <li class="nav-item dropdown" dir="rtl">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                        $userNum =  $_SESSION['userNum'];

                        $sql =  "SELECT * FROM users WHERE userNum = '$userNum'";


                        $gotResuslts = mysqli_query($connection,$sql);

                        if($gotResuslts){
                            if(mysqli_num_rows($gotResuslts)>0){
                                
                            while($row = mysqli_fetch_array($gotResuslts)){
                            ?>
                            היי, <?php echo $row['firstName']; ?>
                             <img class='picInNav mr-1' src='../assets/images/avatars/<?php echo $row['profilePic']; ?>'>

                            </a>
                            
                        <?php
                            }
                            }
                            }
                        ?>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../pages/userProfile.php">הצגת פרופיל</a>
                            <a class="dropdown-item" href="../pages/myRequests.php">הבקשות שלי</a>
                            <a class="dropdown-item" href="../pages/myDonations.php">התרומות שלי</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../processes/logoutProcess.php">התנתק/י</a>
                        </div>
                    </li>
                    

                <!-- User notification -->
                        <li class="nav-item dropdown">
            <a class="nav-link" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class='picInNavBell' src="../assets/images/header/bell.png" width="25" height="25">
                <?php
                $requestUser_id= $_SESSION['userNum'];

                $query = "SELECT * from `notification` where (read_status = 'unread' AND requestsUser_id='$requestUser_id') order by `date` DESC";
                if(count(fetchAll($query))>0){
                ?>
                <span class="badge" ><?php echo count(fetchAll($query)); ?></span>
              <?php
                }
                    ?>
              </a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
                <?php
                $currentUser = $_SESSION['userNum'];
                
                //Retrieving alerts by user number
                $query=" SELECT *
                        FROM notification
                        INNER JOIN users ON users.userNum = notification.requestsUser_id
                        INNER JOIN donations ON donations.id = notification.donation_id
                        where notification.requestsUser_id=$currentUser
                        order by `date` DESC";
                        
                //Displays alerts according to reading status
                 if(count(fetchAll($query))>0){
                     foreach(fetchAll($query) as $i){
                ?>
              <a style ="
                         <?php
                            if($i['read_status']=='unread'){
                                echo "font-weight:bold; font-size:14px";
                            }
                            if($i['read_status']=='read'){
                                echo "font-size:14px";
                            }
                         ?>
                         
                         

                         " class="dropdown-item" href="../pages/askDonation_showDonationDetails.php?type=<?php echo $i["type"];?>&id=<?php echo $i["id"];?>"
                <small><i><?php echo date('j F , Y, g:i a',strtotime($i['date'])) ?></i></small><br/>
                  <?php 
                //Alert view by type
                if($i['type']=='request'){
                     echo " קיבלת בקשה חדשה עבור-";
                     echo $i['title'];
                     
                     
                }if($i['type']=='approved'){
                    echo " אושרה בקשתך עבור-";
                    echo $i['title'];

                }
                  
                  ?>
                </a>
              <div class="dropdown-divider"></div>
                <?php
                     }
                 }else{
                     echo "עדיין אין לך התראות.";
                 }
                     ?>
            </div>
          </li>
                    <?php
                        }
                    ?>

                </ul>

        <ul class="navbar-nav reverse-order ml-auto">
        <li class="nav-item borderNav">
            <a class="nav-link " href="../pages/donationsMap.php">התרומות במפה</a>
          </li>
            <li class="nav-item borderNav">
            <a class="nav-link " href="../pages/Donationform.php">הוספת תרומה </a>
          </li>
          <li class="nav-item borderNav">
            <a class="nav-link " href="../pages/aboutUs.php">קצת עלינו</a>
          </li>
          <li class="nav-item borderNav">
            <a class="nav-link " href="../index.php">דף הבית</a>
          </li>
        </ul>
        </div>  
            

</nav>

       
        
      </div>


</body>
