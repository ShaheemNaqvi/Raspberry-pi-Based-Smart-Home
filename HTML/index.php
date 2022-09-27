<?php session_start(); 
$setmode17 =shell_exec("gpio -g mode 26 out");//drawing room lights
$setmode17 =shell_exec("gpio -g mode 27 out");//drawing room fan
$setmode17 =shell_exec("gpio -g mode 22 out");//room1 light
$setmode17 =shell_exec("gpio -g mode 5 out");//room2 light
$setmode17 =shell_exec("gpio -g mode 6 out");//bathroom light
$setmode17 =shell_exec("gpio -g mode 13 out");//main door open
$setmode17 =shell_exec("gpio -g mode 19 out");//main door close
$setmode17 =shell_exec("gpio -g mode 20 out");//outdoor light

//File to read
$file = '/sys/bus/w1/devices/28-00299b120204/w1_slave';

//Read the file line by line
$lines = file($file);

//Get the temp from second line 
$temp = explode('=', $lines[1]);

//Setup some nice formatting (i.e. 21,3)
$temp = number_format($temp[1] / 1000, 1, ',', '');

//And echo that temp
 $_SESSION['temp'] = $temp . " &deg;C";

    if(isset($_POST["DrLightOn"]))
    {

       $gpio_off = shell_exec("gpio -g write 26 0");
    }

    if(isset($_POST["DrLightOff"]))
    {
       $gpio_off = shell_exec("gpio -g write 26 1");
    }

    if(isset($_POST["DrFanOn"]))
    {
         $gpio_off = shell_exec("gpio -g write 27 0");
    }

    if(isset($_POST["DrFanOff"]))
    {
        $gpio_off = shell_exec("gpio -g write 27 1");
    }

    if(isset($_POST["r1LightOn"]))
    {

       $gpio_off = shell_exec("gpio -g write 22 0");
    }

    if(isset($_POST["r1LightOff"]))
    {
       $gpio_off = shell_exec("gpio -g write 22 1");
    }

    if(isset($_POST["r2LightOn"]))
    {

       $gpio_off = shell_exec("gpio -g write 5 0");
    }

    if(isset($_POST["r2LightOff"]))
    {
       $gpio_off = shell_exec("gpio -g write 5 1");
    }

    if(isset($_POST["brLightOn"]))
    {

       $gpio_off = shell_exec("gpio -g write 6 0");
    }

    if(isset($_POST["brLightOff"]))
    {
       $gpio_off = shell_exec("gpio -g write 6 1");
    }
//main door

    if(isset($_POST["mdOpen"]))
    {

       $gpio_off = shell_exec("gpio -g write 13 1");

        sleep(1);

       $gpio_off = shell_exec("gpio -g write 13 0");
    }
else  if(isset($_POST["mdClose"]))
    {
       $gpio_off = shell_exec("gpio -g write 19 1");
       sleep(1);

       $gpio_off = shell_exec("gpio -g write 19 0");
    }
 if(isset($_POST["moAway"]))
    {

       $gpio_off = shell_exec("gpio -g write 26 1");

       $gpio_off = shell_exec("gpio -g write 27 1");

       $gpio_off = shell_exec("gpio -g write 22 1");

       $gpio_off = shell_exec("gpio -g write 5 1");

       $gpio_off = shell_exec("gpio -g write 6 1");
    }
if(isset($_POST["moNight"]))
    {

       $gpio_off = shell_exec("gpio -g write 26 0");

       $gpio_off = shell_exec("gpio -g write 27 1");

       $gpio_off = shell_exec("gpio -g write 22 1");

       $gpio_off = shell_exec("gpio -g write 5 1");

       $gpio_off = shell_exec("gpio -g write 6 1");      

       $gpio_off = shell_exec("gpio -g write 20 0");
    }
//outdoor light

  if(isset($_POST["moOutn"]))
    {

       $gpio_off = shell_exec("gpio -g write 20 0");
    }

    if(isset($_POST["moOutf"]))
    {
       $gpio_off = shell_exec("gpio -g write 20 1");
    }

//livestreaming

  if(isset($_POST["cctvl"]))
    {
               
            //shell_exec("sudo python /var/www/html/motionstart.py");
             system("sudo  python /var/www/html/motionstart.py");
             header("Location:http:\/\/169.254.236.190:8081");
    }



?>

<!DOCTYPE html>
<html>

