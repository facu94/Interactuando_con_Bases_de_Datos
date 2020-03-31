<?php
	session_start(); //Inicia manejador de sesiones
	session_destroy(); //Destruye la sesion
	header ('Location:../client/index.html'); //Vuelve al inicio
 ?>
