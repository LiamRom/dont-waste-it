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
    <title>Don't waste it-Ask donation</title>
    
</head>
<body>
    <header>
        <?php
         include('../includes/header.php');
            include('../includes/navigation.php');
        ?>
    </header>
    

    
    
<!--Displays the donation details to users and allows them to request it if they wish for < -->
    
    <?php
    $current = $_GET["id"];
    ?>
        
                <main class="modal-win bottom">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">פרטי התרומה</h4>
                    </div>
                    <div class="modal-body">

                <form name="ask_do" action="../processes/ask_donationProcess.php"
                      method="POST"
                      enctype="multipart/form-data"
                     >
                     <section class="row">
                             <div class="col-lg-8">
                               <div class=" mt-10">
                                   <?php
                                    
                        $sql = "SELECT * FROM donations                         
                        INNER JOIN users ON users.userNum = donations.donor
                        WHERE id=$current";
                        
                        $gotResuslts = mysqli_query($connection,$sql);
                        
                        if($gotResuslts){
                            
                                while($row = mysqli_fetch_array($gotResuslts)){
                                    ?>
                                   <div class="row">
                                       <div>
                                           <h8 class="mb-0">שם התרומה:</h8>
                                       </div>
                                       <div class="user-info">
                                            <?php echo $row['title']; ?>
                                       </div>
                                   </div>
                                    
                                   <hr>
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
                                   
                                 </div>
                             </div>
                             <div class="col-lg-4">
                               <img class="picShowDonation shadow float-left" src='../assets/uploads/<?php echo $row['image']; ?>' />
                             </div>
                         </section>
                          
                           
            <!--Displays a Continue button to the user according to their status for donation < -->
                     
                       <?php
            if(isset($_SESSION['email'])){
                    $user=$_SESSION['userNum'];
                    //בדיקה אם המבקש הוא לא התורם
                if($user!=$row['donor']){
                    $donation=$row['id'];
                    $find = "SELECT * FROM getDonation WHERE donation_id='$donation' AND requestsUser_id='$user'";
                    $Resuslts = mysqli_query($connection,$find);
                    //בדיקה אם לא ביקשתי את הבקשה
                    if(mysqli_num_rows($Resuslts)<1){
                           ?>  
                           <?php
                           ?>
                           
                           <section class="row">
                                       <div>
                                           <h8 class="mb-0">הוספת מסר למפרסם התרומה:</h8>
                                       </div>
                                       <textarea style="max-width:100%;width:100%;height:10vh" max-length=50 id="correspondence" name="correspondence" value="correspondence"></textarea>

                                     <textarea style="max-width:100%;width:100%;height:20vh" readonly>
אישור מסמך זה מהווה את התחייבותי לתנאים הבאים:
1. בתחום התנהלות תוך כדי בקשה או איסוף פריטים
•	לא אבצע גרימת נזק לרכוש התורם כאשר אגיע לאסוף את הפריט.
•	אינני מטריד את התורם ומבקש פרטי מזון שאין בכוונתי לקחת.
•	לא אבצע ניסיון לאסוף פריט מהתורם אחר לפרק הזמן המוסכם בשיחת התיאום או הגעה לאיסוף פריטים ללא הסכמה מראש.
•	לא אבצע שליחת אדם אחר לאסוף ללא רשות.
•	מתחייב לכבד את החלטתו של התורם למסור את הפריט למשתמש אחר שהוא אינו אני.

2. בתחום מדיניות הוצאה וספאם
•	אני מתחייב כי זו היא זהותי האמיתית.
•	אני מתחייב כי איני פועל במספר חשבונות במקביל ושולח הודעות שווא לתורם.
•	אין בכוונתי לשלוח דואר ספאם או תוכן פרסומי לתורם זה.

3. בתחום הפרטיות
•	אני מתחייב כי לאחר לקיחת התרומה במידה ותאושר לא אטריד את התורם ואחשוף את פרטיו למשתמשים אחרים.

4. בתחום המזון
•	אין בכוונתי לתבוע את התורם או מנהלי האתר בנזק שנגרם בעקבות לקיחת המזון.
                                    </textarea>
                                    <div>
                                       <input type="checkbox" id="agree" name="agree" value="agree" required>
                                       <label class="mb-0" for="vehicle1"> קראתי ואני מסכימ/ה</label><br>
                                   </div>
                        </section>
                                   
                           <center>
                           <input type="hidden" name="donationID" value=<?php echo $row['id']; ?>>
                               <input type="submit" name="submit"  class="btn btn-info" value="בקשת תרומה">
                             </center>
                           <?php
                   } else{
                       ?><center>
                           <br>
                        <div type="button" class="context-menu">כבר ביקשת תרומה זו</div>
                         </center>
                               <?php
                   }   
                }else{
                     ?>  
                     <center>
                         <br>
                        <h8 class="mb-0">זוהי התרומה שלך</h8>
                    </center>
                    <?php

                }
            }else{
                ?>
                <br>
                 <a href="login.php ">
                <input name="login" class="btn btn-info" value="התחבר/י כדי לבקש תרומה">
                </a>
                <center>
                <a href="register.php">עדיין לא נרשמת? ליצירת חשבון </a>
                </center>
               <?php
            }
               
                   ?>
                       
                   </div>
               <?php
           
       }
     
    }


                    ?>
                </form>
                         </div>        
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