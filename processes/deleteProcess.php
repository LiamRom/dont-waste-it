<?php
 include('../config/db.php');
 
    // Deleting a donation from the database

$delNot = "DELETE FROM `notification` WHERE `donation_id`='" . $_GET["id"] . "'";
$delGet = "DELETE FROM `getDonation` WHERE `donation_id`='" . $_GET["id"] . "'";
$delDon = "DELETE FROM donations WHERE id='" . $_GET["id"] . "'";
mysqli_query($connection, $delNot);
mysqli_query($connection, $delGet);
if (mysqli_query($connection, $delDon)) {
    header('Location:../pages/myDonations.php?success=donationDelete');
} 

else {
    header('Location:../pages/myDonations.php?error=deleteionFailed');
}

?>