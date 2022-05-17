<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,500;1,200&family=Sarabun:wght@200;400&family=Thasadith:ital@0;1&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        

#cont{
  position: relative;

}
.son{
  position: absolute;
  top:0;
  left:0;

}




#control{
  position:absolute;

  left:0;

  z-index: 50;
  background: HoneyDew ;
  opacity:0.7;
  color:#fff;
  text-align: center;

}
#snap{
  background-color: dimgray ;

}
#retake{
  background-color: coral ;

}

#close{
  background-color: lightcoral ;

}
.hov{
  opacity:.8;
  transition: all .5s;
}
.hov:hover{
  opacity:1;

  font-weight: bolder;
}
/*#canvas{
  z-index: 1;
}
#video{
  z-index: 3;
}*/

        </style>
</head>
<body>
    <div class="container-fluid" id='camcam'>
        <a class='btn btn-block btn-primary text-white' id='open'> Open cam</a>
        <div class="row">
          <div class="col-md- offset-1">




            <div id="wrap">

            <div id='cont'>

              <div id="vid" class='son' >
            <video id='video'></video>
              </div>

              <div id="capture" class='son'>
            <canvas id='canvas'></canvas>
            <canvas id='blank' style='display:none;'></canvas>
              </div>

              <div id="control">
                <div class="container">
                <div class="row">
                  <div class="col-md-4"><a id='retake' class='btn btn-block m-1 hov'><i class="fas fa-sync-alt"></i></a></div>
                  <div class="col-md-4"><a id='snap' class='btn btn-block m-1 hov'><i class="fas fa-camera"></i></a></div>
                  <div class="col-md-4"><a id='close' class='btn btn-block m-1 hov'><i class="fas fa-times"></i></a></div>

                </div>
                  </div>



              </div>

            </div>

            </div>









          </div>
        </div>
      </div>
      <script>

$(document).ready(function() {
  $('#control').hide();
  $('#video').resize(function(){
    $('#cont').height($('#video').height());
      $('#cont').width($('#video').width());
      $('#control').height($('#video').height()*0.1);
      $('#control').css('top',$('#video').height()*0.9 );
        $('#control').width($('#video').width());
        $('#control').show();
});
function opencam(){
  navigator.getUserMedia= navigator.getUserMedia ||   navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.oGetUserMedia || navigator.msGetUserMedia ;
  if(navigator.getUserMedia)
  {
    navigator.getUserMedia({video:true },  streamWebCam ,throwError) ;


  }







}

function closecam(){

  video.pause();

  try {
    video.srcObject = null;
  } catch (error) {
    video.src =null;
  }

  var track = strr.getTracks()[0];  // if only one media track
  // ...
  track.stop();

}
  var video= document.getElementById('video');
  var canvas= document.getElementById('canvas');
  var context= canvas.getContext('2d');
  var strr;
  function streamWebCam(stream){
  const  mediaSource = new MediaSource(stream);
  try {
      video.srcObject = stream;
    } catch (error) {
      video.src = URL.createObjectURL(mediaSource);
    }
    video.play();
    strr=stream;
  }
  function throwError(e){
    alert(e.name);
  }
$('#open').click(function(event) {
  opencam();
   $('#control').show();
});
$('#close').click(function(event) {
  closecam();
});
  $('#snap').click(function(event) {
      canvas.width=video.clientWidth;
      canvas.height=video.clientHeight;
      context.drawImage(video,0,0);
      $('#vid').css('z-index','20');
      $('#capture').css('z-index','30');
  });
$('#retake').click(function(event) {
$('#vid').css('z-index','30');
$('#capture').css('z-index','20');
});
});
      </script>
</body>
</html>