<head>
    <title>Index</title>
   <!-- <link rel="stylesheet" href="assets/css/bootstrap.min.css"> -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <!-- <script src="assets/js/bootstrap.min.js"></script>-->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        /*!
        * bootstrap-vertical-tabs - v1.1.0
        * https://dbtek.github.io/bootstrap-vertical-tabs
        * 2014-06-06
        * Copyright (c) 2014 Ä°smail Demirbilek
        * License: MIT
        */
        .tabs-left, .tabs-right {
            border-bottom: none;
            padding-top: 2px;
        }

        .tabs-left {
            border-right: 1px solid #ddd;
        }

        .tabs-right {
            border-left: 1px solid #ddd;
        }

            .tabs-left > li, .tabs-right > li {
                float: none;
                margin-bottom: 2px;
            }

        .tabs-left > li {
            margin-right: -1px;
        }

        .tabs-right > li {
            margin-left: -1px;
        }

        .tabs-left > li.active > a,
        .tabs-left > li.active > a:hover,
        .tabs-left > li.active > a:focus {
            border-bottom-color: #ddd;
            border-right-color: transparent;
        }

        .tabs-right > li.active > a,
        .tabs-right > li.active > a:hover,
        .tabs-right > li.active > a:focus {
            border-bottom: 1px solid #ddd;
            border-left-color: transparent;
        }

        .tabs-left > li > a {
            border-radius: 4px 0 0 4px;
            margin-right: 0;
            display: block;
        }

        .tabs-right > li > a {
            border-radius: 0 4px 4px 0;
            margin-right: 0;
        }

        .vertical-text {
            margin-top: 50px;
            border: none;
            position: relative;
        }

            .vertical-text > li {
                height: 20px;
                width: 120px;
                margin-bottom: 100px;
            }

                .vertical-text > li > a {
                    border-bottom: 1px solid #ddd;
                    border-right-color: transparent;
                    text-align: center;
                    border-radius: 4px 4px 0px 0px;
                }

                .vertical-text > li.active > a,
                .vertical-text > li.active > a:hover,
                .vertical-text > li.active > a:focus {
                    border-bottom-color: transparent;
                    border-right-color: #ddd;
                    border-left-color: #ddd;
                }

            .vertical-text.tabs-left {
                left: -50px;
            }

            .vertical-text.tabs-right {
                right: -50px;
            }

                .vertical-text.tabs-right > li {
                    -webkit-transform: rotate(90deg);
                    -moz-transform: rotate(90deg);
                    -ms-transform: rotate(90deg);
                    -o-transform: rotate(90deg);
                    transform: rotate(90deg);
                }

            .vertical-text.tabs-left > li {
                -webkit-transform: rotate(-90deg);
                -moz-transform: rotate(-90deg);
                -ms-transform: rotate(-90deg);
                -o-transform: rotate(-90deg);
                transform: rotate(-90deg);
            }
  </style>
 
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <input type="submit" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>

                <a class="navbar-brand" href="#">RASPBERRY PI BASED SMART HOME</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <form class="navbar-form navbar-right">
                    <!--      <div class="form-group">
                        <input type="text" placeholder="Email" class="form-control">
                      </div>
                      <div class="form-group">
                      <input type="password" placeholder="Password" class="form-control">
                    </div> -->
                    <input type="submit" class="btn btn-success">Logout
                </form>
            </div><!--/.navbar-collapse -->
        </div>
    </nav>
    <div class="jumbotron">
        <div class="container">
			<div class="pull-left">
				<h1>Smart Home !</h1>
				<p>Raspberry Pi Based Smart Home</p>
				<p><a class="btn btn-primary btn-lg" href="https://zeghamabbas6.wixsite.com/home" role="button">Learn more »</a></p>
			</div>

			<div class="pull-right">
				<h2>Temperature!</h1>
				<p><?php echo $_SESSION['temp']; ?></p>
			</div>
		</div>
    </div>
    <div class="container">
        <div class="container">
            <div class="col-sm-8">
                <h3>Actions</h3>
                <hr />
                <div class="col-xs-4">
                    <!-- required for floating -->
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tabs-left" id="myTab">
                        <li class="active"><a href="#dr" data-toggle="tab">Drawing Room</a></li>
                        <li><a href="#r1" data-toggle="tab">Room 1</a></li>
                        <li><a href="#r2" data-toggle="tab">Room 2</a></li>
                        <li><a href="#br" data-toggle="tab">Bathroom</a></li>
                        <li><a href="#md" data-toggle="tab">Main Door</a></li>
                        <li><a href="#mo" data-toggle="tab">Modes</a></li>
                        <li><a href="#temp" data-toggle="tab">Temperature</a></li>
                        <li><a href="#cctv" data-toggle="tab">CCTV</a></li>
                    </ul>
                </div>
                <div class="col-xs-8">
                    <!-- Tab panes -->
                    <form method="post">
                          <div class="tab-content">
                            <div class="tab-pane active" id="dr">
                                <h2>Lights</h2>
                                <input type="submit" class="btn btn btn-primary btn-lg" value="On" name="DrLightOn" />
                                <input type="submit" class="btn btn btn-danger btn-lg" name="DrLightOff" value="Off" />

                                <h2>Fans</h2>
                                <input type="submit" class="btn btn btn-primary btn-lg" value="On" name="DrFanOn">
                                <input type="submit" class="btn btn btn-danger btn-lg" value="Off" name="DrFanOff">
                            </div>
                            <div class="tab-pane" id="r1">
                                <h2>Lights</h2>

                                <input type="submit" class="btn btn btn-primary btn-lg" value="On" name="r1LightOn" />
                                <input type="submit" class="btn btn btn-danger btn-lg" value="Off" name="r1LightOff" />

                            </div>
                            <div class="tab-pane" id="r2">
                                <h2>Lights</h2>

                                <input type="submit" class="btn btn btn-primary btn-lg" value="On" name="r2LightOn" />
                                <input type="submit" class="btn btn btn-danger btn-lg" value="Off" name="r2LightOff" />

                             </div>
                            <div class="tab-pane" id="br">

                                <h2>Lights</h2>
                                <input type="submit" class="btn btn btn-primary btn-lg" value="On" name="brLightOn" />
                                <input type="submit" class="btn btn btn-danger btn-lg" value="Off" name="brLightOff" />

                            </div>
                            <div class="tab-pane" id="md">
                                <h2>Main Door</h2>
                                <input type="submit" class="btn btn btn-primary btn-lg" value="Open" name="mdOpen" />
                                <input type="submit" class="btn btn btn-danger btn-lg" value="Close" name="mdClose" />
                            </div>
                            <div class="tab-pane" id="mo">
                                <h2>Modes</h2>
                                <input type="submit" class="btn btn btn-primary btn-lg" value="Night" name="moNight" />
                                <input type="submit" class="btn btn btn-success btn-lg" value="Away" name="moAway" />
