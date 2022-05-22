
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
    <title>Don't waste it-add donation</title>


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyCf_vrih334Gurzu0HpWI0RzrOIBhZ3_2k&libraries=places"></script>


<script>
    google.maps.event.addDomListener(window, 'load', initialize);
    function initialize() {
        var options = {
        componentRestrictions: {country: "il"}};
    var input = document.getElementById('address');
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.addListener('place_changed', function () {
    var place = autocomplete.getPlace();




      document.getElementById("latitude").value = place.geometry['location'].lat();
      document.getElementById("longitude").value = place.geometry['location'].lng();

    // //   if the lat is not a number' the meaning is the address is invalid if the user insert an address.
    //   if((document.getElementById("latitude").value!="") && (document.getElementById("address").value!=""))
    //   {
    //         alert("Invalid address");
    //         console.log("Invalid address");


    //   }


    
    
    });
    }

    
    

</script>




</head>


<body>
        <header>
        <?php
            include('../includes/header.php');
            include('../includes/navigation.php');
        ?>
    </header>
    

    

        <!--New donation publication form < -->

            <main class="modal-win bottom">
            <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">פרסום תרומה חדשה</h4>
                    </div>
                    <div class="modal-body">
                    <div class="messages">
                    <?php
                    //User alerts
                        if(isset($_GET['error'])){

                            if($_GET['error'] == 'emptytitle'){
                                ?>
                                    <small class="alert alert-danger">
                                        נא להזין שם תרומה
                                    </small>
                                <?php
                            }else if($_GET['error'] == 'emptyamount'){
                                ?>
                                    <small class="alert alert-danger">
                                       נא להזין כמות
                                    </small>
                                <?php
                            }else if($_GET['error'] == 'emptysource'){
                                ?>
                                    <small class="alert alert-danger">
                                       נא להזין מקור מזון
                                    </small>
                                <?php
                            }else if($_GET['error'] == 'emptydesc'){
                            ?>
                                <small class="alert alert-danger">
                                   נא להזין תיאור
                                </small>
                            <?php
                            }else if($_GET['error'] == 'emptyadress'){
                                ?>
                                    <small class="alert alert-danger">
                                        נא להזין כתובת 
                                    </small>
                                <?php
                            }
                            else if($_GET['error'] == 'emptylat'){
                                ?>
                                    <small class="alert alert-danger">
                                       נא להזין כתובת תקינה 
                                    </small>
                                <?php
                            }
                            else if($_GET['error'] == 'emptyexpired'){
                                ?>
                                    <small class="alert alert-danger">
                                        נא למלא תאריך 
                                    </small>
                                <?php
                            
                            }
                        }
                    ?>
  
                </div>
    
                        <div class="box">
                            <div class="content">
                                
                                <form class="myForm" action="../processes/DonationProcess.php" method="POST" enctype="multipart/form-data" dir='rtl' ">
                
                            <div class="row">
                            <?php
                                if(isset($_GET['title'])){
                                    $title = $_GET['title'];
                                    echo '<input type="text" id="title" name="title" class="form-control form-big" placeholder="שם תרומה" value= "'.$title.'">';
                                }
                                else{
                                    echo '<input type="text" class="form-control form-big" id="title" name="title" placeholder="שם תרומה" >';
                                }
                            ?>
                            </div>
                            <hr>

                            <div class="row">
                            <?php
                                if(isset($_GET['amount'])){
                                    $amount = $_GET['amount'];
                                    echo '<input type="text" class="form-control form-big" id="amount" name="amount" placeholder="כמות" value="'.$amount.'">';
                                }
                                else{
                                    echo ' <input type="text" class="form-control form-big" id="amount" name="amount" placeholder="כמות">';
                                }
                            ?>
                            </div>
                            <hr>

                        <div class="row">
                            <select class="form-control form-big" name="source" id="source" >
                               <option value="">מקור המזון</option>
                                <option value="ביתי" id= "ביתי"> ביתי </option>
                                <option value="מסעדה" id= "מסעדה"> מסעדה </option>
                                <option value="אולם אירועים" id= "אולם אירועים"> אולם אירועים </option>
                                <option value="גן ילדים/ בית ספר" id= "גן ילדים/ בית ספר"> גן ילדים/בית ספר </option>
                                <option value="אחר" id= "אחר"> אחר </option>


                            </select>
                            </div>
                        <hr>

                        <div class="row">
                        <?php
                            if(isset($_GET['desc'])){
                                $desc = $_GET['desc'];
                                echo '<input class="form-control form-big" name="desc" id="desc"  maxlength="60" placeholder="תיאור תרומה" value="'.$desc.'">';
                            }
                            else{
                                echo '<input class="form-control form-big" name="desc" id="desc"  maxlength="60" placeholder="תיאור תרומה">';
                            }
                            ?>
                        </div>
                        <hr>

                        <div class="row form-inline">
                        <?php
                            if(isset($_GET['expired'])){
                                $expired = $_GET['expired'];
                                echo '<label for="expired"> תוקף המזון: </label>
                                <input type="date" class="spacing"  id="expired" name="expired" value='.$expired.'>';
                            }
                            else{
                                echo '<label  for="expired">תוקף המזון: </label>
                                <input  type="date" class="spacing"  id="expired" name="expired">';
                            }
                        ?>
                            <label class="spacing" for="image">הוסף תמונה: </label>
                            <input type="file" class="spacing" id="image" name="image" accept="image/png, image/gif, image/jpeg"">
                            
                            
                        </div>
                        <hr>
                   

                        <!-- <div class="row form-inline">
                        <h7>כתובת לאיסוף התרומה:</h7>

                            <input class="form-control spacing" type="text" id="city" name="city" placeholder="עיר" >
                            <input class="form-control spacing" type="text" id="street" name="street" placeholder="רחוב">
                            <input class="form-control spacing" type="number" id="number" name="number" placeholder="מספר">
                        </div>
                        <hr> -->

                         <input type="hidden" id="donationStatus" name="donationStatus" value="0">

                        <!-- ****** -->


                        <!-- <div class="row form-inline">
                        <h7>הקלד את כתובת התרומה:</h7> -->
                        
                        <!--Automatic completion of address for collection - use of Google's api< -->
                        
                        <div class="row">
                            <input id="address" name="address" class="form-control form-big"type="text" placeholder="הקלד/י כתובת איסוף">
                        </div>
                        
                        
                        <br>

                    <!--Hidden from the user - its purpose is to extract longitude and latitude to find a contribution on the donation map< -->

                        <div class = "hideDistanceDisplay">
                    <p>Latitude:
                        <input type="text" id="latitude" name="latitude" readonly />
                    </p>
                    <p>Longitude:
                        <input type="text" id="longitude" name="longitude" readonly />
                    </p>
                </div>
                        

                        
            <!--Allows the user to post a donation only if the user is logged in. If you do not ask him to enter / register< -->
            
                        <?php
            if(isset($_SESSION['email'])){
                                ?>

            <input type="submit" name="submit"  class="btn btn-info" value="פרסום תרומה">

                    <?php
            }else{
                ?>
                <a href="login.php ">
                <input name="login" class="btn btn-info" value="התחבר/י כדי לפרסם">
                </a>

                <center>
                <a href="register.php">עדיין לא נרשמת? ליצירת חשבון </a>
                </center>
               <?php
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

