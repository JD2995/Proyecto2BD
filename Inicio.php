<!--<?php
	/*
	Autor: Erin Siezar García
	Fecha: 07/06/15 
	*/
?> -->
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="Imagenes/logo.png">

    <title>Asociaci&oacute;n de Ornitolog&iacute;a</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="css/mainPage.css" rel="stylesheet">
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>
    <script src="javascript/carousel.js"></script>
    <script src="javascript/jquery.js" type="text/javascript"></script>
  </head>

  <body>
      <?php
        //Observa si existe una sesión iniciada
        if(session_start() && isset($_SESSION['usuario'])){
            $usuario= $_SESSION['usuario'];
            print "<nav class=\"navbar navbar-fixed-top navbar-inverse\">
                <div class=\"container\">
                  <div class=\"navbar-header\">
                    <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#navbar\" aria-expanded=\"false\" aria-controls=\"navbar\">
                      <span class=\"sr-only\">Toggle navigation</span>
                      <span class=\"icon-bar\"></span>
                      <span class=\"icon-bar\"></span>
                      <span class=\"icon-bar\"></span>
                    </button>
                    <img class = \"nav navbar-nav\"src = \"Imagenes/logo.png\" height=\"50px\" width=\"50px\"/>
                    <a class=\"navbar-brand\" href=\"#\">Asociaci&oacute;n de Ornitolog&iacute;a</a>
                    <ul class=\"nav navbar-nav\">
                      <li class=\"active\"><a href=\"inicio.php\">Inicio</a></li>";
                      setGlobalPersona_ID($usuario);
                      if(validarRescatista($GLOBALS['Persona_ID'])=='0'){
                          print "<li><a href=\"ingresoMascota.php\">Ingresar Mascota</a></li>";
                      }
                      print "<li><a href=\"Adopciones.php\">Adopciones</a></li>
                          <li>
                            <div class=\"btn-group\">
                                <button type=\"button\" class=\"btn btn-default dropdown-toggle\"
                                        data-toggle=\"dropdown\" style=\"margin-top:9px;background:#2E2E2E;color:#F2F2F2;border:none;\">
                                  Consulta <span class=\"caret\"></span>
                                </button>
                                <ul class=\"dropdown-menu\" role=\"menu\">
                                  <li><a href=\"ConsultaPersonas.php\">Persona</a></li>
                                  <li><a href=\"ConsultaMascotas.php\">Mascota</a></li>
                                  <li><a href=\"ConsultaEstadistica.php\">Estadisticas</a></li>
                                </ul>
                            </div>	
                        </li>
                          <li><a href=\"#about\">Acerca de</a></li>
                    </ul>
                    <form class=\"navbar-form navbar-right\" method=\"POST\" action=\"salir.php\">
                      <small class = \"btn btn-success\">$usuario<small>   </small></small>
                      <button type=\"submit\" class=\"btn btn-success\">Cerrar Sesion</button>
                      <button class = \"btn btn-primary\"><a href=\"perfil.php\" style = \"color:white;float: right;\">Mi perfil</a></button>
                    </form>
                    

                  </div> <!-- fin div navbar-header --> 
                </div><!-- /.container -->
              </nav><!-- /.navbar -->";
        }
        else{
            print "<nav class=\"navbar navbar-fixed-top navbar-inverse\">
                <div class=\"container\">
                  <div class=\"navbar-header\">
                    <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#navbar\" aria-expanded=\"false\" aria-controls=\"navbar\">
                      <span class=\"sr-only\">Toggle navigation</span>
                      <span class=\"icon-bar\"></span>
                      <span class=\"icon-bar\"></span>
                      <span class=\"icon-bar\"></span>
                    </button>
                    <img class = \"nav navbar-nav\"src = \"Imagenes/logo.png\" height=\"50\" width=\"50\"/>
                    <p class = \"nav navbar-nav\"> \"   \"</p>
                    <a class=\"navbar-brand\" href=\"#\">Asociaci&oacute;n de Ornitolog&iacute;a</a>
                    <ul class=\"nav navbar-nav\">
                      <li class=\"active\"><a href=\"#\">Inicio</a></li>
                      <li><a href=\"RegistroPersona.php\">Registrarse</a></li>
                    </ul>
                    <form class=\"navbar-form navbar-right\" method=\"POST\" action=\"login.php\">
                      <div class=\"form-group\">
                        <input type=\"text\" placeholder=\"Usuario\" class=\"form-control\" name = \"usuario\" required autofocus>
                      </div>
                      <div class=\"form-group\">
                        <input type=\"password\" placeholder=\"Contraseña\" class=\"form-control\" name = \"contrasena\" required>
                      </div>
                      <button type=\"submit\" class=\"btn btn-success\">Ingresar</button>
                    </form>
                  </div> <!-- fin div navbar-header --> 
                </div><!-- /.container -->
              </nav><!-- /.navbar -->";
        }
      ?>
   
    <div class="container">
      <div class="row row-offcanvas row-offcanvas-right">

          <div class="col-xs-11 col-sm-10">
              <p class="pull-right visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
              </p>
              <div class="jumbotron">
                <h1><font color="lime">Bienvenido!</font></h1>			
                <p align="left">Un p&aacute;jaro es un animal vestido de plumas. Si tiene plumas es un p&aacute;jaro, si no tiene</p>
                <p align="left">plumas no es un p&aacute;jaro. Las aves son una de las cinco clases de animales vertebrados,</p>
                <p align="left">o sea los que tienen una columna vertebrada o espinoza.</p>
                <h1><p align="left">Si deseas conocer más sobre aves, este es el lugar perfecto, s&oacute;lo ten&eacute;s que ingresar.</p><h1>
              </div>
              
            </div> <!-- end div col-xs-12 col-sm-9 -->
            
        </div> <!--/.row row-offcanvas row-offcanvas-right-->
        <hr>
    </div>
    
   
 
					        
					   
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <title>Feature Carousel Demonstration Test</title>
    <link rel="stylesheet" href="css/feature-carousel.css" charset="utf-8" />
    <script src="js/jquery-1.7.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/jquery.featureCarousel.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">


      $(document).ready(function() {
        var carousel = $("#carousel").featureCarousel({
          // include options like this:
          // (use quotes only for string values, and no trailing comma after last option)
          // option: value,
          // option: value
        });

        $("#but_prev").click(function () {
          carousel.prev();
        });
        $("#but_pause").click(function () {
          carousel.pause();
        });
        $("#but_start").click(function () {
          carousel.start();
        });
        $("#but_next").click(function () {
          carousel.next();
        });
      });
    </script>
  </head>
  <body>
   		<div class="row">
					<div class="col-sm-1"></div>
		  <div class="row row-offcanvas row-offcanvas-right">

		   <div class="col-xs-12 col-sm-8">
		    <a id="but_prev" href="#">PREV</a> | <a id="but_pause" href="#">PAUSE</a> | <a id="but_start" href="#">START</a> | <a id="but_next" href="#">NEXT</a> 
		  
		    <div class="carousel-container">
		    
		      <div id="carousel">
		        <div class="carousel-feature">
		          <a href="#"><img class="carousel-image" alt="Image Caption" src="Imagenes/Nigricans.jpg"></a>
		          <div class="carousel-caption">
		          <p>Nigricans</p>
		          </div>
		        </div>
		        <div class="carousel-feature">
		          <a href="#"><img class="carousel-image" alt="Image Caption" src="Imagenes/Tyrannus.jpg"></a>
		          <div class="carousel-caption">
		          <p>Tyrannus</p>
		          </div>
		        </div>
		        <div class="carousel-feature">
		          <a href="#"><img class="carousel-image" alt="Image Caption" src="Imagenes/Melancholicus.jpg" height="221" width="406"></a>
		          <div class="carousel-caption">
		          <p>Melancholicus</p>
		          </div>
		        </div>
		         <div class="carousel-feature">
		          <a href="#"><img class="carousel-image" alt="Image Caption" src="Imagenes/Maculatus.JPG"></a>
		          <div class="carousel-caption">
		          <p>Maculatus</p>
		          </div>
		        </div>
		        <div class="carousel-feature">
		          <a href="#"><img class="carousel-image" alt="Image Caption" src="Imagenes/Pitagua.jpg" height="172" width="293"></a>
		          <div class="carousel-caption">
		          <p>Pitagua</p>
		          </div>
		        </div>
		        <div class="carousel-feature">
		          <a href="#"><img class="carousel-image" alt="Image Caption" src="Imagenes/Similis.jpg" height="165" width="294"></a>
		          <div class="carousel-caption">
		          <p>Similis</p>
		          </div>
		        </div>
		        <div class="carousel-feature">
		          <a href="#"><img class="carousel-image" alt="Image Caption" src="Imagenes/Sulphuratus.jpg" height="161" width="290"></a>
		          <div class="carousel-caption">
		          <p>Sulphuratus</p>
		          </div>
		        </div>
		        <div class="carousel-feature">
		          <a href="#"><img class="carousel-image" alt="Image Caption" src="Imagenes/Sulphureipygius.jpg" height="164" width="301"></a>
		          <div class="carousel-caption">
		          <p>Sulphureipygius</p>
		          </div>
		        </div>
		        <div class="carousel-feature">
		          <a href="#"><img class="carousel-image" alt="Image Caption" src="Imagenes/Mexicanus.jpg" height="178" width="377"></a>
		          <div class="carousel-caption">
		          <p>Mexicanus</p>
		          </div>
		        </div>
		        <div class="carousel-feature">
		          <a href="#"><img class="carousel-image" alt="Image Caption" src="Imagenes/Sulphurescens.jpg" height="174" width="291"></a>
		          <div class="carousel-caption">
		          <p>Sulphurescens</p>
		          </div>
		        </div>
		        <div class="carousel-feature">
		          <a href="#"><img class="carousel-image" alt="Image Caption" src="Imagenes/Cinereum.jpg" height="150" width="324"></a>
		          <div class="carousel-caption">
		          <p>Cinereum</p>
		          </div>
		        </div>
		        <div class="carousel-feature">
		          <a href="#"><img class="carousel-image" alt="Image Caption" src="Imagenes/Cinerea.jpg" height="193" width="423"></a>
		          <div class="carousel-caption">
		          <p>Cinerea</p>
		          </div>
		        </div>
		      </div>
		      <div class="carousel-feature">
		          <a href="#"><img class="carousel-image" alt="Image Caption" src="Imagenes/Frantzii.jpg" height="166" width="371"></a>
		          <div class="carousel-caption">
		          <p>Frantzii</p>
		          </div>
		        </div>
		      <div class="carousel-feature">
		          <a href="#"><img class="carousel-image" alt="Image Caption" src="Imagenes/Oleagineus.jpg" height="195" width="382"></a>
		          <div class="carousel-caption">
		          <p>Oleagineus</p>
		          </div>
		        </div>
		      <div id="carousel-left"><img src="Imagenes/arrow-left.png" /></div>
		      <div id="carousel-right"><img src="Imagenes/arrow-right.png" /></div>
		    </div>
		  </div>
		  </div>
		   </div>
				<div class="row"><br>
		   </div>
		  </body>
		</html>