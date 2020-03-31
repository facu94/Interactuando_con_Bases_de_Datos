<?php
	require('conector.php');
	$con = new conectorBD();

	$response['conexion'] = $con->initConexion($con->database);
	if ($response['conexion'] == 'OK'){
		$conexion = $con->getConexion();
		$insert = $conexion->prepare('INSERT INTO usuarios (email, nombre, password , fecha_nacimiento) VALUES (?,?,?,?)');
		$insert->bind_param("ssss", $email, $nombre, $password, $fecha_nacimiento);

		$psw = "1234";
		$email = "user1@mail.com";
		$nombre = "Juan Perez";
		$password = password_hash($psw, PASSWORD_DEFAULT);
		$fecha_nacimiento = "1998-12-28";

		$insert->execute();

		$psw = "abc";
		$email = 'user2@mail.com';
		$nombre = 'Pepito Honguito';
		$password = password_hash($psw, PASSWORD_DEFAULT);
		$fecha_nacimiento = '1991-02-05';

		$insert->execute();

		$psw = "5678";
		$email = 'user3@mail.com';
		$nombre = 'Fulano de Nadie';
		$password = password_hash($psw, PASSWORD_DEFAULT);
		$fecha_nacimiento = '1992-11-10';

		$insert->execute();

		$response['resultado'] = "1";
		$response['msg']= 'Informacio de inicio:';
		$getUsers = $con->consultar(['usuarios'],['*'],$condicion = "");
		while ($fila= $getUsers->fetch_assoc()) {
			$response['msg'].=$fila['email'];
		}
		$response['msg'].= 'contrasenia: '.$psw;
		}else{
			$response['resultado'] == "0";
			$response['msg'] = 'No se pudo conectar a la base de datos';
		}

		echo json_encode($response);

 ?>
