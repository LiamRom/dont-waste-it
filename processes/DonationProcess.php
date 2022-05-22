<?php
    include('../config/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="../assets/css/generalStyle.css" rel="stylesheet" />
    <link href="../assets/css/userProfile-askDonation-newDonation.css" rel="stylesheet" />
    <link href="../assets/css/requests.css" rel="stylesheet" />
    <title>Don't waste it-send request</title>    



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

    $title = mysqli_real_escape_string($connection,strip_tags($_POST['title']));
    $amount = mysqli_real_escape_string($connection,strip_tags($_POST['amount']));
    $source = mysqli_real_escape_string($connection,strip_tags($_POST['source']));
    $desc = mysqli_real_escape_string($connection,strip_tags($_POST['desc']));
    $expired = mysqli_real_escape_string($connection,strip_tags($_POST['expired']));
    $image = mysqli_real_escape_string($connection,strip_tags($_POST['image']));
    $address=mysqli_real_escape_string($connection,strip_tags($_POST['address']));
    $donationStatus=mysqli_real_escape_string($connection,strip_tags($_POST['donationStatus']));
    $latitude = mysqli_real_escape_string($connection,strip_tags($_POST['latitude']));

    $longitude = mysqli_real_escape_string($connection,strip_tags($_POST['longitude']));


    if(empty($_POST['title'])){
               header("Location:../pages/Donationform.php?error=emptytitle&amount=$amount&desc=$desc&expired=$expired");

        exit;
    }

    if(empty($_POST['amount'])){
        header("Location:../pages/Donationform.php?error=emptyamount&title=$title&desc=$desc&expired=$expired");
        exit;
    }

    if(empty($_POST['source'])){
        header("Location:../pages/Donationform.php?error=emptysource&title=$title&amount=$amount&desc=$desc&expired=$expired");
        exit;
    }

    if(empty($_POST['desc'])){
        header("Location:../pages/Donationform.php?error=emptydesc&title=$title&amount=$amount&expired=$expired");
        exit;
    }

    if(empty($_POST['expired'])){
        header("Location:../pages/Donationform.php?error=emptyexpired&title=$title&amount=$amount&desc=$desc&expired=$expired");
        exit;
    }
   

    if(empty($_POST['address'])){
        header("Location:../pages/Donationform.php?error=emptyadress&title=$title&amount=$amount&desc=$desc&expired=$expired");
        exit;
    }

    if(empty($_POST['latitude'])){
        header("Location:../pages/Donationform.php?error=emptylat&title=$title&amount=$amount&desc=$desc&expired=$expired");
        exit;
    }





    if(!empty($_POST['title']) && !empty($_POST['amount']) && !empty($_POST['source']) && !empty($_POST['expired'])&& !empty($_POST['address'])){
    

        $currentUser = $_SESSION['email'];
                            $sql = "SELECT * FROM users WHERE email ='$currentUser'";
    
                            $gotResuslts = mysqli_query($connection,$sql);
    
                            if($gotResuslts){
                                if(mysqli_num_rows($gotResuslts)>0){
                                    while($row = mysqli_fetch_array($gotResuslts)){
                                        $userId=$row['userNum'];
                                    }
                                }
                            }
                            
        $userNum  =    $userId;
    
    
        $imgname=$_FILES['image']['name'];


         if(!$imgname)
        {
            // echo "no Image ";
            $newname= "noImage.png";
            $filename=$_FILES['image']['tmp_name'];
            
            

        } 
        else{
            $extension = pathinfo($imgname,PATHINFO_EXTENSION);
        
            $randomno=rand(0,100000);
            $rename='Upload'.date('Ymd').$randomno;
        
            $newname=$rename.'.'.$extension;
        
            $filename=$_FILES['image']['tmp_name'];
        }
        
 
        if(move_uploaded_file($filename, '../assets/uploads/'.$newname))
    	{
    // 		echo "uploaded";
    	}
    	else
    	{
    // 		echo "not uploaded";
    	}


        $insert_sql ="insert into donations (donor,title, amount, source, des, image, expired, lat, lng, donationStatus,address, publishDate) VALUES(
            '" . $userId . "',
            '" . $title . "',
            '" . $amount . "',
            '" . $source . "',
            '" . $desc . "',
            '" .$newname ."',
            '" . $expired . "',
            '" . $latitude . "',
            '" . $longitude . "',
            '" . $donationStatus . "',
            '" . $address . "',
            now()
        )";

    
       
        $inserted = mysqli_query($connection,$insert_sql);
        if($inserted){
            {
                    ?>
                                    
                <div class="modal-approved bottom">
                <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">התרומה הועלתה בהצלחה!</h4>
                </div>
                <div class="myDonations modal-body">
                <div class="box">
                <div class="content">
                    <p align="center">משהו מהלב...</p>
                    <p align="center">תודה רבה שאתם עוזרים לאחרים ודואגים שאוכל לא ייזרק לפח :)</p>
                    <img class="thankYou-Pic" src="../assets/images/thanks.png" alt="thank you">
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
