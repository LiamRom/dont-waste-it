<?php
     include('../config/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/donationsMap.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=myKey&callback=initMap&v=weekly"
      defer></script>
    <script src="../assets/js/mapFunctions.js"> </script>


    <title>Donations Map</title>
</head>

<body>
    <header>
        <?php
            include('../includes/header.php');
            include('../includes/navigation.php');
        ?>
    </header>
    
<main>
    <h1>כל התרומות על המפה</h1>
    <p>עזרו להפוך את כדור הארץ למקום נחמד יותר ועזרו אחד לשני</p>

    <div id="googleMap" style="width:100%;height:400px;"></div>


    <?php



            //fetch table rows from mysql db
            $sql = "SELECT * FROM donations  WHERE `donationStatus`= 0";

            $gotResuslts = mysqli_query($connection,$sql);

            if($gotResuslts){

                while($row = mysqli_fetch_array($gotResuslts)){

                    $date1 = date("Y-m-d");
                    $date2 = $row["publishDate"];

                    $date1_ts = strtotime($date1);
                    $date2_ts = strtotime($date2);
                    $diff_date = round($date1_ts - $date2_ts)/86400;


                    $latitude=$row['lat'];
                    $longitude=$row['lng'];
                    $title=$row['title'];
                    $address=$row['address'];
                    $donationId=$row['id'];


    ?>

            

                            <script>
                                // get the lat$lng from php to js

                                var diffDate = "<?=$diff_date?>";
                                // If 90 days have not yet passed since the date of publication so it will show on the map:
                                if(diffDate<90)
                                {


                                    var latitude = '<?=$latitude?>';
                                    var longitude = '<?=$longitude?>';
                                    var donationTitle = '<?=$title?>';
                                    var donationId='<?=$donationId?>';
                                    var address = "<?=$address?>";                 
                                    console.log(donationTitle);

                                                            
                                    //create array for each donation that consist some parameters and push them to places array:

                                    places.push([latitude, longitude, donationTitle,donationId]);


                                }

                            </script>

                    

                <?php
                }
            }

        
        ?>

    <script>

        window.initMap = initMap;

    </script>
    
</main>    

    <footer>
        <?php
            include('../includes/footer.php');
        ?>
    </footer>

</body>
</html>