<h2>Outdoor</h2>

                                 <input type="submit" class="btn btn btn-success btn-lg" value="Outdoor Light ON" name="moOutn" />
                                 <input type="submit" class="btn btn btn-success btn-lg" value="Outdoor Light OFF" name="moOutf" />

                            </div>
                            <div class="tab-pane" id="temp"> 
							<h2>Temprature</h2>
							<p><?php echo $_SESSION['temp']; ?></p>
							</div>
                            <div class="tab-pane" id="cctv">
                                <h2>CCTV Streaming</h2>
                                <input type="submit" class="btn btn btn-success btn-lg" value="LIVE STREAMING" name="cctvl" />
                          </div>
                        </div>
							 <script>

							 $('#myTab a').click(function(e) {
							  e.preventDefault();
							  $(this).tab('show');
							});

							// store the currently selected tab in the hash value
							$("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
							  var id = $(e.target).attr("href").substr(1);
							  window.location.hash = id;
							});

							// on load of the page: switch to the currently selected tab
							var hash = window.location.hash;
							$('#myTab a[href="' + hash + '"]').tab('show');

						 </script>
                    </form>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="col-xs-4">
        <div class="thumbnail">
            <img src="http://placehold.it/500x300" alt="">
            <div class="caption">
                <h4>SUPERVISOR DR.M.ARIF WAHLA    </h4>
                <p>
                    Group Members <br>
                    MUHAMMAD ZEGHAM ABBAS<br>
                    MUHAMMAD SHAHEEM RAZA<br>
                    MUHAMMAD ADNAN
                </p>
            </div>
        </div>
    </div>
    </div>
    <hr>
    <footer>
        <p>© 2017 smart home, Inc.</p>
    </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script type="text/javascript">
        particlesJS("row", { "particles": { "number": { "value": 60, "density": { "enable": true, "value_area": 800 } }, "color": { "value": "#ffffff" }, "shape": { "type": "circle", "stroke": { "width": 0, "color": "#000000" }, "polygon": { "nb_sides": 5 }, "image": { "src": "img/github.svg", "width": 100, "height": 100 } }, "opacity": { "value": 0.25, "random": false, "anim": { "enable": false, "speed": 1, "opacity_min": 0.1, "sync": false } }, "size": { "value": 3, "random": true, "anim": { "enable": false, "speed": 40, "size_min": 0.1, "sync": false } }, "line_linked": { "enable": true, "distance": 150, "color": "#ffffff", "opacity": 0.3, "width": 1 }, "move": { "enable": true, "speed": 3, "direction": "none", "random": false, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": false, "rotateX": 600, "rotateY": 1200 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": true, "mode": "repulse" }, "onclick": { "enable": true, "mode": "push" }, "resize": true }, "modes": { "grab": { "distance": 400, "line_linked": { "opacity": 1 } }, "bubble": { "distance": 400, "size": 40, "duration": 2, "opacity": 8, "speed": 3 }, "repulse": { "distance": 200, "duration": 0.4 }, "push": { "particles_nb": 4 }, "remove": { "particles_nb": 2 } } }, "retina_detect": true }); var count_particles, stats, update; stats = new Stats; stats.setMode(0); stats.domElement.style.position = 'absolute'; stats.domElement.style.left = '0px'; stats.domElement.style.top = '0px'; document.body.appendChild(stats.domElement); count_particles = document.querySelector('.js-count-particles'); update = function () { stats.begin(); stats.end(); if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) { count_particles.innerText = window.pJSDom[0].pJS.particles.array.length; } requestAnimationFrame(update); }; requestAnimationFrame(update);;

    </script>

</body>
</html>



