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
    <link href="../assets/css/requests.css" rel="stylesheet" />
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
        <title>Don't waste it-Donation requests</title>

</head>
<body>
    <header>
        <?php
            include('../includes/header.php');
           include('../includes/navigation.php');
        ?>
    </header>
    
    

     
    <!--Displays to the user the requests he has for a specific donation from other users < -->

    <div class="modal-request">
        <p align = "center" > בחר/י משתמש שתרצה/י להעביר לו את התרומה שפרסמת.    
            <br> ניתן לבחור משתמש אחד.    
            <br> לאחר מכן תוכל/י לתאם את מועד האיסוף מול המשתמש.
        <p>
    </div>

    <?php
    $current_donation_id = $_GET["id"];
    
    $sql = "SELECT title FROM donations WHERE id = '$current_donation_id'";
    $gotResuslts = mysqli_query($connection,$sql);
    if($gotResuslts){
                            
        while($row = mysqli_fetch_array($gotResuslts)){
            ?>
    
        <div class="messages">
            <?php
                if(isset($_GET['error'])){
                    if($_GET['error'] == 'approveFailed'){
                        ?>
                            <small class="alert alert-danger">
                                לא ניתן לאשר את התרומה
                        </small>
                        <?php
                }
                }
            ?>
        </div>
        <main class="modal-request bottom">
            <div class="modal-content">
                <div class="modal-header">
                
                    <h4 class="modal-title">בקשות לתרומה- <?php echo $row['title']; ?></h4>
                </div>
                <?php
                       
        }
    }

?>


    <!--Check if the application has not yet been approved by the user. If approved, you will only see the user whose request was approved< -->
 <?php
        $sql =  "SELECT donationStatus FROM donations where id= '$current_donation_id'";
        $select = mysqli_query($connection,$sql);
        $row = mysqli_fetch_assoc($select);
        $donationStatus= $row['donationStatus'];

        if($donationStatus==0){
?>


                <section class="showPosts modal-body">
                    <div class="box">
                        <div class="content">

                            <?php
                            $sql =  "SELECT * FROM  
                            getDonation, users
                            WHERE  getDonation.requestsUser_id = users.userNum
                            AND getDonation.donation_id	 = '$current_donation_id'";
                           
                            $gotResuslts = mysqli_query($connection,$sql);

                            if($gotResuslts){

                                if(mysqli_num_rows($gotResuslts)<1){
    
                                    echo "<p align='center'> עדיין אין בקשות לתרומה </p>";

                                    ?>
                                    
                                   <img class="waiting-pic shadow" src="../assets/images/waiting.png"/>

                                   <?php
                                }

                                
                                else{
                            
                                while($row = mysqli_fetch_array($gotResuslts)){
                                    ?>
                                        <!--View all donation requests< -->

                                <div  className='container'>
                                    <artical class='col-lg-12 border float-left' id="post">

                                    <img class='float-right picInrequest mr-1' src='../assets/images/avatars/<?php echo $row['profilePic']; ?>'>
                                    <p id='sentence' class='title float-right mr-2'> <?php echo $row['firstName']; ?></p>
                                    <p id='sentence' class='title float-right mr-1'> <?php echo $row['lastName']; ?></p>
                                    <br>
                                    <p id='sentence' class='correspondence float-right mr-2'> <?php echo $row['correspondence']; ?></p>


                                    <a href="../processes/donationRequestProcess.php?user_id=<?php echo $row["userNum"];?>&donation_id=<?php echo $row["donation_id"]; ?>"><input class="btn btn-approve float-left" type=button value='אישור בקשה''></a>

                                    </artical>
                                </div>   
                      
                       <?php
                       
                                }
                            }
                    }
                    }else
                    {      
                    
                            $sql =  "SELECT * FROM  
                            getDonation, users
                            WHERE  getDonation.requestsUser_id = users.userNum
                            AND (getDonation.donation_id = '$current_donation_id' AND getDonation.requestStatus='אושר') ";
                            $select = mysqli_query($connection,$sql);
                            $row = mysqli_fetch_assoc($select);
                             ?>
                             
                             <div class="modal-request">
                                <p align = "center" >אישרת תרומה זו עבור המשתמש:    
                                <p>
                            </div>
                            
                            <div  className='container'>
                                    <artical class='col-lg-12 border float-left' id="post">

                                    <img class='float-right picInrequest mr-1' src='../assets/images/avatars/<?php echo $row['profilePic']; ?>'>
                                    <p id='sentence' class='title float-right mr-2'> <?php echo $row['firstName']; ?></p>
                                    <p id='sentence' class='title float-right mr-1'> <?php echo $row['lastName']; ?></p>
                                    <br>
                                    <p id='sentence' class='correspondence float-right mr-2'> <?php echo $row['correspondence']; ?></p>


                                    <a href="../pages/requestsContact.php?user_id=<?php echo $row["requestsUser_id"]; ?>"><input class="btn btn-approve float-left" type=button value='ליצירת קשר''></a>

                                    </artical>
                                </div>   
                                                   <?php

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