<?php
if(isset($_POST['nombre'])){ $nombre = $_POST['nombre'];}else{$nombre = '';}
if(isset($_POST['apellido'])){ $apellido = $_POST['apellido'];}else{$apellido = '';}
if(isset($_POST['email'])){ $email = $_POST['email'];}else{$email = '';}
if(isset($_POST['contrasenia'])){ $contrasenia = $_POST['contrasenia'];}else{$contrasenia = '';}


if($nombre > '' && $email > '' && $contrasenia > '')
{
if(strlen($contrasenia) > 4 and strlen($contrasenia) < 16)
{
$busqueda1 = $email;
$buscada = ".com";
$coicidencia = strpos($busqueda1, $buscada);
if ($coicidencia == true) {
try
{
require_once('conn/conn.php');
$busqueda = $conn->query("CALL `bus_cor`('$email');");
$conn ->next_result();
if(mysqli_num_rows($busqueda)<=0)
{
$query = $conn->query("CALL `inser_us`('$nombre', '$apellido', '$email', '$contrasenia');");
if($query) 
{ header ("Location: ../index.php?save=si"); }
else
{ header ("Location: ../index.php?donsa=no"); } 
}
else
{
$est = "Este Email ya esta en uso, Intente otra vez.";
}
}
catch (Exception $e)
{ $error = $e->getMessage(); }
} else {
$inv = "Este Email $email no es valido, Intente otra vez.";
}
} else {
$er_cl = "La clave debe tener al menos 4 caracteres y menos de 16";
}
}
?>
<!doctype html>
<html class="no-js" lang="es">
<head>
<meta charset="utf-8">
<title>AGENDERS || REGISTRO</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="manifest" href="site.webmanifest">
<link rel="apple-touch-icon" href="icon.png">
<link rel="icon" type="icon" href="../img/AgendersIcon.png">
<link rel="stylesheet" href="../css/normalize.css">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/all.min.css">
<meta name="theme-color" content="#fafafa">
</head>
<body class="zto">
<div class="reg"> 
<div class="qw">
<a href="../index.php" title="Inicia sesión"><input type="button" value="¿Ya tienes cuenta?" class="regbo"></a>
</div>
<form action="registro.php" method="post">
<div class="spa1"><input type="submit" value="Registrarme" class="regbo"></div>
<div class="ter"> 
<input type="checkbox" name="check" id="ter" required><label for="ter"> Acepto <a href="terminos.html">termino y usos.</a></label>
</div><br/>
<div class="spa">
<label for="nom">Nombre:</label><br/>
<i class="fas fa-caret-right"></i><input type="text" name="nombre" id="nom" class="regi" autocomplete="off" required><i class="fas fa-caret-left"></i>
</div>
<div class="spa">
<label for="ape">Apellido:</label><br/>
<i class="fas fa-caret-right"></i><input type="text" name="apellido" id="ape" class="regi" autocomplete="off"><i class="fas fa-caret-left"></i>
</div>
<div class="spa">
<label for="co">Email:</label><br/>
<i class="fas fa-caret-right"></i><input type="email" name="email" id="co" class="regi" autocomplete="off" required><i class="fas fa-caret-left"></i>
</div>
<div class="spa">
<label for="pw">Contraseña:</label><br/>
<i class="fas fa-caret-right"></i><input type="password" name="contrasenia" id="pw" class="regi" autocomplete="off" required><i class="fas fa-caret-left"></i>
</div>
<div class="aler">
<?php if (isset($er_cl)){ echo $er_cl; }?><br>
<?php if (isset($inv)){ echo $inv; }?><br>
<?php if (isset($est)){ echo $est; }?>
</div>
<div class="reg1">
<img src="../img/hero/hero1.png" alt="hero">
</div>
<h1 class="regh">¡Ya falta poco, termina el formulario!</h1>
</form>
</div>
<?php
?>
</body>
</html>