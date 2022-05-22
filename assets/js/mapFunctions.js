var places=[];
var markers=[];


function initMap() 
{
    // Set the center point of the map:
    const myLatLng = { lat: 32.149960, lng: 34.883881 };
    // Set image for marker:
    const image ="../assets/images/donate.png";


    // Create map object:
    const map = new google.maps.Map(document.getElementById("googleMap"), {
        zoom: 11,
        center: myLatLng
    });

        // Create marker for each donation according the parameters that saved in places matrix:

        for (let place = 0; place < places.length; place++) 
        {

           
            var latitude= parseFloat(places[place][0]);
            var lnogitude= parseFloat(places[place][1]);
            var title= places[place][2];
            var id= places[place][3];
            
            var urlStart='ask_donation.php?id=';
            var urlFull=urlStart+id;



            marker= new google.maps.Marker({
            position: { lat: latitude, lng: lnogitude },
            map,
            animation: google.maps.Animation.DROP,
            title: title,
            icon: image,
            url:urlFull,
            });

            // Push each matker into markers array:
            markers.push(marker);

            // When the user move over a marker it will jump:
            markers[place].addListener("mouseover", toggleBounce);
            
            // When the user click on a marker it will jump and the user will be moved to another page that show the relevant donation:

            markers[place].addListener("click", function(){markers[place].setAnimation(google.maps.Animation.BOUNCE);
            window.location.href=markers[place].url;});



    }


}

// the function cause the marker to start jump or stop jump:
function toggleBounce()
{
if (this.getAnimation() !== null) {
    this.setAnimation(null);
} else {
    this.setAnimation(google.maps.Animation.BOUNCE);

}
}
