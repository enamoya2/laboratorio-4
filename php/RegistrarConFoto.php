<?php

function validateEmail($email){
	$re = '/^[a-zA-Z]{3,}\d{3}@ikasle\.ehu\.(es|eus)$/';
	return preg_match($re, $email);
}

function validateNombre($nombre){
	$re = '/^[A-Za-z]+(\s[A-Za-z]+)+$/';
	return preg_match($re, $nombre);
}

function validateTlf($tlf){
  $re = '/^[6-9][0-9]{8}$/';
	return preg_match($re, $tlf);
}

function validatePassword($password){
	if(strlen($password)<6)
		return false;
	return true;
}

function insertImage(){
	$target_dir = "../Images/";
	$target_dirdefault = "../Images/usuario.jpg";
	$target_file = $target_dir . basename($_FILES["foto"]["name"]);
	if($target_file == $target_dir){
		$target_file = $target_dirdefault;
	}
	$uploadOk = 1;
	$samefile = 0;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["foto"]["tmp_name"]);
		if($check !== false) {
			$uploadOk = 1;
		}
		else {
			echo "El archivo es una imagen.";
			$uploadOk = 0;
		}
	}
	
	if (file_exists($target_file)) {
			$samefile = 1;
	}

	if ($_FILES["foto"]["size"] > 500000) {
		echo "Tu fichero es demasiado grande.";
		$uploadOk = 0;
	}

	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "Solo estan permitidos los archivos de extension JPG, JPEG, PNG & GIF.";
		$uploadOk = 0;
	}
	

	if ($uploadOk == 0) {
		echo "Lo sentimos, tu imagen no se ha podido almacenar en la base de datos.";
		return;
		
	}
	else {
		if($samefile != 1){
			if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file))
				echo "Sorry, there was an error uploading your file.";
		}
		return $target_file;
	}
	
}

$mysqli =mysqli_connect("mysql.hostinger.es","u875296919_root","rootena","u875296919_usu") or die(mysql_error()); //hostinger
//$mysqli = mysqli_connect("localhost", "root", "", "quiz");  //local
if (!$mysqli) {
  echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
  exit;
}
if (!isset($_POST['email'])) {
  echo "Fallo al enviar el formulario, email vacio";
  exit;
}
$email=$_POST['email'];
$nombre=$_POST['nombre'];
$password=$_POST['password'];
$tlf=$_POST['tlf'];
$especialidad=$_POST['especialidad'];
if($especialidad=="otro"){
  $especialidad=$_POST['otraesp'];
}
$intereses=$_POST['intereses'];
if(!isset($intereses)){
  $intereses = NULL;
}

if(validateEmail($email) == 0){
  echo "Error";
  exit;
}

if(validateNombre($nombre) == 0){
  echo "Error";
  exit;
}

if(validateTlf($tlf) == 0){
  echo "Error";
  exit;
}

if(validatePassword($password) == false){
  echo "Error";
  exit;
}
$enc_pass = sha1(md5($password));
$path_img = insertImage();
if($path_img != ""){

	$sql="INSERT INTO usuario(Nombre, Email, Password, Telefono, Especialidad, Intereses, Foto) VALUES ('$nombre','$email','$enc_pass',$tlf,'$especialidad','$intereses', '$path_img')";
	if (!mysqli_query($mysqli ,$sql)){
		die('Error: ' . mysqli_error($mysqli));
	}
	echo "Añadido un usuario a la base de datos";
}
echo "<p> <a href='verUsuariosConFoto.php'> Ver registros </a>";

mysqli_close($mysqli);
?>
