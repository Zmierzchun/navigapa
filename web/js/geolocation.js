var watchId;
var geoData = new Object;
var geoOptions = {
  enableHighAccuracy: true,
  timeout: 1500,
  maximumAge: 0
};

var geoDataCollectorURL = './getPositionData';

function getPositionData(){
  if (navigator.geolocation){
    watchId = navigator.geolocation.watchPosition(showPosition, showError, geoOptions);
  }
  else {
    $('#error').text('Geolokacja nie jest wspierana przez Twoją przeglądarkę :(');
  }
}

function showPosition(position){

  geoData.lat = position.coords.latitude;
  geoData.lon = position.coords.longitude;
  geoData.acc = position.coords.accuracy;
  geoData.alt = position.coords.altitude;
  geoData.altAcc = position.coords.altitudeAccuracy;
  geoData.spd = position.coords.speed;
  geoData.dir = position.coords.heading;
  geoData.tim = position.timestamp;

  var date = new Date(geoData.tim);

  //external functions

  updateSpeed(geoData.spd);
  updateCompass(geoData.dir);

  if(verbose == true){
    $('#console').html('<table class="table table-responsive">')
        .append('<tr><td>Latitude</td><td>' + position.coords.latitude + '</td></tr>')
        .append('<tr><td>Longitude</td><td>' + position.coords.longitude + '</td></tr>')
        .append('<tr><td>Accuracy</td><td>' + position.coords.accuracy + '</td></tr>')
        .append('<tr><td>Altitude</td><td>' + position.coords.altitude + '</td></tr>')
        .append('<tr><td>AltAccur</td><td>' + position.coords.altitudeAccuracy + '</td></tr>')
        .append('<tr><td>Heading</td><td>' + position.coords.heading + '</td></tr>')
        .append('<tr><td>Speed</td><td>' + position.coords.speed + '</td></tr>')
        .append('<tr><td>Timestamp</td><td>' + date.toString() + '</td></tr>')
        .append('</table>');
  }


  if(geoData.speed >= 3 && recordTrack == true){
    var serializedData = JSON.stringify(geoData);
    $.ajax({
      type: "POST",
      url: geoDataCollectorURL,
      data: serializedData,
      success: showSuccess('Przekazywanie danych...'),
      error: showWarning('Brak połączenia z serwerem!'),
      dataType: 'json'
    });
  }
  else {
    showWarning('Zapisywanie ścieżki wyłączone.');
  }
}

function showSuccess(msg){
    $('#prompt').removeClass().show().addClass('alert-success').html(msg + ' [  OK  ]');
}

function showWarning(msg){
    $('#prompt').removeClass().show().addClass('alert-warning').html(msg);
}

function showError(error) {
  $('#prompt').removeClass().show();
    switch(error.code) {
        case error.PERMISSION_DENIED:
            $('#prompt').html("User denied the request for Geolocation.").addClass('alert-danger');
            break;
        case error.POSITION_UNAVAILABLE:
            $('#prompt').html("Location information is unavailable.").addClass('alert-danger');
            break;
        case error.TIMEOUT:
            $('#prompt').html("The request to get user location timed out.").addClass('alert-danger');
            break;
        case error.UNKNOWN_ERROR:
            $('#prompt').html("An unknown error occurred.").addClass('alert-danger');
            break;
    }
}
