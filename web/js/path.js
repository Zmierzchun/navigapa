/**
 * Created by mkochmanski on 18/05/16.
 */

// This example creates an interactive map which constructs a polyline based on
// user clicks. Note that the polyline only appears once its path property
// contains two LatLng coordinates.

    var poly;
    var path;
    var map;
    var marker;
    var latlon;


function getTrackData($trackID) {
    initMap();

    xhr.open('GET', 'getTrackData', false);
    xhr.send(null);

        console.log('response coming...');
        if (xhr.status === 200){
            console.log('got response');


            poly = new google.maps.Polyline({
                strokeColor: '#000000',
                strokeOpacity: 1.0,
                strokeWeight: 3
            });
            console.log('polygon set-up');

            var responseObject = JSON.parse(xhr.responseText);
            path = poly.getPath();
            map.panTo(new google.maps.LatLng(responseObject[1].lat,  responseObject[1].lon));
            for (var i = 1; i < responseObject.length; i++){
                path.push(new google.maps.LatLng(responseObject[i].lat,  responseObject[i].lon));
            }


            poly.setMap(map);

        }
    else{
            console.log('response missed');
        }
}



    function initMap() {
        mapholder = document.getElementById('mapholder');
        mapholder.style.height = '500px';
        mapholder.style.width = '100%';
        latlon = new google.maps.LatLng("50.061695","19.937941");

        var myOptions = {
         //   center:latlon,
            zoom:15,
            mapTypeId:google.maps.MapTypeId.ROADMAP,
            mapTypeControl:true,
            navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
        };

        map = new google.maps.Map(mapholder,myOptions);

        marker = new google.maps.Marker({position:latlon,map:map,title:"You are here!"});
        marker.setMap(map);


        poly = new google.maps.Polyline({
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });
        path = poly.getPath();
        poly.setMap(map);

        // Add a listener for the click event
       // map.addListener('center_changed', addLatLng);
    }