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
    $current = $_GET["id"];
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