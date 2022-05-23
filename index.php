<?php
    include('includes/header.php');
    include('config/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Don't Waste It</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link href="assets/css/generalStyle.css" rel="stylesheet" />
    <link href="assets/css/feedStyle.css" rel="stylesheet" />
    

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=myKey &libraries=places"></script>
    
    

</head>


<body>
    <header>
        <?php
            include('includes/navigation.php');
        ?>
    </header>
    
    
    
    <img onclick="topFunction()" id="upBtn" src="assets/images/up.png" alt="up">

    <div class="button_plus"  onclick="window.location.href='/pages/Donationform.php'"></div>


    <div align="center" id = 'disappear'>
       
    <?php
        if(isset($_GET['success'])){
            if($_GET['success'] == 'loggedOut'){
                ?>  
                    <hr>
                    <br>
                    <small class='alert alert-info'>ההתנתקות בוצעה בהצלחה </small>
                    <br>
                    <hr>
                <?php
            }else if($_GET['success'] == 'userCreated'){
                ?>
                    <hr>
                    <br>
                    <small class='alert alert-success'>ההרשמה בוצעה בהצלחה </small>
                    <br>
                    <hr>
                <?php
            }else if($_GET['success'] == 'loggedIn'){
                ?>
                    <hr>
                    <br>
                    <small class='alert alert-success'>ההתחברות בוצעה בהצלחה </small>
                    <br>
                    <hr>
                <?php
            }
        }
       ?>

       
    </div>

        <main>
            <h1 id="centerText">תרומות מזון לאיסוף</h1>

            
            <div class = "searchLine">
                <form onsubmit="return false;" action="">
                <div class="row input-group mb-3">
                    <div class="input-group-prepend">
                        <button  onclick="calculateDistanceTime(false)" class="button" type="submit">חישוב מרחק וזמן</button>
                    </div>
                    <input id="current_address" name="current_address" class="form-control" type="text" placeholder="הקלידו את המיקום שלכם">
                </div>
                </form>
            </div>
            
            <div class="text-center">
            <div class="sort-buttons">
                <button  onclick= "location.href='../pages/donationsMap.php'" class="btn btn-sort" id = "showOnMap"> הצגה על המפה<img src="../assets/images/map.png" class= "sortIcon"/> </button>
                <button onClick="calculateDistanceTime(true)" class="btn btn-sort" id = "sortByLocation">מיון לפי מרחק<img src="../assets/images/distance.png" class= "sortIcon "/> </button>
                <button onClick="sortByPostTime()" class="btn btn-sort" id = "sortByTime" autofocus>מיון לפי תאריך פרסום<img src="../assets/images/time.png" class= "sortIcon"/> </button>
            </div>
            </div>
            


            
            <div class="modal-win bottom">
            <div class="modal-content">
            
            <?php
            
            //fetch table rows from mysql db
            $sql = "SELECT * FROM donations INNER JOIN users ON users.userNum = donations.donor WHERE `donationStatus`=0 ORDER BY id DESC";
            $gotResuslts = mysqli_query($connection,$sql);


            if($gotResuslts){

        
                while($row = mysqli_fetch_array($gotResuslts)){
                    $date1 = date("Y-m-d"); //Get the date today.
                    $date2 = $row["publishDate"]; //Get the publish date of the dontaion.

                    $date1_ts = strtotime($date1);
                    $date2_ts = strtotime($date2);
                    $diff_date = round($date1_ts - $date2_ts)/86400;
                    // If passed more that 90 dayes from the post date so will see the follwing:
                    if($diff_date<90){
            ?>
            
            <div class="post " id = "postShow" onClick="location.href='../pages/ask_donation.php?id=<?php echo $row["id"];?>'">
                            
                            
                            <img class='pic float-right mr-2' src='../assets/uploads/<?php echo $row['image']; ?>'>

                            <div class='inPost float-right mr-2'>
                                
                                <p class='title rightText'> <?php echo $row['title']; ?></p>
                                
                                <p class='rightText'> <?php echo $row['des']; ?></p>
                                
                                <?php
                                $reversed_date = date('d-m-Y',strtotime($row["expired"]));
                                ?>
                                <p class='rightText'> בתוקף עד: <?php echo $reversed_date; ?></p> 

                                
                                <p class='rightText destination'> <?php echo $row['address']; ?></p>

                                <div class = "row distanceAndTime">
                                    <img  class='alignName iconInPost float-right ml-2 mr-3'  src='../assets/images/distance.png'>
                                    <p  class='rightText distance ml-2 '> מרחק</p>

                                    <img  class='alignName iconInPost float-right ml-2'  src='../assets/images/car.png'>
                                    <p  class='rightText time '>זמן</p> 
                                    
                                
                                </div>

                                <br>
                                <img  class='alignName picInFeed float-right ml-2'  src='../assets/images/avatars/<?php echo $row['profilePic']; ?>'>
                                <span class='alignName float-right ml-3 mt-2'><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?></span>
                                <p class='ml-1  float-left published-text donationNum'> <?php echo $row['id']; ?> </p>
                                
                                </div>

                                <div  class= 'inPost float-left mr-2'>

                                

                                <?php
                                
                                

                                if ($diff_date == 0){
                                    ?>
                                        <p class='ml-1 float-left published-text'> פורסם היום</p>
                                <?php
                                }else{
                                    ?>
                                    <p class='ml-1  float-left published-text'> פורסם לפני <?php echo $diff_date ?> ימים</p>
                                <?php
                                }
                                ?>

                                <br><br>
                                <a href="../pages/ask_donation.php?id=<?php echo $row["id"]; ?>"><input class='float-left btn btn-feed' type=button value='לפרטים נוספים'></a>
                                </div>

                                </div>

                <?php
                }
            }

            }
        ?>
        
        </div>
        </div>
    </main>    

    <script src="assets/js/feed.js"></script>

    <script src="assets/js/messages-disappear.js"></script>

     
     <footer>
        <?php
            include('includes/footer.php');
        ?>
    </footer>

  
</body>
</html>    
