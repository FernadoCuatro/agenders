<?php
if(isset($_POST['email'])){ $email = $_POST['email'];}else{$email = '';}
if(isset($_POST['pasw'])){ $pasw = $_POST['pasw'];}else{$pasw = '';}
include 'ext/user.php';
if($email !== '' && $pasw !== '') { try { 
require_once('ext/conn/conn.php');

if($email==$agenderad and $pasw==$agenderpw)
{
session_start();
$_SESSION["orde"]="si";
header("Location: ext/agendersad.php");  
}
else 
{ $sql = "CALL `ini_user`('$email', '$pasw');";
$resultado = $conn->query($sql);
$filas = mysqli_num_rows($resultado);
if ($filas>0){
while($registro = $resultado->fetch_assoc() ) { 
session_start();
$_SESSION["verificado"]="si";
$idus=base64_encode($registro[idus]);
header("Location: ext/contactos.php?idus=$idus"); } }
else { $va = "Error en el usuario, por favor registrese."; } } }
catch (Exception $e) { $error = $e->getMessage(); } }
else
{ $noex = "Por favor inserte el usuario y contraseña <a href='ext/registro.php'>¿No te has registrado?</a>"; }
?>
<!doctype html>
<html class="no-js" lang="es">
<head>
<meta charset="utf-8">
<title>AGENDERS || INICIO</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="manifest" href="site.webmanifest">
<link rel="icon" type="icon" href="img/AgendersIcon.png">
<link rel="apple-touch-icon" href="icon.png">
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/all.min.css">
<meta name="theme-color" content="#fafafa">
</head>
<body class="zto">
<div class="bac">
<div class="hea">
<div class="hea1">
<img src="img/hero/hero1.png" alt="hero">
</div> 
<div class="hea2">
<i class="far fa-user"></i></i><input type="button" value="iniciar sesión" onclick="inicio('inicio')" class="bot">
<a href="ext/registro.php"><i class="far fa-address-card"></i><input type="button" value="Registrarse" class="bot"></a>
</div>
</div>
<div class="aler">
<?php
if (isset($_GET['save']) == "si") { echo "Te registraste correctamente, por favor inicia sesión."; } if (isset($_GET['donsa']) == "no") { echo "No te registraste correctamente, por favor vuelve a intentarlo"; } if (isset($_GET['out'])=="si") { echo "No puedes entrar ala pagina, por favor inicia sesión."; }
if (isset($va)){ echo $va; }
?>
</div>
<div id="inicio" class="inicio">
<form action="index.php" method="post">
<label for="email">Email:</label><br>
<input type="email" name="email" id="email" class="en" placeholder="ejemplo@agenders.com" required><br>
<label for="pw">Contraseña:</label><br>
<input type="password" name="pasw" id="pw" class="en" placeholder="••••••••••" required><br>
<i class="far fa-user"></i><input type="submit" value="iniciar sesión" class="en2"><br>
<div class="noex">
<?php  if(isset($noex)) { echo $noex; } 
?></div>
</form>
</div>
</div>
<script src="js/vendor/modernizr-3.7.1.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
</body>
</html>
