<?php
session_start();
// Borramos toda la sesion
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>SISEAC V 0.1</title>
<link href="css/zice.style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.cycle.all.js"></script>
<script type="text/javascript" src="components/form/form.js"></script>
<script type="text/javascript">
          jQuery(function($){
			 $('#tv-wrap').jrumble({ x: 4,y: 0,rotation: 0 });	
			$('#tv-wrap').trigger('startRumble');		  
              $('.slides').addClass('active').cycle({
                  fx:     'none',
                  speed:   1,
                  timeout: 70
              }).cycle("resume");	
          });
</script>
<style type="text/css">
html {
	background-image: none;
}
#versionBar {
	position: fixed;
	width: 100%;
	height: 35px;
	bottom: 0;
	left: 0;
	text-align: center;
	line-height: 35px;
	background-image: url(images/top_bgrepeat.png);
}
.copyright{
	text-align:center; font-size:10px; color:#CCC;
}
.copyright a{
	color: #C9651C;
	text-decoration: none
}    
</style>
</head>
<body class="error">
<div class="errorpage">
<div id="tv-wrap"><img src="images/tv.png" width="300" height="273" id="tv"/>
  <div class="slideshow-block"> <a href="index.php" class="link"></a>
    <ul class="slides">
      <li><img src="exampic/d01.png"/></li>
	  <li><img src="exampic/d02.png"/></li>
	  <li><img src="exampic/d03.png"/></li>
	  <li><img src="exampic/d04.png"/></li>
	  <li><img src="exampic/d05.png"/></li>
	  <li><img src="exampic/d06.png"/></li>
	  <li><img src="exampic/d07.png"/></li>
	  <li><img src="exampic/d08.png"/></li>
	  <li><img src="exampic/d09.png"/></li>
	  <li><img src="exampic/d10.png"/></li>
      <li><img src="exampic/d11.png"/></li>
	  <li><img src="exampic/d12.png"/></li>
      <li><img src="exampic/d13.png"/></li>
	  <li><img src="exampic/d14.png"/></li>
	  <li><img src="exampic/d15.png"/></li>
	  <li><img src="exampic/d16.png"/></li>
	  <li><img src="exampic/d17.png"/></li>
	  <li><img src="exampic/d18.png"/></li>
	  <li><img src="exampic/d19.png"/></li>
	  <li><img src="exampic/d20.png"/></li>
	  <li><img src="exampic/d21.png"/></li>
    </ul>
  </div>
</div>
<div id="text">
  <h1> Hasta pronto</h1>
  <h2> Recuerda que la disciplina es el puente entre lo que soñamos y tenemos</h2>
  
</div>

</div>
<div class="clear"></div>
   <div id="versionBar" >
          <div class="copyright" >  &copy; Copyright 2013  All Rights Reserved <span class="tip"><a  href="http://www.uttlaxcala.edu.mx/" title="UTT" >Universidad Tecnológica de Tlaxcala</a> </span> </div>
        
          <!-- // copyright-->
        </div>
<script type="text/javascript">
var text = document.getElementById('text'),
	body = document.body,
	steps = 7;
function threedee (e) {
	var x = Math.round(steps / (window.innerWidth / 2) * (window.innerWidth / 2 - e.clientX)),
		y = Math.round(steps / (window.innerHeight / 2) * (window.innerHeight / 2 - e.clientY)),
		shadow = '',
		color = 190,
		radius = 3,
		i;	
	for (i=0; i<steps; i++) {
		tx = Math.round(x / steps * i);
		ty = Math.round(y / steps * i);
		if (tx || ty) {
			color -= 3 * i;
			shadow += tx + 'px ' + ty + 'px 0 rgb(' + color + ', ' + color + ', ' + color + '), ';
		}
	}
	shadow += x + 'px ' + y + 'px 1px rgba(0,0,0,.2), ' + x*2 + 'px ' + y*2 + 'px 6px rgba(0,0,0,.3)';	
	text.style.textShadow = shadow;
	text.style.webkitTransform = 'translateZ(0) rotateX(' + y*1.5 + 'deg) rotateY(' + -x*1.5 + 'deg)';
	text.style.MozTransform = 'translateZ(0) rotateX(' + y*1.5 + 'deg) rotateY(' + -x*1.5 + 'deg)';
}
document.addEventListener('mousemove', threedee, false);
</script>
</body>
</html>