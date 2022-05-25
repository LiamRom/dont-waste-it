
//    It adds a listener to the window object, which as soon as the load event is triggered
    //  (i.e. "the page has finished loading") executes the initialize function.


    google.maps.event.addDomListener(window, 'load', initialize);
    function initialize() {
        var options = {componentRestrictions: {country: "il"}}; //The user could select only address in israel.
        var input = document.getElementById('current_address');
        var autocomplete = new google.maps.places.Autocomplete(input, options); // Create an object of autocomplete.
        // autocomplete.addListener('place_changed', function () {
        // var place = autocomplete.getPlace();
      

 
        // });
    }


        // The funtion calculate the distance and drive duration for each donation according to the current address of the user.
        // If the function gets in "toSort" parameter true, it also reorders the donations by distance.

        function calculateDistanceTime(toSort) 
        {

            if(!isEmptyAddress ())
            {

                var source, destination;
                var isCalculateOk=true;


                // Get the source and  the destination of each donation:
                source = document.getElementById("current_address").value;
                records_collection = document.getElementsByClassName("destination");
                records_size = records_collection.length;
                
                // create an array of all the destinations:
                destinations = [];

                for (destinations_index = 0; destinations_index < records_size; destinations_index++) 
                {
                    destinations[destinations_index] = records_collection[destinations_index].innerHTML;                
                }


                // Use Distance Matrix Service of google in order to calculate the distance & time:


                var service = new google.maps.DistanceMatrixService();

                service.getDistanceMatrix({
                    origins: [source],
                    destinations: destinations,
                    travelMode: google.maps.TravelMode.DRIVING,
                    unitSystem: google.maps.UnitSystem.METRIC,
                    avoidHighways: false,
                    avoidTolls: false
                }, function (response, status) {
                    // Response is google object that consist data like distances and times.


                    console.log("response " , response);
                    console.log("status " , status);
                    if (status == google.maps.DistanceMatrixStatus.OK) {

                        //Set the dives where the distance and drive duration will appear after the calculation: 
                        
                        var dvDistance = document.getElementsByClassName("distance");
                        var dvTime = document.getElementsByClassName("time");
                        // html loop 
                        for (destinations_index = 0; destinations_index < records_size; destinations_index++) 
                        {
                            console.log("response:",response);


                            if(response.rows[0].elements[destinations_index].status=="OK")
                            {
                                // Get the distance in meters:
                                distance = response.rows[0].elements[destinations_index].distance.value;
                                //Convert to KM with one digit after the point.
                                kmDistance=(distance/1000).toFixed(1);
                                console.log("km:",kmDistance);


                                //Get the duration tome in seconds:
                                duration = response.rows[0].elements[destinations_index].duration.value;
                                // Connvert tp minutes:
                                minutesDuration= Math.round(duration/60);

                                // Insert the calculation of duration and distance to the appropriate place:
                              
                               
                                dvDistance[destinations_index].innerHTML = kmDistance +' km';
                                dvTime[destinations_index].innerHTML = "נסיעה של " + minutesDuration +" דקות ";   

                            }
                            else
                            {
                                isCalculateOk=false;
                                dvDistance[destinations_index].innerHTML="שגיאה בחישוב מרחק";
                                dvTime[destinations_index].innerHTML = "שגיאה בחישוב זמן";
                                
                            }
                
                        }
                        if(!isCalculateOk){
                            alert("הכתובת שהזנת לא תקינה");

                        }

                        // in case that the user want to calculate and also to sort by distances:
                        if(toSort==true)
                        {
                           //Get collection of the donation posts
                            
                            let posts=document.getElementsByClassName("post");
                            console.log(posts);

                            // Convert the collection to array:
                            posts_arr=[].slice.call(posts);

                            // sort the Array
                            posts_arr.sort(compareDistance);
                            

                            // add the divs back into their parent in order:
                            for (var c = 0, cl = posts_arr.length; c < cl; c++) {
                                posts_arr[c].parentNode.appendChild(posts_arr[c]);
                                console.log("post", posts_arr[c]);
                                console.log("index:", c);

                            
                            }


                        }

                    } 
                    

                    else {
                        alert("Unable to find the distance via road.");
                    }
                });    
                
                // return(true);
            }   

        }


        // compareDistance is help function to calculateDistanceTime(toSort) and help her to sort the donation order: 
        function compareDistance (a, b) {
                    var aSpan = a.getElementsByClassName("distance")[0],bSpan = b.getElementsByClassName("distance")[0];
                                
                    console.log(aSpan.innerHTML);

                if (aSpan && bSpan) {
            
                        strA=aSpan.innerHTML;
                        strB=bSpan.innerHTML;
                        console.log(strA,strB);

                        d1=(parseFloat(strA));
                        d2=(parseFloat(strB));
                        console.log("d1&d2:");
                        console.log(d1,d2);
                        console.log("return:",d1-d2);

                        return(d1-d2);



                
                } else {
                    console.log("Return 0");
                    return 0;
                }
        }


            


         function sortByPostTime() 
             {


                //  We do it by id instead the date because the id is autoincrement

             

                //  Get collection of the donation posts
                let posts=document.getElementsByClassName("post");
                    console.log(posts);

                    // Convert the collection to array:
                    posts_arr=[].slice.call(posts);
                    console.log("arr befor sorting: ",posts_arr);

                    // sort the Array
                
                        posts_arr.sort(compareDays);
                        // Reverse the order of the array in order to display the post from the bigest id (the newest post)
                         posts_arr.reverse();
                        


                    // // add the divs back into their parent in order
                  
                    for (var c = 0, cl = posts_arr.length; c < cl; c++) {
                        posts_arr[c].parentNode.appendChild(posts_arr[c]);
                        console.log("post", posts_arr[c]);
                        console.log("index:", c);

                    }
                    console.log("arr after sorting: ",posts_arr);

            }



            //  compareDays (a, b) is help function to sortByPostTime() and it helps to sort the donation by post time: 
            function compareDays (a, b) {
            var aSpan = a.getElementsByClassName("donationNum")[0],bSpan = b.getElementsByClassName("donationNum")[0];
                
        
                console.log(aSpan.innerHTML);
                console.log("parsInt:");
                console.log(parseInt(aSpan.innerHTML, 10));



            if (aSpan && bSpan) {
                
                    d1=aSpan.innerHTML;
                    d2=bSpan.innerHTML;
                    console.log(d1,d2);
                    return(d1-d2);


            } else {
                
                return 0;
            }
            }

        // isEmptyAddress() checks if the user insert input or not. if yes it returns false, else true.
            function isEmptyAddress () {
                addressInput=document.getElementById("current_address").value;
                if(addressInput=="")
                {
                    alert("אופס, לא הזנת כתובת");
                    return(true);
                }
                else{
                    return(false);
                }

            }






            //Get the button:
            upbutton = document.getElementById("upBtn");

            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {scrollFunction()};

            function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                upbutton.style.display = "block";
            } else {
                upbutton.style.display = "none";
            }
            }

            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
            }



