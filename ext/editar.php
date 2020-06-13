<?php
session_start();
if(isset($_SESSION['verificado'])  && (isset($_GET['idus'])))
{
include 'variables2.php';
if(isset($_GET['id'])) { $id = base64_decode($_GET['id']); }
if(isset($_GET['idus'])) { $idus = base64_decode($_GET['idus']); }
try
{
require_once('conn/conn.php');
$sql = "CALL `ver_cor`('$id');";
$resultado = $conn->query($sql); 
}
catch (Exception $e)
{
$error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html class="no-js" lang="es">
<head>
<meta charset="utf-8">
<title>AGENDERS | EDITAR </title>
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
<body>
<div class="contenedorver">
<div class="verhe"><img src="../img/hero/hero1.png" alt=""></div>
<form action="actualizar.php?id=<?php echo base64_encode($id); ?>&idus=<?php echo base64_encode($idus);?>" method="post">
<?php while ($registro = $resultado->fetch_assoc()){?>
<h2 class="conseg">Editar contacto de <?php echo $registro['nombre'] ?></h2>
<div class="campoed">
<label for="nombre">Nombre:</label><br>
<input type="text"  name="nombre" id="nombre" value="<?php echo $registro['nombre'] ?>">
</div>
<div class="campoed">
<label for="apellido">Apellido:</label><br>
<input type="text"  name="apellido" id="apellido" value="<?php echo $registro['apellido'] ?>">
</div>
<div class="campoed">
<label for="numero">Telefono:</label><br>
<input type="tel" name="numero" id="numero" value="<?php echo $registro['telefono'] ?>" >
</div>
<div class="campoed">
<label for="email">Email:</label><br>
<input type="email" name="email" id="email" value="<?php echo $registro['email'] ?>">
</div>
<div class="campoed">
<div id="stphoed">
<label for="foto">foto:<br><i class="fas fa-download"></i></label>
<input type="file" name="foto" id="fotosubed" >
</div>
<?php
if($registro['foto'] > '')
{ ?>
<img src="data:image/jpg;base64,<?php echo base64_encode($registro['foto']); ?>" height="150px" title="foto de <?php echo $registro["nombre"]; ?>" id="foto">
<?php } else { } ?>
</div>
<div class="campoedno">
<label for="apuntes">Apuntes:</label><br>
<input type="text"  name="notas" id="notas" value="<?php echo $registro['apuntes'] ?>">
</div>
<button type="submit" class="verbot"><i class="fas fa-user-edit"></i><span class="verqui">Modificar</span></button>
<a href="javascript:salir()"><button type="button" class="verbot"><i class="fas fa-home"></i><span class="verqui">Inicio</span></button></a>
<?php } ?>
</form>
</div>
</div>
<script language="JavaScript1.2" type="text/javascript"> 
function salir() 
{ 
var confirmacion =confirm("¿Realmente desea salir sin modificar el contacto?"); 
if (confirmacion == true) 
{ 
document.location.href="contactos.php?id=<?php echo base64_encode($id); ?>&idus=<?php echo base64_encode($idus); ?>"; 
} 
else 
{ 
document.location.href="editar.php?id=<?php echo base64_encode($id); ?>&idus=<?php echo base64_encode($idus); ?>";
} 
} 
</script> 
<?php
$conn->close();
} else {
header ("Location: ../index.php?out=si");
}
?>
</body>
</html>