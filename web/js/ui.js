

jQuery.fn.rotate = function(degrees) {
    $(this).css({'-webkit-transform' : 'rotate('+ degrees +'deg)',
                 '-moz-transform' : 'rotate('+ degrees +'deg)',
                 '-ms-transform' : 'rotate('+ degrees +'deg)',
                 'transform' : 'rotate('+ degrees +'deg)'});
    return $(this);
};

function updateSpeed(spd){
  if($.isNumeric(spd)){
    speed = Math.round(spd*speedFactor);
  }
  else{
    speed = '---';
  }

    $('#speed').html(speed);
  if(speed <= speedYellowLimit){
    $('#speed').removeClass().addClass('bg-default');
  }
  if(speed > speedYellowLimit && speed < speedRedLimit){
    $('#speed').removeClass().addClass('bg-warning');
  }
  if(speed >= speedRedLimit){
    $('#speed').removeClass().addClass('bg-danger');
  }
}

function updateCompass(dir){
  dr = 'DIR';
  if($.isNumeric(dir)){
    dir = Math.round(dir);
    if(dir < 22.5) dr = 'N';
    if(dir > 22.5 && dir < 67.5) dr = 'NE';
    if(dir > 67.5 && dir < 112.5) dr = 'E';
    if(dir > 112.5 && dir < 157.5) dr = 'SE';
    if(dir > 157.5 && dir < 202.5) dr = 'S';
    if(dir > 202.5 && dir < 247.5) dr = 'SW';
    if(dir > 247.5 && dir < 292.5) dr = 'W';
    if(dir > 292.5 && dir < 337.5) dr = 'NW';
    if(dir > 337.5) dr = 'N';

    $('#arrow').rotate(dir+90);
  }
  $('#compassCtrl').html(dr);

}

function changeYellowSpeedLimit() {
  if(speedYellowLimit > 140) speedYellowLimit = 20;
  else{
    speedYellowLimit = speedYellowLimit+5;
    if(speedYellowLimit == speedRedLimit){
      changeRedSpeedLimit();
    }
  }
  $('#speedYellowLimit').text(speedYellowLimit);
}

function changeRedSpeedLimit() {
  if(speedRedLimit > 140) speedRedLimit = speedYellowLimit+5;
  else speedRedLimit = speedRedLimit+5;
  $('#speedRedLimit').text(speedRedLimit);
}

function toggleTrackGPS(){
    if($('#toggleTrackGPS').text() == 'WYŁĄCZONY'){
        recordTrack = true;
        $('#toggleTrackGPS').removeClass().addClass('btn btn-success').text('AKTYWNY');
    }
    else{
        recordTrack = false;
        $('#toggleTrackGPS').removeClass().addClass('btn btn-default').text('WYŁĄCZONY');
    }




}

function toggleUnits(){
  if($('#units').text() == 'metryczne'){
    $('#units').text('brytyjskie');
    $('#unitCtrl').text('mph');
    speedFactor = 2.237;
  }
  else {
    $('#units').text('metryczne');
    $('#unitCtrl').text('km/h');
    speedFactor = 3.6;
  }
}
